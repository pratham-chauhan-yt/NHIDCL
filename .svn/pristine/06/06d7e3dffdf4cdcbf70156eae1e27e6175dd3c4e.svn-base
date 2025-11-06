<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeManagement\EmpDashboardController;
use App\Http\Controllers\EmployeeManagement\AttendanceController;
use App\Http\Controllers\EmployeeManagement\LeaveController;
use App\Http\Controllers\EmployeeManagement\FacilitiesController;
use App\Http\Controllers\EmployeeManagement\ClaimExpensesController;
use App\Http\Controllers\EmployeeManagement\SelfServiceController;
use App\Http\Controllers\EmployeeManagement\ExitInterviewController;

    /* Created by Mayank Raghav */

    Route::middleware(['auth', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->prefix('employee-management')->as('employee-management.')->group(function () {
        Route::get('dashboard', [EmpDashboardController::class, 'dashboard'])->name('dashboard');
        Route::match(['get', 'post'], 'hr/employee/attendance', [EmpDashboardController::class, 'empAttendance'])->name('hr.employee.attendance');
        Route::get('hr/employee/attendance/table', [EmpDashboardController::class, 'hrAttendanceTable'])->name('hr.employee.attendance.table');
        Route::match(['get', 'post'], 'hr/assign/asset', [EmpDashboardController::class, 'assignAssets'])->name('hr.assign.asset');
        Route::match(['get', 'post'], 'hr/assign/asset/edit/{id}', [EmpDashboardController::class, 'assignAssetsEdit'])->name('hr.assign.asset.edit');
        Route::delete('hr/assign/asset/delete/{id}', [EmpDashboardController::class, 'assignAssetsDelete'])->name('hr.assign.asset.delete');

        Route::get('hr/assign/asset/table', [EmpDashboardController::class, 'assignAssetsTable'])->name('hr.assign.asset.table');
        Route::get('/get-users-by-division', [EmpDashboardController::class, 'getUsersByDivision'])->name('get.users.by.division');
        
        Route::resource('mark/attendance', AttendanceController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('mark.attendance');
        Route::match(['get', 'post'], 'mark/attendance/checker', [AttendanceController::class, 'checker'])->name('mark.attendance.checker');
        Route::match(['get', 'post'], 'mark/attendance/checker/edit/{id}', [AttendanceController::class, 'approverUpdate'])->name('mark.attendance.checker.edit');
        Route::match(['get', 'post'], 'mark/attendance/approver', [AttendanceController::class, 'approver'])->name('mark.attendance.approver');
        Route::match(['get', 'post'], 'mark/attendance/approver/edit/{id}', [AttendanceController::class, 'approverUpdate'])->name('mark.attendance.approver.edit');
        
        Route::get('calendar', [EmpDashboardController::class, 'calendar'])->name('calendar');
        
        Route::resource('apply/leave', LeaveController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('apply.leave');
        Route::match(['get', 'post'], 'apply/leave/checker', [LeaveController::class, 'checker'])->name('apply.leave.checker');
        Route::match(['get', 'post'], 'apply/leave/checker/edit/{id}', [LeaveController::class, 'approverUpdate'])->name('apply.leave.checker.edit');
        Route::match(['get', 'post'], 'apply/leave/approver', [LeaveController::class, 'approver'])->name('apply.leave.approver');
        Route::match(['get', 'post'], 'apply/leave/approver/edit/{id}', [LeaveController::class, 'approverUpdate'])->name('apply.leave.approver.edit');
        
        Route::resource('exit/interview', ExitInterviewController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('exit.interview');
        Route::match(['get', 'post'], 'exit/interview/checker', [ExitInterviewController::class, 'checker'])->name('exit.interview.checker');
        Route::match(['get', 'post'], 'exit/interview/checker/edit/{id}', [ExitInterviewController::class, 'approverUpdate'])->name('exit.interview.checker.edit');
        Route::match(['get', 'post'], 'exit/interview/approver', [ExitInterviewController::class, 'approver'])->name('exit.interview.approver');
        Route::match(['get', 'post'], 'exit/interview/approver/edit/{id}', [ExitInterviewController::class, 'approverUpdate'])->name('exit.interview.approver.edit');
        Route::get('exit/interview/table', [ExitInterviewController::class, 'table'])->name('exit.interview.table');
        Route::get('alloted/asset/table', [ExitInterviewController::class, 'allotedAssetTable'])->name('alloted.asset.table');

        Route::resource('other/facilities', FacilitiesController::class)
        ->only(['index', 'create', 'store'])
        ->names('other.facilities');
        Route::match(['get', 'post'], 'hr/policies', [FacilitiesController::class, 'hrPolicies'])->name('hr.policies');
        Route::post('hr/policies/store', [FacilitiesController::class, 'hrPoliciesStore'])->name('hr.policies.store');
        Route::delete('hr/policies/delete/{id}', [FacilitiesController::class, 'deletePolicy'])->name('hr.policies.delete');
        Route::resource('claim/expenses', ClaimExpensesController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->names('claim.expenses');
        Route::get('claim/expenses/table', [ClaimExpensesController::class, 'table'])
        ->name('claim.expenses.table');

        Route::resource('self/service', SelfServiceController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->names('self.service');
        Route::get('self/service/table', [SelfServiceController::class, 'table'])
        ->name('self.service.table');

        Route::post('upload/files', [EmpDashboardController::class, 'storeFiles'])->name('upload.file');
        Route::get('view/files', [EmpDashboardController::class, 'viewFiles'])->name('view.files');
        Route::post('/delete/file', [EmpDashboardController::class, 'deleteFile'])->name('delete-file');

    });