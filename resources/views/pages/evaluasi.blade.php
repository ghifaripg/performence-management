<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
?>
@extends('layouts.app')

@section('title', 'Evaluasi IKU')

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
                <li class="breadcrumb-item"><a href="/iku">IKU</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pilih Periode</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1>Form Evaluasi Iku {{ $departmentName }} Bulan {{ $selectedMonthName }}</h1>
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
    </div>

    <div class="mt-5">
        <a href="/form-evaluasi" class="btn btn-primary">
            Tambah/Ubah Form Evaluasi
        </a>
    </div>

</main>
@endsection
