<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
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
                                    <div class="fs-5 fw-normal mb-2">Sales Value</div>
                                    <h2 class="fs-3 fw-extrabold">$10,567</h2>
                                    <div class="small mt-2">
                                        <span class="fw-normal me-2">Yesterday</span>
                                        <span class="fas fa-angle-up text-success"></span>
                                        <span class="text-success fw-bold">10.57%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-4 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                <h2 class="fs-5 fw-bold mb-0">Progress track</h2>
                                 <a href="#" class="btn btn-sm btn-primary">See tasks</a>
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
                                                <div class="h6 mb-0">Rocket - SaaS Template</div>
                                                <div class="small fw-bold text-gray-500"><span>75 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
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
                                                <div class="h6 mb-0">Themesberg - Design System</div>
                                                <div class="small fw-bold text-gray-500"><span>60 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
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
                                                <div class="h6 mb-0">Homepage Design in Figma</div>
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
                                                <div class="h6 mb-0">Backend for Themesberg v2</div>
                                                <div class="small fw-bold text-gray-500"><span>34 %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%;"></div>
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
@endsection
