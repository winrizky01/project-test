<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/process-login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'register']);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/dashboard/chart', [App\Http\Controllers\DashboardController::class, 'chartdata']);

    Route::prefix('/vehicles')->group(function(){
        Route::get('/', [App\Http\Controllers\VehicleController::class, 'index']);
        Route::get('/dataTable', [App\Http\Controllers\VehicleController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\VehicleController::class, 'create']);
        Route::get('/edit/{id}', [App\Http\Controllers\VehicleController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\VehicleController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
    });

    Route::prefix('/drivers')->group(function(){
        Route::get('/', [App\Http\Controllers\DriverController::class, 'index']);
        Route::get('/dataTable', [App\Http\Controllers\DriverController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\DriverController::class, 'create']);
        Route::get('/edit/{id}', [App\Http\Controllers\DriverController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\DriverController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\DriverController::class, 'update']);
    });

    Route::prefix('/bookings')->group(function(){
        Route::get('/', [App\Http\Controllers\BookingController::class, 'index']);
        Route::get('/dataTable', [App\Http\Controllers\BookingController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\BookingController::class, 'create']);
        Route::get('/show/{id}', [App\Http\Controllers\BookingController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\BookingController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\BookingController::class, 'update']);
    });

    Route::prefix('/approvals')->group(function(){
        Route::get('/', [App\Http\Controllers\ApprovalController::class, 'index']);
        Route::get('/dataTable', [App\Http\Controllers\ApprovalController::class, 'datatable']);
        Route::post('/{id}', [App\Http\Controllers\ApprovalController::class, 'approval']);
    });
    
    Route::prefix('/report')->group(function(){
        Route::get('/', [App\Http\Controllers\ReportController::class, 'index']);
        Route::get('/dataTable', [App\Http\Controllers\ReportController::class, 'datatable']);
        Route::get('/download', [App\Http\Controllers\ReportController::class, 'exportExcel']);
    });
});
