<?php

use App\Http\Controllers\AuditManagement\AuditParaController;

Route::prefix('audit-para-management')->middleware('auth')->name('audit-management.')->group(function () {
    // Route::get('/dashboard', [AuditParaController::class, 'dashboard'])->name('dashboard');

});
