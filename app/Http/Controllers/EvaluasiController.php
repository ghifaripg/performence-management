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
    $user = Auth::user();
    $nama = $user->nama;
    $userId = $user->id;
    $selectedYear = $request->query('year', date('Y'));
    $kontrak_id = 'KM_' . $selectedYear;

    $sasaranStrategis = DB::table('sasaran_strategis')
        ->where('kontrak_id', $kontrak_id)
        ->get();

    $ikuData = DB::table('form_iku')
        ->join('sasaran_strategis', 'form_iku.sasaran_id', '=', 'sasaran_strategis.id')
        ->where('sasaran_strategis.kontrak_id', $kontrak_id)
        ->select('form_iku.id', 'form_iku.sasaran_id', 'form_iku.iku', 'sasaran_strategis.name as sasaran_name')
        ->get();

    $sasaranGrouped = [];
    $number = 'A';
    foreach ($sasaranStrategis as $sasaran) {
        $sasaranGrouped[$sasaran->id] = [
            'number' => $number,
            'perspektif' => $sasaran->name,
            'ikus' => [],
        ];
        $number++;
    }

    foreach ($ikuData as $iku) {
        if (isset($sasaranGrouped[$iku->sasaran_id])) {
            $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku->iku;
        }
    }

    return view('pages.form-evaluasi', compact('userId', 'nama', 'sasaranStrategis', 'sasaranGrouped', 'ikuData', 'selectedYear'));
}
}
