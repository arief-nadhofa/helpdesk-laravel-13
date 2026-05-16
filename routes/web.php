<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LayoutController::class, 'index'])->name('/');
Route::get('dashboard', [LayoutController::class, 'dashboard'])->name('dashboard');


// CLIENT
Route::get('dashboard-client', [LayoutController::class, 'client_dashboard'])->name('dashboard-client');
Route::post('store-client', [TicketController::class, 'store_client'])->name('store-client');

Route::post('proses-login', [LayoutController::class, 'proses_login'])->name('proses-login');
Route::post('proses-logout', [LayoutController::class, 'proses_logout'])->name('proses-logout');

Route::resource('ticket', TicketController::class);
Route::resource('account', AccountController::class);
Route::resource('category', CategoryController::class);
