<?php

use App\Http\Controllers\BankManagement\BgController;
use App\Http\Controllers\BankManagement\FinanceController;
use App\Http\Controllers\BankManagement\ProjectController;
use App\Http\Controllers\BankManagement\VerifierController;
use Illuminate\Support\Facades\Route;

Route::prefix('bank-guarantee-management-system')->name('bgms.')->middleware('auth')->group(function () {
    Route::get('bg/renew/{id}', [BgController::class, 'renew'])->name('bg.renew');
    Route::get('bg/track_status/{id}', [BgController::class, 'track_status'])->name('bg.track_status');
    Route::get('bg/track_lodge/{id}', [BgController::class, 'track_lodge'])->name(name: 'bg.track_lodge');
    Route::post('bg/renew', [BgController::class, 'renewStore'])->name('bg.renew.store');
    Route::get('bg/accepted', [BgController::class, 'accepted'])->name('bg.accepted');
    Route::post('bg/upload', [BgController::class, 'upload'])->name('bg.upload');
    Route::get('bg/view', [BgController::class, 'view'])->name('bg.view');
    Route::get('bg/receive', [BgController::class, 'receive'])->name('bg.receive');
    Route::get('bg/archive', [BgController::class, 'archive'])->name('bg.archive');
    Route::get('bg/finance-returned', [BgController::class, 'financeReturned'])->name('bg.frt');
    Route::put('bg/finance-returned/{id}', [BgController::class, 'financeReturnedUpdate'])->name('bg.frt.update');
    Route::put('bg/receive/{id}', [BgController::class, 'receiveUpdate'])->name('bg.receive.update');

    Route::get('bg/search', [BgController::class, 'search'])->name('bg.search'); //new
    Route::get('/bg/encashment', [BgController::class, 'encashmentList'])->name('bg.encashment'); //new
    Route::get('/bg/claimlodge', [BgController::class, 'claimlodgeList'])->name('bg.claimlodge'); //new

    Route::get('bg/type', [BgController::class, 'type'])->name('bg.type'); //New Pratham
    Route::get('/bg/encashment_search', [BgController::class, 'encashmentSearch'])->name('bg.encashmentSearch'); //New Pratham


    Route::get('project/list', [ProjectController::class, 'list'])->name('project.list'); //New Pratham
    Route::get('project/dashboard', [ProjectController::class, 'dashboard'])->name('project.dashboard'); // New Pratham
    Route::post('project/state_search', [ProjectController::class, 'stateSearch'])->name('project.stateSearch'); //New Pratham


    Route::resource('project', ProjectController::class)->names('project');
    Route::resource('bg', BgController::class)->names('bg');

    Route::prefix("verifier")->name('verifier.')->group(function () {
        Route::get('/', [VerifierController::class, 'index'])->name('index');
        Route::post('/renew', [VerifierController::class, 'renewUpdate'])->name('renew.update');
        Route::put('/verify/{id}', [VerifierController::class, 'verify'])->name('verify');
        Route::put('/referback/{id}', [VerifierController::class, 'referback'])->name('referback');
        Route::get('/show/{id}', [VerifierController::class, 'show'])->name('show');
        Route::put('/verify-renew/{id}', [VerifierController::class, 'verifyRenew'])->name('verify.renew');
        Route::put('/referback-renew/{id}', [VerifierController::class, 'referbackRenew'])->name('referback.renew');
        Route::get('/show-bg-detail/{id}', [VerifierController::class, 'showbgdetail'])->name('showbgdetail');
    });
    Route::prefix("finance")->name('finance.')->group(function () {
        Route::get('receive-refer', [FinanceController::class, 'receiveRefer'])->name('receive.refer');
        // Route::get('receive', [FinanceController::class, 'receive'])->name('receive');
        Route::put('/receive/{id}', [FinanceController::class, 'receiveUpdate'])->name('receive.update');
        Route::put('/referback/{id}', [FinanceController::class, 'referback'])->name('referback');
        Route::get('accept-refer', [FinanceController::class, 'accept'])->name('accept');
        Route::get('/show/{id}', [FinanceController::class, 'show'])->name('show');
        Route::get('/acceptshow/{id}', [FinanceController::class, 'acceptshow'])->name('acceptshow');
        Route::post('/accept-refer', [FinanceController::class, 'acceptReferStore'])->name('accept-refer.store');
        Route::get('/accepted', [FinanceController::class, 'accepted'])->name('accepted');
        Route::put('/accepted/{id}', [FinanceController::class, 'acceptedUpdate'])->name('accepted.update');
        //Route::post('/updatereceive', [FinanceController::class, 'updateReceive'])->name('update.receive');
        Route::post('/updatereceive/{id}', [FinanceController::class, 'updateReceive'])->name('update.receive');
        Route::get('/showrenew/{id}', [FinanceController::class, 'showRenew'])->name('showrenew');
        Route::get('/accept-renew/{id}', [FinanceController::class, 'acceptRenew'])->name('acceptRenew');
        Route::post('/finance-accept-renew/{id}', [FinanceController::class, 'financeAcceptRenew'])->name('update.financeacceptrenew');
        Route::post('/accept-refer', [FinanceController::class, 'acceptReferStoreRenew'])->name('accept-refer.storerenew');
        Route::post('/accept-refer-bg', [FinanceController::class, 'acceptReferStorebg'])->name('accept-refer.storebg');
    });
});
