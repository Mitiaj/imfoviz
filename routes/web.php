<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
//    Route::get('/dashboard/create', [DashboardsController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/create', [DashboardsController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{dashboard}/setup', [DashboardsController::class, 'setup'])->name('dashboard.setup');
    Route::get('/dashboard/{dashboard}/preview', [DashboardsController::class, 'preview'])->name('dashboard.preview');

    Route::get('/dashboard/{dashboard}/add-chart', [ChartController::class, 'showForm'])->name('chart.create');
});

require __DIR__.'/auth.php';
