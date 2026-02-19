<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'redirectToDashboardOrLogin']);

// Authentication Routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showloginform'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::prefix('/users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/show', [UserController::class, 'show'])->name('show');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/toggle-status', [UserController::class, 'toggleStatus'])->name('toggleStatus');
        Route::get('/datatable', [UserController::class, 'dataTable'])->name('dataTable');
    });

    // Role Management
    Route::prefix('/roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/show', [RoleController::class, 'show'])->name('show');
        Route::get('/edit', [RoleController::class, 'edit'])->name('edit');
        Route::post('/update', [RoleController::class, 'update'])->name('update');
        Route::delete('/destroy', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/datatable', [RoleController::class, 'dataTable'])->name('dataTable');
    });

    Route::prefix('ui')->name('ui.')->group(function () {
        Route::get('/buttons', fn() => view('pages.ui.buttons'))->name('buttons');
        Route::get('/dropdowns', fn() => view('pages.ui.dropdowns'))->name('dropdowns');
        Route::get('/typography', fn() => view('pages.ui.typography'))->name('typography');
    });

    Route::get('/forms/basic', fn() => view('pages.forms.basic_elements'))->name('forms.basic');
    Route::get('/tables/basic', fn() => view('pages.tables.basic-table'))->name('tables.basic');
    Route::get('/charts/chartjs', fn() => view('pages.charts.chartjs'))->name('charts.chartjs');
    Route::get('/icons/font-awesome', fn() => view('pages.icons.font-awesome'))->name('icons.fontawesome');
    Route::get('/blank-page', fn() => view('pages.samples.blank-page'))->name('samples.blank');
});

// Fallback for 404
// Route::fallback(fn() => abort(404));
