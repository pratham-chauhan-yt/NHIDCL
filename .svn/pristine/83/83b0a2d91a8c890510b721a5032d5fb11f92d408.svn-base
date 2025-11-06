<?php

use App\Http\Controllers\TrainingManagement\AttendeeController;
use App\Http\Controllers\TrainingManagement\TrainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('training-management')->middleware(['auth', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->group(function () {
    Route::resource('attendee', AttendeeController::class)
        ->names("attendee");
    Route::resource('trainer', TrainerController::class)
        ->names('trainer');
});
