<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-dashboard', [DashboardsController::class, 'create'])->name('dashboard.create');
    Route::post('/upload-dataset', [DatasetController::class, 'upload'])->name('dataset.upload');
});

require __DIR__.'/auth.php';
