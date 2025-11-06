<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpUserController;
use App\Http\Controllers\ApplicantController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::controller(EmpUserController::class)->group(function ()
    {
        Route::get('user-emp', 'index')->name('user-emp.create');
        Route::post('user-emp/store', 'store')->name('employeeUser.store');
        Route::get('user-emp/view','view')->name('user-emp.view');
        Route::get('user-emp/edit/{id}','edit')->name('user-emp.edit');
        Route::get('user-emp/show/{id}','show')->name('user-emp.show');
        Route::post('user-emp/update','update')->name('employeeUser.update');
    });



    Route::get('/applicant-register', [ApplicantController::class, 'index'])->name('user-emp.applicant-register');

