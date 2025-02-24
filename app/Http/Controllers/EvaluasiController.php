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

    $selectedYear = $request->query('year', date('Y'));

    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $selectedMonth = $request->query('month', date('n'));
    $selectedMonthName = $months[$selectedMonth];

    return view('pages.evaluasi', compact('departmentName', 'selectedYear', 'months', 'selectedMonth', 'selectedMonthName'));
}

public function index(Request $request)
{
    $nama = Auth::user()->nama;
    $selectedYear = $request->query('year', date('Y'));
    $selectedMonth = $request->query('month', date('m'));
    $kontrak_id = 'KM_' . $selectedYear;
    $department_id = Auth::user()->department_id;

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

    return view('pages.form-evaluasi', compact('selectedYear', 'selectedMonth', 'sasaranGrouped', 'sasaranStrategis', 'ikus', 'ikuPoints'));
}


}
