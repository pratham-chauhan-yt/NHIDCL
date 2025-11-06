<?php

use App\Http\Controllers\DocumentManagement\SharingDocumentController;
use App\Http\Controllers\DocumentManagement\UploadDocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('document-management')->name('dms.')->middleware('auth')->group(function () {

    Route::resource('sharing-document', SharingDocumentController::class)->names('sharing');
    Route::resource('upload-document', UploadDocumentController::class)->names('upload');

});
