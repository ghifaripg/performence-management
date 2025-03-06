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
    $nama = Auth::user()->nama;
    $department_id = Auth::user()->department_id;
    $user_id = Auth::user()->id;

    // Get selected year and month from request, fallback to current year/month
    $selectedYear = $request->query('year', date('Y'));
    $selectedMonth = (int) substr($request->query('month', date('m')), -2);

    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $selectedMonthName = $months[$selectedMonth] ?? 'Unknown'; // Prevent undefined index error


    // Get selected department from request (admin can select, others use their own)
    $selectedDepartment = $request->query('department', $user_id == 1 ? null : $department_id);

    // Get department name or set default for "Semua"
    if ($selectedDepartment) {
        $department = DB::table('department')
            ->where('department_id', $selectedDepartment)
            ->select('department_username')
            ->first();
        $departmentName = $department->department_username ?? 'Unknown';
    } else {
        $departmentName = 'Semua Unit Kerja';
    }

    // Fetch all departments (for admin dropdown)
    $departments = DB::table('department')->select('department_id', 'department_name')->get();

    // Query for total ADJ per Sasaran Strategis
    $queryParamsSasaran = [$selectedYear, $selectedMonth]; // Includes year and month
    $whereDepartment = "";

    if (!empty($selectedDepartment)) {
        $whereDepartment = "AND u.department_id = ?";
        $queryParamsSasaran[] = $selectedDepartment; // Add department condition
    }

    $totalAdjPerSasaran = DB::select("
        SELECT
            ss.name AS perspektif,
            SUM(ie.adj) AS total
        FROM form_iku fi
        LEFT JOIN sasaran_strategis ss ON fi.sasaran_id = ss.id
        LEFT JOIN iku_evaluations ie ON fi.id = ie.iku_id
        LEFT JOIN users u ON ie.user_id = u.id
        WHERE ie.year = ? AND ie.month = ?
        $whereDepartment
        GROUP BY ss.id, ss.name
        ORDER BY ss.id ASC;
    ", $queryParamsSasaran);

    // Query for total ADJ per Month
    $queryParamsMonth = [$selectedYear];
    $whereDepartment = "";

    if (!empty($selectedDepartment)) {
        $whereDepartment = "AND u.department_id = ?";
        $queryParamsMonth[] = $selectedDepartment;
    }

    $totalAdjPerMonth = DB::select("
        SELECT
            ie.month AS month,
            SUM(ie.adj) AS total
        FROM form_iku fi
        LEFT JOIN iku_evaluations ie ON fi.id = ie.iku_id
        LEFT JOIN users u ON ie.user_id = u.id
        WHERE ie.year = ?
        $whereDepartment
        GROUP BY ie.month
        ORDER BY ie.month ASC;
    ", $queryParamsMonth);

    // Prepare adj series for chart
    $adjSeries = array_fill(0, 12, 0); // Ensure months 1-12 exist
    foreach ($totalAdjPerMonth as $data) {
        $adjSeries[(int)$data->month - 1] = (float)$data->total;
    }
    $adjSeriesJson = json_encode($adjSeries);

    return view('pages.dashboard', compact(
        'departments',
        'selectedDepartment',
        'departmentName',
        'selectedYear',
        'selectedMonth',
        'selectedMonthName',
        'totalAdjPerSasaran',
        'adjSeriesJson'
    ));
}
}
