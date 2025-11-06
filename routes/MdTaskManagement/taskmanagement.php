<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskManagement\TaskManagementController;

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

// Route::prefix('/md-task-management')->middleware(['auth', 'twofactor', 'no.cache', 'secure.headers', 'XSS'])->group(function () {
//     Route::get('index',[TaskManagementController::class,'index'])->name('md-task-management.index');
//     Route::get('create_task',[TaskManagementController::class,'get_create_task'])->name('md-task-management.create-task');
//     Route::get('task_list',[TaskManagementController::class,'get_task_list'])->name('md-task-management.task-list');
//     Route::get('assign_task',[TaskManagementController::class,'get_assign_task'])->name('md-task-management.assign-task');
// });
