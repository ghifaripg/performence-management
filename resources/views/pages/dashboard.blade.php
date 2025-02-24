<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    $department_id = Auth::user()->department_id;
    $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_name')
        ->first();
    $departmentName = (string) $department->department_name;
    ?>
@extends('layouts.app')

@section('title', 'Dashboard')
    <main class="content">
            @section('content')
            <div class="py-4">
                <div class="dropdown">
                    <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        New Task
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="/kontrak">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                            Lihat Kontrak
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/iku">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                            Lihat IKU
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/progres">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                            Progres
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card bg-yellow-100 border-0 shadow">
                            <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                                <div class="d-block mb-3 mb-sm-0">
                                    <div class="fs-5 fw-normal mb-2">Performance Management - Capaian IKU (Indikator Kinerja Utama)</div>
                                    <h2 class="fs-3 fw-extrabold">Unit Kerja: <?php echo $departmentName ?></h2>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                            </div>
                        </div>
                    </div>
            <div class="col-12 col-xl-8">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="fs-5 fw-bold mb-0">Total Skor IKU Perspektif (Perbandingan Per Tahun)</h2>
                                        <form method="GET" class="mb-3">
                                            <label for="month" class="form-label">Pilih Periode:</label>
                                            <select name="month" id="month" class="form-select w-auto d-inline">
                                                @foreach ($months as $num => $monthName)
                                                    <option value="{{ $num }}" @if ($num == $selectedMonth) selected @endif>
                                                        {{ $monthName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Pilih</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-center" style="background-color: #F3F2F2; color:black" rowspan="2">No</th>
                                                <th class="border-0 text-center" style="background-color: #F3F2F2; color:black" rowspan="2">Perspektif</th>
                                                <th class="border-0 text-center" style="background-color: #F3F2F2; color:black" rowspan="2">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-normal text-center" style="border-color: white">1</td>
                                                <td class="fw-normal text-center" style="border-color: white">Nilai Ekonomi dan Sosial</td>
                                                <td class="fw-normal text-center iku-cell" style="border-color: white">12</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <small class="text-tertiary mb-0">Total Skor = <span id="total-iku">0</span></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="col-12 col-sm-6 col-xl-4 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                <h2 class="fs-5 fw-bold mb-0">Progres Form IKU</h2>
                                 <a href="/iku" class="btn btn-sm btn-primary">Isi Form IKU</a>
                             </div>
                            <div class="card-body">
                                <!-- Project 1 -->
                                <div class="row mb-4">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Januari</div>
                                                <div class="small fw-bold text-gray-500"><span>100 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project 2 -->
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Februari</div>
                                                <div class="small fw-bold text-gray-500"><span>75 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project 3 -->
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">Maret</div>
                                                <div class="small fw-bold text-gray-500"><span>45 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project 4 -->
                                <div class="row align-items-center mb-3">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">April</div>
                                                <div class="small fw-bold text-gray-500"><span>0 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateTotalIku() {
                let totalBobot = 0;

                // Select all cells with class "iku-cell" and sum their values
                document.querySelectorAll(".iku-cell").forEach(cell => {
                    let bobotValue = parseFloat(cell.textContent.trim()) || 0;
                    totalBobot += bobotValue;
                });

                // Get the total display element
                let totalBobotElement = document.getElementById("total-iku");
                if (totalBobotElement) {
                    totalBobotElement.textContent = totalBobot.toFixed(2);
                }
            }

            // Call the function to update the total when the page loads
            updateTotalIku();
        });
    </script>
@endsection
