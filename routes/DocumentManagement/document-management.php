<?php

use App\Http\Controllers\DocumentManagement\SharingDocumentController;
use App\Http\Controllers\DocumentManagement\UploadDocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('document-management')->name('dms.')->middleware('auth')->group(function () {

    // Routes of document sharing
    Route::post('storeSharedDocument', [SharingDocumentController::class, 'storeSharedDocument'])
        ->name('storeSharedDocument');
    Route::get('viewSharedFiles', [SharingDocumentController::class, 'viewSharedFiles'])
        ->name('viewSharedFiles');
    Route::get('sharing/pending-and-approved-documents', [SharingDocumentController::class, 'pendingAndApprovedDocuments'])
        ->name('sharing.pendingAndApprovedDocuments');
    Route::resource('sharing', SharingDocumentController::class)->names('sharing');

    // Routes of Office-Order, Circular, SOP etc
    Route::post('storeDocument', [UploadDocumentController::class, 'storeDocument'])
        ->name('storeDocument');
    Route::get('viewFiles', [UploadDocumentController::class, 'viewFiles'])
        ->name('viewFiles');
    Route::get('dashboard', [UploadDocumentController::class, 'dashboard'])
        ->name('dashboard');
    Route::resource('document', UploadDocumentController::class)->names('document');
});
