<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\IkuExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EvaluasiController extends Controller
{
    public function showEvaluasi(Request $request)
    {
        $user = Auth::user();

        $departmentName = DB::table('department')
            ->where('department_id', $user->department_id)
            ->value('department_username');

        // Get selected month and year from request (default: current month & year)
        $monthYear = $request->query('month-year', date('Y-m')); // Example: "2025-02"

        // Ensure it's properly formatted before processing
        if (preg_match('/^\d{4}-\d{2}$/', $monthYear)) {
            [$selectedYear, $selectedMonth] = explode('-', $monthYear);
        } else {
            $selectedYear = date('Y');
            $selectedMonth = date('n'); // Get current month as integer
        }

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $selectedMonth = (int) $selectedMonth; // Convert to integer for array indexing
        $selectedMonthName = $months[$selectedMonth] ?? 'Unknown'; // Fallback in case of error

        // Fetch IKU Evaluations for the selected month and year
        $evaluations = DB::select("
            SELECT
                ie.id,
                ie.iku_id,
                ie.point_id,
                ie.polaritas,
                ie.bobot,
                ie.satuan,
                ie.base,
                ie.target_bulan_ini,
                ie.target_sdbulan_ini,
                ie.realisasi_bulan_ini,
                ie.realisasi_sdbulan_ini,
                ie.percent_target,
                ie.percent_year,
                ie.ttl,
                ie.adj,
                ie.penyebab_tidak_tercapai,
                ie.program_kerja,
                isi.iku AS iku_name,
                ip.point_name AS sub_point_name
            FROM iku_evaluations ie
            LEFT JOIN form_iku fi ON ie.iku_id = fi.id
            LEFT JOIN isi_iku isi ON fi.isi_iku_id = isi.id
            LEFT JOIN iku_point ip ON ie.point_id = ip.id
            WHERE ie.year = ? AND ie.month = ?
            ORDER BY fi.id, ie.id ASC
        ", [$selectedYear, $selectedMonth]);

        return view('pages.evaluasi', compact(
            'departmentName',
            'selectedYear',
            'months',
            'selectedMonth',
            'selectedMonthName',
            'evaluations'
        ));
    }



public function index(Request $request)
{
    $nama = Auth::user()->nama;
    $selectedMonth = $request->query('month', date('n'));
    $selectedYear = $request->query('year', date('Y'));
    $kontrak_id = 'KM_' . $selectedYear;
    $department_id = Auth::user()->department_id;

    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $selectedMonth = $request->query('month', date('n'));
    $selectedMonthName = $months[$selectedMonth];

    $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_username')
        ->first();

    if (!$department || !isset($department->department_username)) {
        return back()->with('error', 'Department not found or missing department name');
    }

    $departmentName = (string) $department->department_username;
    $iku_ikuIdentifier = 'IKU' . str_replace(' ', '_', $departmentName) . '_' .  $selectedYear;

    // Fetch all Sasaran Strategis
    $sasaranStrategis = DB::table('sasaran_strategis')
        ->where('kontrak_id', $kontrak_id)
        ->get();

    // Fetch IKUs and their associated main information
    $ikus = DB::table('form_iku')
    ->join('isi_iku', 'form_iku.isi_iku_id', '=', 'isi_iku.id')
    ->where('form_iku.iku_id', $iku_ikuIdentifier)
    ->select(
        'form_iku.*',
        'isi_iku.iku',
        'isi_iku.proker',
        'isi_iku.pj',
        'form_iku.iku_atasan',
        'form_iku.sasaran_id',
        'form_iku.is_multi_point',
        'form_iku.base',
        'form_iku.stretch',
        'form_iku.bobot',
        'form_iku.satuan',
        'form_iku.polaritas'
    )
    ->get();


// Fetch IKU Points
$ikuPoints = DB::table('iku_point')->get()->groupBy('form_iku_id');

// Group Sasaran Strategis
$sasaranGrouped = [];
$number = 1;

foreach ($sasaranStrategis as $sasaran) {
    $sasaranGrouped[$sasaran->id] = [
        'number' => $number,
        'perspektif' => $sasaran->name,
        'ikus' => [],
    ];
    $number++;
}

// Attach IKUs and points
foreach ($ikus as $iku) {
    $iku->points = $ikuPoints->get($iku->id, collect());

    if (isset($sasaranGrouped[$iku->sasaran_id])) {
        $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku;
    }
}

    return view('pages.form-evaluasi', compact('selectedYear', 'selectedMonth', 'sasaranGrouped', 'sasaranStrategis', 'ikus', 'ikuPoints', 'months', 'selectedMonth', 'selectedMonthName'));
}

public function store(Request $request)
    {
        $userId = Auth::id();
        $ikuId = $request->input('selected_iku_id');
        $pointId = $request->input('selected_sub_points');
        $year = $request->input('year');
        $month = $request->input('month');

        $polaritas = $request->input('polaritas');
        $bobot = $request->input('bobot');
        $satuan = $request->input('satuan');
        $base = $request->input('base');
        $targetBulanIni = $request->input('target_bulan_ini');
        $targetSdBulanIni = $request->input('target_sdbulan_ini');
        $realisasiBulanIni = $request->input('realisasi_bulan_ini');
        $realisasiSdBulanIni = $request->input('realisasi_sdbulan_ini');
        $percentTarget = $request->input('percent_target');
        $percentYear = $request->input('percent_year');
        $ttl = $request->input('ttl');
        $adj = $request->input('adj');
        $penyebabTidakTercapai = $request->input('penyebab_tidak_tercapai');
        $programKerja = $request->input('program_kerja');

        DB::insert("
            INSERT INTO iku_evaluations (
                user_id, iku_id, point_id, year, month, polaritas, bobot, satuan, base,
                target_bulan_ini, target_sdbulan_ini, realisasi_bulan_ini, realisasi_sdbulan_ini,
                percent_target, percent_year, ttl, adj, penyebab_tidak_tercapai, program_kerja, created_at, updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $userId, $ikuId, $pointId, $year, $month, $polaritas, $bobot, $satuan, $base,
            $targetBulanIni, $targetSdBulanIni, $realisasiBulanIni, $realisasiSdBulanIni,
            $percentTarget, $percentYear, $ttl, $adj, $penyebabTidakTercapai, $programKerja
        ]);

        return redirect()->back()->with('success', 'Evaluation saved successfully.');
    }

}
