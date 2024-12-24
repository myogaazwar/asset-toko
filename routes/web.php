<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAssetMasukController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard_index');
    Route::get('/dashboard/create', function () {
        return view('dashboard.create');
    })->name('page_create');
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'page_edit'])->name('page_edit');


    Route::post('/dashboard/create', [DashboardController::class, 'store'])->name('create_asset');
    Route::put('/dashboard/edit/{id}', [DashboardController::class, 'update'])->name('update_asset');
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('destroy_asset');


    Route::resource('/dashboard/assetmasuk', DashboardAssetMasukController::class);
    Route::put('/dashboard/assetmasuk/approve/{id}', [DashboardAssetMasukController::class, 'approve'])->name('approve_assetmasuk');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
