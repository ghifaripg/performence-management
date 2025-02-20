<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\IkuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluasiController;


//Login and Logout Router
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Register Router
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register' ])->name('register.submit');
Route::get('/register-department', [RegisterController::class, 'showRegis'])->name('department.form');
Route::post('/register-department', [RegisterController::class, 'registerDepartment'])->name('department.submit');

//Dashboard Router
Route::get('dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('dashboard');

//Kontrak Page Router
Route::get('/kontrak', [KontrakController::class, 'showKontrak'])->name('show-kontrak');
Route::get('/form-kontrak', [KontrakController::class, 'index'])->name('form-kontrak');
Route::get('/check-kontrak', [KontrakController::class, 'checkOrCreateKontrak'])->name('check-kontrak');
Route::post('/form-sasaran', [KontrakController::class, 'storeSasaran'])->name('store-sasaran');
Route::post('/form-kontrak', [KontrakController::class, 'storeKpi'])->name('store-kpi');
Route::get('/edit-kpi/{id}', [KontrakController::class, 'editKpi'])->name('edit-kpi');
Route::put('/update-kpi/{id}', [KontrakController::class, 'updateKpi'])->name('update-kpi');
Route::delete('/delete-kpi/{id}', [KontrakController::class, 'deleteKpi'])->name('delete-kpi');
Route::delete('/delete-sasaran/{id}', [KontrakController::class, 'deleteSasaran'])->name('delete-sasaran');
Route::get('/export-kontrak', [KontrakController::class, 'exportKontrakManajemen'])->name('export.kontrak');

//Iku Page Router
Route::get('/iku', [IkuController::class, 'showIku'])->name('show-iku');
Route::get('/form-iku', [IkuController::class, 'index'])->name('form-iku');
Route::get('/check-iku', [IkuController::class, 'checkOrCreateIku'])->name('check-iku');
Route::post('/form-iku', [IkuController::class, 'storeIku'])->name('store-iku');
Route::get('/edit-iku/{id}', [IkuController::class, 'editIku'])->name('edit-iku');
Route::put('/update-iku/{id}', [IkuController::class, 'updateIku'])->name('update-iku');
Route::delete('/delete-iku/{id}', [IkuController::class, 'deleteIku'])->name('delete-iku');
Route::get('/iku/{id}/detail', [IkuController::class, 'detail'])->name('iku.detail');
Route::get('/export-iku', [IkuController::class, 'exportIku'])->name('export.iku');


// Progress Page Router
Route::middleware(['auth'])->group(function () {
    Route::get('/progres', [ProgresController::class, 'index'])->name('progres.index');
    Route::get('/progres/create', [ProgresController::class, 'create'])->name('progres.create');
    Route::post('/progres', [ProgresController::class, 'store'])->name('progres.store');

    // Restrict edit, update, and delete to admin (handled inside the controller)
    Route::get('/progres/{id}/edit', [ProgresController::class, 'edit'])->name('progres.edit');
    Route::put('/progres/{id}', [ProgresController::class, 'update'])->name('progres.update');
    Route::delete('/progres/{id}', [ProgresController::class, 'destroy'])->name('progres.destroy');
});

//User Page Router
Route::get('/users', [UserController::class, 'showAll']);
Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update/{id}', [UserController::class, 'update']);

//Profile Page Router
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/update-username', [ProfileController::class, 'updateUsername'])->name('profile.updateUsername');


//Signature Page Router
Route::get('signature', function () {
    return view('pages.signature');
})->middleware('auth')->name('signature');

//Evaluasi Page Router
Route::get('/evaluasi', [EvaluasiController::class, 'showEvaluasi'])->name('show-evaluasi');
Route::get('/form-evaluasi', [EvaluasiController::class, 'index'])->name('form-evaluasi');
