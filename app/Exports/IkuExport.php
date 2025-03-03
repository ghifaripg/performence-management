<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class IkuExport implements WithTitle, FromArray
{
    protected $selectedYear;
    protected $spreadsheet;

    public function __construct($year)
    {
        $this->selectedYear = $year;
        $templatePath = public_path('templates/Form_Iku.xlsx');

        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found at: " . $templatePath);
        }

        $this->spreadsheet = IOFactory::load($templatePath);
    }

    public function title(): string
    {
        return "Form Iku {$this->selectedYear}";
    }

    public function array(): array
    {
        return [];
    }

    public function populateData()
{
    $user = Auth::user();
    $kontrak_id = 'KM_' . $this->selectedYear;

    $department = DB::table('department')
        ->where('department_id', $user->department_id)
        ->select('department_username', 'department_name')
        ->first();

    if (!$department) {
        throw new \Exception('Department not found.');
    }

    $departmentName = (string) $department->department_name;

    $ikuIdentifier = 'IKU' . str_replace(' ', '_', $department->department_username) . '_' . $this->selectedYear;

    $sasaranStrategis = DB::table('sasaran_strategis')->where('kontrak_id', $kontrak_id)->get();
    $ikus = DB::table('form_iku')
        ->join('isi_iku', 'form_iku.isi_iku_id', '=', 'isi_iku.id')
        ->where('form_iku.iku_id', $ikuIdentifier)
        ->select('form_iku.*', 'isi_iku.iku', 'isi_iku.proker', 'isi_iku.pj')
        ->get();

    $ikuPoints = DB::table('iku_point')->get()->groupBy('form_iku_id');

    $sheet = $this->spreadsheet->getActiveSheet();
    $startRow = 11;
    $num = 1;

    foreach ($sasaranStrategis as $sasaran) {
        $sheet->setCellValue("B3", "Indikator Kinerja Utama (IKU) Tahun {$this->selectedYear}");
        $sheet->getStyle("B3")->getFont()->setBold(true)->setSize(22);
        $sheet->setCellValue("B5", $departmentName);
        $sheet->getStyle("B5")->getFont()->setBold(true)->setSize(22);
        $ikusUnderSasaran = $ikus->where('sasaran_id', $sasaran->id);
        if ($ikusUnderSasaran->isEmpty()) continue;

        // Calculate total row span needed for merging
        $rowSpan = $ikusUnderSasaran->reduce(function ($carry, $iku) use ($ikuPoints) {
            $pointsCount = $ikuPoints->get($iku->id, collect())->count();
            return $carry + ($pointsCount > 0 ? $pointsCount + 1 : 1); // +1 for the main IKU row
        }, 0);

        $endRow = $startRow + $rowSpan - 1;

        // Merge columns for Sasaran Strategis
        if ($rowSpan > 1) {
            $sheet->mergeCells("A{$startRow}:A{$endRow}");
            $sheet->mergeCells("B{$startRow}:B{$endRow}");
        }

        $sheet->setCellValue("A{$startRow}", $num);
        $sheet->setCellValue("B{$startRow}", $sasaran->name);

        foreach ($ikusUnderSasaran as $iku) {
            $points = $ikuPoints->get($iku->id, collect());
            $ikuRowSpan = $points->count() > 0 ? $points->count() + 1 : 1; // +1 for the main IKU row
            $ikuEndRow = $startRow + $ikuRowSpan - 1;

            // Merge cells for the main IKU row and points
            if ($ikuRowSpan > 1) {
                $sheet->mergeCells("C{$startRow}:C{$ikuEndRow}");
                $sheet->mergeCells("D{$startRow}:D{$ikuEndRow}");
                $sheet->mergeCells("K{$startRow}:K{$ikuEndRow}");
                $sheet->mergeCells("L{$startRow}:L{$ikuEndRow}");
            }

            // Set main IKU data
            $sheet->setCellValue("C{$startRow}", $iku->iku_atasan);
            $sheet->setCellValue("D{$startRow}", $iku->target);
            $sheet->setCellValue("K{$startRow}", $iku->proker);
            $sheet->setCellValue("L{$startRow}", $iku->pj);
            $sheet->setCellValue("E{$startRow}", $iku->iku); // Main IKU

            if ($points->isNotEmpty()) {
                // Set IKU points in subsequent rows
                $rowOffset = 1; // Start from the next row
                foreach ($points as $point) {
                    $currentRow = $startRow + $rowOffset;
                    $sheet->setCellValue("E{$currentRow}", $point->point_name);
                    $sheet->setCellValue("F{$currentRow}", $point->base);
                    $sheet->setCellValue("G{$currentRow}", $point->stretch);
                    $sheet->setCellValue("H{$currentRow}", $point->bobot);
                    $sheet->setCellValue("I{$currentRow}", ucfirst($point->polaritas));
                    $sheet->setCellValue("J{$currentRow}", $point->bobot);
                    $rowOffset++;
                }
            } else {
                // No IKU points, fill row with default values
                $sheet->setCellValue("F{$startRow}", $iku->base);
                $sheet->setCellValue("G{$startRow}", $iku->stretch);
                $sheet->setCellValue("H{$startRow}", $iku->satuan);
                $sheet->setCellValue("I{$startRow}", ucfirst($iku->polaritas));
                $sheet->setCellValue("J{$startRow}", $iku->bobot);
            }

            $startRow += $ikuRowSpan; // Move to next available row
        }

        $num++;
    }

    $this->applyStyles($sheet, 11, $startRow);
}


private function applyStyles(Worksheet $sheet, int $startRow, int $endRow)
{
    $range = "A{$startRow}:L{$endRow}";
    $styleArray = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            'wrapText' => true,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => 'D3D3D3'],
            ],
        ],
    ];
    $sheet->getStyle($range)->applyFromArray($styleArray);

    // Auto-adjust row height
    for ($row = $startRow; $row <= $endRow; $row++) {
        $sheet->getRowDimension($row)->setRowHeight(-1);
    }
}


    public function export()
    {
        $this->populateData();

        $user = Auth::user();
        $department = DB::table('department')
            ->where('department_id', $user->department_id)
            ->select('department_username')
            ->first();

        if (!$department) {
            throw new \Exception('Department not found.');
        }

        $filePath = storage_path("app/Form_IKU_{$department->department_username}_{$this->selectedYear}.xlsx");
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
