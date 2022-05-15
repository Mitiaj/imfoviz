<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DatasetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/dataset/upload', [DatasetController::class, 'upload'])->name('dataset.upload');
    Route::post('/dashboard/{dashboard}/update-dataset', [DashboardsController::class, 'update'])->name('dashboard.update-dataset');

});
