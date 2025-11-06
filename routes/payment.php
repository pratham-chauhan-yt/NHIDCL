<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::prefix('payment')->middleware('auth:recruitment')->name('payment.')->group(function () {
    Route::get("/", [PaymentController::class, "index"])->name("index");
    Route::post("pay", [PaymentController::class, "pay"])->name("pay");
});

Route::any("payment/callback", [PaymentController::class, "paymentCallback"])->name("payment.callback");