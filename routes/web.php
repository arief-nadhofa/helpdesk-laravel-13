<?php

use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LayoutController::class, 'index'])->name('/');
Route::get('dashboard', [LayoutController::class, 'dashboard'])->name('dashboard');

Route::post('proses-login', [LayoutController::class, 'proses_login'])->name('proses-login');
Route::post('proses-logout', [LayoutController::class, 'proses_logout'])->name('proses-logout');
