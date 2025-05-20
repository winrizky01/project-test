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
    
    Route::prefix('/vehincles')->group(function(){
        Route::get('/', [App\Http\Controllers\VehincleController::class, 'index']);
        Route::get('/select', [App\Http\Controllers\VehincleController::class, 'search']);
        Route::get('/dataTable', [App\Http\Controllers\VehincleController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\VehincleController::class, 'create']);
        Route::get('/edit/{id}', [App\Http\Controllers\VehincleController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\VehincleController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\VehincleController::class, 'update']);
    });

    Route::prefix('/drivers')->group(function(){
        Route::get('/', [App\Http\Controllers\DriverController::class, 'index']);
        Route::get('/select', [App\Http\Controllers\DriverController::class, 'search']);
        Route::get('/dataTable', [App\Http\Controllers\DriverController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\DriverController::class, 'create']);
        Route::get('/edit/{id}', [App\Http\Controllers\DriverController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\DriverController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\DriverController::class, 'update']);
    });

    Route::prefix('/bookings')->group(function(){
        Route::get('/', [App\Http\Controllers\BookingController::class, 'index']);
        Route::get('/select', [App\Http\Controllers\BookingController::class, 'search']);
        Route::get('/dataTable', [App\Http\Controllers\BookingController::class, 'datatable']);
        Route::get('/create', [App\Http\Controllers\BookingController::class, 'create']);
        Route::get('/edit/{id}', [App\Http\Controllers\BookingController::class, 'edit']);
        Route::post('/store', [App\Http\Controllers\BookingController::class, 'store']);
        Route::post('/update/{id}', [App\Http\Controllers\BookingController::class, 'update']);
    });

    // Route::prefix('general')->group(function(){
    //     Route::get('/select', [App\Http\Controllers\GeneralController::class, 'select']);
    // });
    // Route::prefix('queue')->group(function(){
    //     Route::get('/', [App\Http\Controllers\QueueController::class, 'index']);
    //     Route::get('/generate-queue', [App\Http\Controllers\QueueController::class, 'number_queue']);
    //     Route::get('/dataTable', [App\Http\Controllers\QueueController::class, 'datatable']);
    //     Route::get('/edit/{id}', [App\Http\Controllers\QueueController::class, 'edit']);
    
    //     Route::post('/registration-queue', [App\Http\Controllers\QueueController::class, 'store']);
    // });
    // Route::prefix('patient')->group(function(){
    //     Route::get('/', [App\Http\Controllers\PatientController::class, 'index']);
    //     Route::get('/select', [App\Http\Controllers\PatientController::class, 'search']);
    //     Route::get('/dataTable', [App\Http\Controllers\PatientController::class, 'datatable']);
    //     Route::get('/registration-patient', [App\Http\Controllers\PatientController::class, 'create']);
    //     Route::get('/edit/{id}', [App\Http\Controllers\PatientController::class, 'edit']);
    //     Route::get('/history', [App\Http\Controllers\ReportController::class, 'history_patient']);
    
    //     Route::post('/registration-patient', [App\Http\Controllers\PatientController::class, 'store']);
    //     Route::post('/registration-patient/update/{id}', [App\Http\Controllers\PatientController::class, 'update']);
    // });
    // Route::prefix('patient-exams')->group(function(){
    //     Route::get('/', [App\Http\Controllers\PatientExamController::class, 'index']);
    //     Route::get('/edit/{id}', [App\Http\Controllers\PatientExamController::class, 'index']);
    //     Route::get('/dataTable', [App\Http\Controllers\PatientExamController::class, 'datatable']);

    //     Route::post('/store', [App\Http\Controllers\PatientExamController::class, 'index']);
    //     Route::post('/update/{id}', [App\Http\Controllers\PatientExamController::class, 'index']);

    // });
});
