<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
@extends('layouts.app')

@section('title', 'Detail')

@section('content')

<main class="content">
    @section('content')
      <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="/dashboard">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="/progres"> Progres</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Form</li>
            </ol>
        </nav>

    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="border-0 rounded-start text-center" rowspan="2">#</th>
                    <th class="border-0 text-center" rowspan="2">Perspektif</th>
                    <th class="border-0 text-center" colspan="2">Key Address</th>
                    <th class="border-0 text-center" rowspan="2" style="white-space: nowrap">Indikator Kerja Utama</th>
                    <th class="border-0 text-center" colspan="2">Target</th>
                    <th class="border-0 text-center" rowspan="2">Satuan</th>
                    <th class="border-0 text-center" rowspan="2">Polaritas</th>
                    <th class="border-0 text-center" rowspan="2">Bobot</th>
                    <th class="border-0 text-center" rowspan="2" style="white-space: normal">Program Kerja</th>
                    <th class="border-0 rounded-end text-center" rowspan="2">Penanggung Jawab</th>
                </tr>
                <tr>
                    <th class="border-0 text-center">IKU Atasan</th>
                    <th class="border-0 text-center">Target</th>
                    <th class="border-0 text-center">Base</th>
                    <th class="border-0 text-center">Stretch</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sasaranGrouped as $sasaran)
                    @php
                        $rowCount = isset($sasaran['ikus']) ? count($sasaran['ikus']) : 0;
                    @endphp
                    @foreach($sasaran['ikus'] as $index => $iku)
                        <tr>
                            @if ($index == 0)
                                <td class="fw-bold align-middle text-center" rowspan="{{ $rowCount }}">{{ $sasaran['number'] }}</td>
                                <td class="fw-normal align-middle text-center" rowspan="{{ $rowCount }}">{{ $sasaran['perspektif'] }}</td>
                            @endif
                            <td class="fw-normal text-center">{{ $iku->iku_atasan ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ $iku->target ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ $index + 1 }}. {{ $iku->iku ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ $iku->base ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ $iku->stretch ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ $iku->satuan ?? '-' }}</td>
                            <td class="fw-normal text-center">{{ ucfirst($iku->polaritas ?? '-') }}</td>
                            <td class="fw-normal text-center">{{ $iku->bobot ?? '-' }}</td>
                            <td class="fw-normal text-center">{!! nl2br(e($iku->proker ?? '-')) !!}</td>
                            <td class="fw-normal text-center">{{ $iku->pj ?? '-' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        <a href="/progres" class="btn btn-primary">
            Back
        </a>
    </div>
</main>

@endsection
