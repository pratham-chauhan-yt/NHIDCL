<?php

use App\Http\Controllers\TaskManagementController;
use Illuminate\Support\Facades\Route;

/* Created by Mayank Raghav */
Route::prefix('task-management')->middleware(['auth', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->name('task-management.')->group(function () {
    Route::get('/dashboard', [TaskManagementController::class, 'dashboard'])->name('dashboard');
    Route::get('/view', [TaskManagementController::class, 'view'])->name('view');
    // Resource routes
    Route::resource('/', TaskManagementController::class)
        ->parameters(['' => 'id'])
        ->names([
            'index'   => 'index',
            'create'  => 'create',
            'store'   => 'store',
            'show'    => 'show',
            'edit'    => 'edit',
            'update'  => 'update',
            'destroy' => 'destroy',
        ]);

    // Custom routes
    Route::put('/complete/{id}', [TaskManagementController::class, 'complete'])->name('complete');
    Route::post('/upload', [TaskManagementController::class, 'upload'])->name('upload');
    Route::get('/reply/{id}', [TaskManagementController::class, 'getReplies'])->name('replies');
    Route::post('/reply', [TaskManagementController::class, 'reply'])->name('reply');
});
