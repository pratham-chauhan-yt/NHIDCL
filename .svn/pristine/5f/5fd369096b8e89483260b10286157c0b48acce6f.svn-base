<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrievanceManagement\GrievanceController;

/* Created by Mayank Raghav */
Route::middleware(['auth', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->prefix('grievance-management')->as('grievance-management.')->group(function () {
    Route::get('dashboard', [GrievanceController::class, 'dashboard'])->name('dashboard');
    Route::resource('grievance', GrievanceController::class);
    Route::get('grievance/details/{grievance}', [GrievanceController::class, 'viewDetails'])->name('grievance.details');
    Route::post('grievance/{grievance}/comment', [GrievanceController::class, 'addComment'])->name('grievance.comment');
    Route::post('grievance/{grievance}/status', [GrievanceController::class, 'changeStatus'])->name('grievance.change.status');
    Route::get('grievance/{grievance}/attachment', [GrievanceController::class, 'downloadAttachment'])->name('grievance.attachment');
    Route::post('/grievances/{id}/feedback', [GrievanceController::class, 'storeFeedback'])->name('grievances.feedback');
    Route::post('upload/files', [GrievanceController::class, 'storeFiles'])->name('upload.file');
    Route::get('view/files', [GrievanceController::class, 'viewFiles'])->name('view.files');
    Route::post('/delete/file', [GrievanceController::class, 'deleteFile'])->name('delete-file');        
});