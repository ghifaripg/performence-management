<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class IkuExport implements WithTitle, FromArray
{
    protected $selectedYear;
    protected $name;
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
        $nama = Auth::user()->nama;
        $department_id = Auth::user()->department_id;
        $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_username', 'department_name')
        ->first();

        if (!$department || !isset($department->department_username)) {
        return back()->with('error', 'Department not found or missing department name');
        }

        $departmentUsername = (string) $department->department_username;
        $departmentName = (string) $department->department_name;
        $sheet = $this->spreadsheet->getActiveSheet();
        $kontrak_id = 'KM_' . $this->selectedYear;
        $iku_id = 'IKU' . str_replace(' ', '_', $departmentUsername) . '_' .  $this->selectedYear;

        $sasaranStrategis = DB::table('sasaran_strategis')
            ->where('kontrak_id', $kontrak_id)
            ->orderBy('id', 'asc')
            ->get();

        $ikuData = DB::table('form_iku')
            ->join('sasaran_strategis', 'form_iku.sasaran_id', '=', 'sasaran_strategis.id')
            ->where('sasaran_strategis.kontrak_id', $kontrak_id)
            ->where('form_iku.iku_id', $iku_id)
            ->select('form_iku.*', 'sasaran_strategis.name as sasaran_name')
            ->get();

        if ($sasaranStrategis->isEmpty() || $ikuData->isEmpty()) {
            throw new \Exception("No data found for kontrak_id: " . $kontrak_id);
        }

        $sasaranGrouped = [];
        $number = 1;
        foreach ($sasaranStrategis as $sasaran) {
            $sasaranGrouped[$sasaran->id] = [
                'number' => $number,
                'name' => $sasaran->name,
                'ikus' => [],
            ];
            $number++;
        }

        foreach ($ikuData as $iku) {
            $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku;
        }

        // Enable Wrap Text for ALL Cells
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setWrapText(true);

        $row = 11;
        foreach ($sasaranGrouped as $sasaran) {
            $ikuCount = count($sasaran['ikus']);

            foreach ($sasaran['ikus'] as $index => $iku) {
                $mergeEndRow = $row + $ikuCount - 1;

                if ($index == 0) {
                    $sheet->mergeCells("B{$row}:B{$mergeEndRow}");
                    $sheet->setCellValue("B{$row}", $sasaran['name']);

                    $sheet->mergeCells("A{$row}:A{$mergeEndRow}");
                    $sheet->setCellValue("A{$row}", $sasaran['number']);

                    $sheet->getStyle("A{$row}:A{$mergeEndRow}")->applyFromArray([
                        'font' => ['bold' => true],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'D0CECE']
                            ]
                        ]
                    ]);

                    $sheet->getStyle("B{$row}:B{$mergeEndRow}")->applyFromArray([
                        'font' => ['bold' => true],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'D0CECE']
                            ]
                        ]
                    ]);
                }

                // Alternating Row Colors
                $backgroundColor = ($row % 2 == 0) ? 'DBE9F9' : 'EFF7FF';

                $sheet->getStyle("C{$row}:L{$row}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'D0CECE']
                        ]
                    ]
                ]);
                $sheet->setCellValue("B3", "Indikator Kinerja Utama (IKU) Tahun {$this->selectedYear}");
                $sheet->getStyle("B3")->getFont()->setBold(true)->setSize(22);
                $sheet->setCellValue("B5", $departmentName);
                $sheet->getStyle("B5")->getFont()->setBold(true)->setSize(22);

                // iku Data
                $sheet->setCellValue("C{$row}", $iku->iku_atasan);
                $sheet->setCellValue("D{$row}", $iku->target);
                $sheet->setCellValue("E{$row}", ($index + 1) . ". " .$iku->iku);
                $sheet->setCellValue("F{$row}", $iku->base ?? '-');
                $sheet->setCellValue("G{$row}", $iku->stretch);
                $sheet->setCellValue("H{$row}", $iku->satuan);
                $sheet->setCellValue("I{$row}", ucfirst($iku->polaritas));
                $sheet->setCellValue("J{$row}", $iku->bobot);
                $sheet->setCellValueExplicit("K{$row}", e($iku->proker), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue("L{$row}", $iku->pj);

                $row++;
            }
        }
    }

    public function export()
    {
        $this->populateData();
        $nama = Auth::user()->nama;
        $department_id = Auth::user()->department_id;
        $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_username')
        ->first();

        if (!$department || !isset($department->department_username)) {
        return back()->with('error', 'Department not found or missing department name');
        }

        $departmentName = (string) $department->department_username;

        $filePath = storage_path("app/Form_IKU_ {$departmentName}_{$this->selectedYear}.xlsx");
        $writer = new Xlsx($this->spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
