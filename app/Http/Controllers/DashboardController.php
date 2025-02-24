<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\IkuExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function showDashboard(Request $request)
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

    return view('pages.dashboard', compact('departmentName', 'selectedYear', 'months', 'selectedMonth', 'selectedMonthName'));
}

}
