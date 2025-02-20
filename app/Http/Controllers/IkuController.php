<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\IkuExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IkuController extends Controller
{
    public function showIku(Request $request)
    {
        $nama = Auth::user()->nama;
    $selectedYear = $request->query('year', date('Y'));
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

    // Fetch all IKU and link them to Sasaran Strategis
    $ikus = DB::table('form_iku')
    ->join('isi_iku', 'form_iku.isi_iku_id', '=', 'isi_iku.id')
    ->select(
        'form_iku.*',
        'isi_iku.iku',
        'isi_iku.proker',
        'isi_iku.pj',
        'form_iku.iku_atasan',  // Move this here
        'form_iku.sasaran_id'
    )
    ->get();


    // Fetch IKU Points
    $ikuPoints = DB::table('iku_point')->get()->groupBy('form_iku_id');

    // Grouping Sasaran Strategis with IKUs
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

    foreach ($ikus as $iku) {
        $iku->points = $ikuPoints->get($iku->id, collect()); // Attach points (if any)
        if (isset($sasaranGrouped[$iku->sasaran_id])) {
            $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku;
        }
    }
            return view('pages.iku', compact('nama', 'sasaranStrategis', 'sasaranGrouped', 'ikuPoints', 'selectedYear'));
    }

    public function storeIku(Request $request)
    {
        DB::beginTransaction();
        try {
            $selectedYear = $request->input('year', date('Y'));
            $userId = Auth::id();
            $departmentId = Auth::user()->department_id;

            // Fetch department username
            $department = DB::table('department')
                ->where('department_id', $departmentId)
                ->select('department_username')
                ->first();

            if (!$department) {
                return redirect()->back()->with('error', 'Department not found.');
            }

            $departmentName = str_replace(' ', '_', $department->department_username);
            $ikuIdentifier = 'IKU' . $departmentName . '_' . $selectedYear;

            // Insert into isi_iku table
            $ikuId = DB::table('isi_iku')->insertGetId([
                'iku' => $request->input('iku'),
                'proker' => $request->input('proker'),
                'pj' => $request->input('pj'),
            ]);

            // Insert into form_iku table
            $formIkuId = DB::table('form_iku')->insertGetId([
                'iku_id' => $ikuIdentifier,
                'sasaran_id' => $request->input('sasaran_id'),
                'iku_atasan' => $request->input('iku_atasan'),
                'isi_iku_id' => $ikuId,
                'target' => $request->input('single_target'),
                'base' => $request->input('single_base'),
                'stretch' => $request->input('single_stretch'),
                'satuan' => $request->input('single_satuan'),
                'polaritas' => $request->input('single_polaritas'),
                'bobot' => $request->input('single_bobot'),
            ]);

            // If multiple points are selected, insert into iku_point table
            if ($request->input('iku_type') === 'multiple' && $request->has('points')) {
                $ikuPoints = [];
                foreach ($request->input('points') as $point) {
                    $ikuPoints[] = [
                        'form_iku_id' => $formIkuId,
                        'point_name' => $point['name'],
                        'base' => $point['base'],
                        'stretch' => $point['stretch'],
                        'satuan' => $point['satuan'],
                        'polaritas' => $point['polaritas'],
                        'bobot' => $point['bobot'],
                    ];
                }
                DB::table('iku_point')->insert($ikuPoints);
            }

            // Check if a progres entry already exists for this form_iku
            $existingProgres = DB::table('progres')
                ->where('iku_id', $ikuIdentifier)
                ->exists();

            // If no progres exists for this form_iku, create one
            if (!$existingProgres) {
                DB::table('progres')->insert([
                    'user_id' => $userId,
                    'iku_id' => $ikuIdentifier,
                    'status' => 'Pending',
                    'need_discussion' => null,
                    'meeting_date' => now(),
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'IKU successfully added.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error: ' . $e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Failed to add IKU: ' . $e->getMessage());
        }

    }

    public function index(Request $request)
{
    $nama = Auth::user()->nama;
    $selectedYear = $request->query('year', date('Y'));
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

    // Fetch all IKU and link them to Sasaran Strategis
    $ikus = DB::table('form_iku')
    ->join('isi_iku', 'form_iku.isi_iku_id', '=', 'isi_iku.id')
    ->select(
        'form_iku.*',
        'isi_iku.iku',
        'isi_iku.proker',
        'isi_iku.pj',
        'form_iku.iku_atasan',  // Move this here
        'form_iku.sasaran_id'
    )
    ->get();


    // Fetch IKU Points
    $ikuPoints = DB::table('iku_point')->get()->groupBy('form_iku_id');

    // Grouping Sasaran Strategis with IKUs
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

    foreach ($ikus as $iku) {
        $iku->points = $ikuPoints->get($iku->id, collect()); // Attach points (if any)
        if (isset($sasaranGrouped[$iku->sasaran_id])) {
            $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku;
        }
    }

    return view('pages.form-iku', compact('nama', 'sasaranStrategis', 'sasaranGrouped', 'ikuPoints', 'selectedYear'));
}


public function checkOrCreateIku(Request $request)
{
if (!Auth::check()) {
    return redirect()->route('login')->with('error', 'You must be logged in');
}

$selectedYear = $request->input('year', date('Y'));
$createdBy = Auth::user()->nama;
$department_id = Auth::user()->department_id;

$department = DB::table('department')
    ->where('department_id', $department_id)
    ->select('department_username')
    ->first();

if (!$department || !isset($department->department_username)) {
    return back()->with('error', 'Department not found or missing department name');
}

$departmentName = (string) $department->department_username;
$iku_id = 'IKU' . str_replace(' ', '_', $departmentName) . '_' .  $selectedYear;

$iku = DB::table('iku')->where('iku_id', $iku_id)->first();

if (!$iku) {
    DB::table('iku')->insert([
        'iku_id' => $iku_id,
        'tahun' => $selectedYear,
        'department_name' => $departmentName,
        'created_by' => $createdBy,
    ]);
}

return redirect()->route('form-iku', ['year' => $selectedYear]);
}

    public function deleteIku($id)
    {
        DB::table('form_iku')->where('id', $id)->delete();
        return redirect()->route('form-iku')->with('success', 'KPI deleted successfully!');
    }

    public function detail(Request $request, $id)
{
    $selectedYear = $request->query('year', date('Y'));
    $kontrak_id = 'KM_' . $selectedYear;

    $sasaranStrategis = DB::table('sasaran_strategis')
        ->where('kontrak_id', $kontrak_id)
        ->get();

    $ikuData = DB::table('form_iku')
        ->join('sasaran_strategis', 'form_iku.sasaran_id', '=', 'sasaran_strategis.id')
        ->where('sasaran_strategis.kontrak_id', $kontrak_id)
        ->where('form_iku.iku_id', $id)
        ->select('form_iku.*', 'sasaran_strategis.name as sasaran_name')
        ->get();


    $sasaranGrouped = [];
    $number = '1';
    foreach ($sasaranStrategis as $sasaran) {
        $sasaranGrouped[$sasaran->id] = [
            'number' => $number,
            'perspektif' => $sasaran->name,
            'ikus' => [],
        ];
        $number++;
    }

    $progresData = DB::table('progres')
    ->join('iku', 'progres.iku_id', '=', 'iku.iku_id')
    ->where('progres.iku_id', $id)
    ->select(
        'progres.id',
        'progres.iku_id',
        'iku.department_name as Nama Department',
        'iku.tahun as Tahun',
        'progres.status',
        'progres.need_discussion',
        'progres.meeting_date',
        'progres.notes'
    )
    ->get();


    foreach ($ikuData as $iku) {
        if (isset($sasaranGrouped[$iku->sasaran_id])) {
            $sasaranGrouped[$iku->sasaran_id]['ikus'][] = $iku;
        }
    }

    if ($ikuData->isEmpty()) {
        return redirect()->route('progres.index')->with('error', 'IKU not found.');
    }

    return view('pages.detail', compact('sasaranStrategis', 'progresData', 'sasaranGrouped', 'ikuData', 'selectedYear'));
}

public function exportIku(Request $request)
    {
        $name = Auth::user()->name;
        $year = $request->query('year', date('Y'));
        $export = new IkuExport($year, $name);

        return $export->export();
    }

}
