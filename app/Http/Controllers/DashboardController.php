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

    // Get selected year from request, fallback to current year
    $selectedYear = $request->query('year', date('Y'));

    // Get selected month from request (if available), fallback to current month
    $selectedMonth = $request->query('month', date('m'));

    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $selectedMonthName = $months[(int) $selectedMonth];

    // Get department name
    $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_username')
        ->first();

    if (!$department || !isset($department->department_username)) {
        return back()->with('error', 'Department not found or missing department name');
    }

    $departmentName = (string) $department->department_username;

    // Get total ADJ per Perspektif (Sasaran Strategis)
    $totalAdjPerSasaran = DB::select("
        SELECT
            ss.name AS perspektif,
            SUM(ie.adj) AS total
        FROM form_iku fi
        LEFT JOIN sasaran_strategis ss ON fi.sasaran_id = ss.id
        LEFT JOIN iku_evaluations ie ON fi.id = ie.iku_id
        LEFT JOIN users u ON ie.user_id = u.id
        LEFT JOIN department d ON u.department_id = d.department_id
        WHERE ie.year = ?
        AND u.department_id = ?
        GROUP BY ss.id, ss.name
        ORDER BY ss.id ASC;
    ", [$selectedYear, $department_id]);

    $totalAdjPerMonth = DB::select("
        SELECT
            ie.month AS month,
            SUM(ie.adj) AS total
        FROM form_iku fi
        LEFT JOIN sasaran_strategis ss ON fi.sasaran_id = ss.id
        LEFT JOIN iku_evaluations ie ON fi.id = ie.iku_id
        LEFT JOIN users u ON ie.user_id = u.id
        LEFT JOIN department d ON u.department_id = d.department_id
        WHERE ie.year = ? AND d.department_id = ?
        GROUP BY ie.month
        ORDER BY ie.month ASC;
    ", [$selectedYear, $department_id]);

    // Prepare adj series for chart
    $adjSeries = array_fill(0, 12, 0); // Ensure months 1-12 exist
    foreach ($totalAdjPerMonth as $data) {
        $adjSeries[(int)$data->month - 1] = (float)$data->total; // Adjust month index for zero-based array
    }

    $adjSeriesJson = json_encode($adjSeries); // Convert to JSON for JavaScript

    return view('pages.dashboard', compact(
        'departmentName',
        'selectedYear',
        'months',
        'selectedMonth',
        'selectedMonthName',
        'totalAdjPerSasaran',
        'adjSeriesJson'
    ));
}
}
