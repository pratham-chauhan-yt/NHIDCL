<?php

use App\Http\Controllers\GrievanceController;
use Illuminate\Support\Facades\Route;



Route::prefix('grievance')->middleware('auth')->group(function () {
    Route::get('/dashboard', [GrievanceController::class, 'dashboard'])->name('grievance.dashboard');
    Route::resource('application', GrievanceController::class)->names('grievance');
});

