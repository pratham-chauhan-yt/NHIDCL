<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\{LoginController};
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\Admin\{DashboardController,UserController};
use App\Http\Controllers\Admin\HrSettings\HrSettingsController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\{Controller, CaptchaController, PermissionController,RoleController,ProfileController,LeaveTypeController,OtpController};
use App\Http\Controllers\Auth\{CandidateLoginController,RegistrationController,ResetPasswordController,TwoFactorController};
use App\Http\Controllers\ResourcePool\CandidateController;
use App\Http\Controllers\ResourcePool\Chairperson\SelectionProcessController as ChairpersonSelectionProcessController;
use App\Http\Controllers\ResourcePool\CommitteeMember\SelectionProcessController as CommitteeMemberSelectionProcessController;
use App\Http\Controllers\Admin\MasterSettings\{
    MasterSettingsController,
    StateController,
    CountryController,
    DepartmentController,
    DesignationController,
    OfficeTypeController,
    EmployeeTypeController,
    ConductingAgencyController,
    BoardUniversityCollegeController,
    CourseController,
    DisciplineController,
    ExamController,
    ApplicationStatusController,
    RecruitmentModeController,
    AuditTypeController,
    AuditLevelController,
    AuditQueryTypeController,
    CasteController,
    QmsQueryTypeController,
    AreaExpertiesController,
    BucketController,
    DomainController,
    EngagementController,
    ExpertProfessionalController,
    GateDesciplineController,
    GuaranteeTypeController,
    InterviewStatusController,
    JobTypeController,
    MainSubjectController,
    PostHeldController,
    DmsTypeController,
    DmsTypeOfDocumentController
};
use Illuminate\Support\Facades\Artisan;


require __DIR__ . '/empuser.php';

require __DIR__ . '/employee-management.php';
require __DIR__ . '/AuditManagement/audit-management.php';
require __DIR__ . '/AuditManagement/audit-para-management.php';
require __DIR__ . '/task-management.php';
require __DIR__ . '/Resource-pool/Candidate/candidate.php';
require __DIR__ . '/Resource-pool/HR/hr.php';
require __DIR__ . '/training-management.php';
require __DIR__ . '/bank-management.php';
require __DIR__ . '/DocumentManagement/document-management.php';
require __DIR__ . '/sms-template.php';
require __DIR__ . '/payment.php';
require __DIR__ . '/directory-management.php';
require __DIR__ . '/query-management.php';
require __DIR__ . '/grievance-management.php';

/*
|--------------------------------------------------------------------------
// Web Routes
|--------------------------------------------------------------------------
// Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    return '<h1>Clear all</h1>';
});

// Auth routes
Auth::routes();


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('auth.login');
})->name('home'); // home route

Route::get('/public-key', function () {
    $path = storage_path('keys/public.pem');
    if (!file_exists($path)) {
        abort(404, 'Public key not found');
    }

    return response(file_get_contents($path), 200)
        ->header('Content-Type', 'text/plain');
});

// Route::prefix('recruitment-portal')->middleware(['no.cache', 'secure.headers'])->group(function () {
//     Route::get('/login', [RecruitmentLoginController::class, 'recruitmentLogin'])->name('recruitment.login');
//     Route::post('/login', [RecruitmentLoginController::class, 'login'])->name('recruitment.auth.login');
//     Route::post('logout', [RecruitmentLoginController::class, 'logout'])->name('recruitment.logout');
//     Route::get('/help/desk', [Controller::class, 'recruitmentHelpDesk'])->name('recruitment.help.desk');
//     Route::view('/faqs', 'recruitment-management.faq')->name('recruitment.faqs');

//     Route::middleware(['no.cache', 'secure.headers'])->group(function () {
//         Route::get('/two-factor', [RecruitmentLoginController::class, 'twoFactorIndex'])->name('recruitment.twoFactor.index');
//         Route::post('/two-factor-verify', [RecruitmentLoginController::class, 'otpVerify'])
//             ->middleware('throttle:otp-verify')
//             ->name('recruitment.twoFactor.verify');
//     });

//     Route::get('password/request', [RecruitmentLoginController::class, 'showLinkRequestForm'])->name('recruitment.password.request');
//     Route::post('/password/email', [RecruitmentLoginController::class, 'sendResetLinkEmail'])
//         ->middleware('throttle:password-email-daily')
//         ->name('recruitment.password.email');
//     Route::get('password/reset/{token}', [RecruitmentLoginController::class, 'showResetForm'])->name('recruitment.password.reset');
//     Route::post('password/reset', [RecruitmentLoginController::class, 'reset'])->name('recruitment.password.update');

//     Route::group(["prefix" => "candidate/account"], function () {
//         Route::get('/registration', [RecruitmentLoginController::class, 'registration'])->name('recruitment.auth.registration');
//         Route::post('/registration', [RecruitmentLoginController::class, 'store'])->name('recruitment.auth.registration.store');
//     });

//     Route::get('/run-update-status', function () {
//         Artisan::call('applications:update-status');
//         return response()->json([
//             'message' => 'Application status update command executed successfully.',
//             'output' => Artisan::output()
//         ]);
//     });
// });

Route::get('/help/desk', [Controller::class, 'helpDesk'])->name('help.desk');

//Candidate Registration routes
Route::get('password/create-password', [RegistrationController::class, 'createPassword'])->name('password.create-password');

Route::get('auth/hr', [CandidateLoginController::class, 'hr'])->name('auth.hr');
Route::post('auth/loginPost', [CandidateLoginController::class, 'loginPost'])->name('auth.loginPost'); // Change route to '/login' for clarity

// Login routes
Route::group(["prefix" => "candidate/account"], function () {
    Route::get('/registration', [RegistrationController::class, 'registration'])->name('auth.registration');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('auth.registration.store');
});
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/faqs', 'resource-pool.faq')->name('faqs');

// Two-Factor Authentication routes
Route::middleware(['no.cache', 'secure.headers'])->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('twoFactor.index');
    Route::post('/two-factor-verify', [TwoFactorController::class, 'otpVerify'])
        ->middleware('throttle:otp-verify')
        ->name('twoFactor.verify');
});

// User activity route
Route::get('/user-activities', [UserActivityController::class, 'index'])->name('user.activities');

// Password Reset Routes
Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    //->middleware('throttle:password-email-daily')
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'resetFormPassword'])->name('password.update');


// Route to refresh the captcha
Route::get('/refresh-captcha', function () {
    $captchaSrc = captcha_src('flat'); // Generate captcha image source
    return response()->json(['captcha' => $captchaSrc]);
})->name('auth.refresh-captcha');

// Route to create captcha
Route::get('captcha/{config?}', [CaptchaController::class, 'create'])
    ->name('captcha')
    ->middleware('web');

// Route to generate and return audio captcha
// Route::get('/captcha/audio/inverse', [CaptchaController::class, 'audio'])
//     ->name('captcha.audio');


// Authenticated routes
Route::middleware(['auth', 'twofactor', 'single.device', 'no.cache', 'secure.headers'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'allNotifications'])->name('notifications.all');
    Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/unread', function () {
        $notifications = auth()->user()->unreadNotifications()->get()->map(function ($notification) {
            $notification->formatted_created_at = $notification->created_at->diffForHumans();
            return $notification;
        });

        return response()->json($notifications);
    })->name('notifications.unread');

    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'module.permission:dashboard'])->name('admin.dashboard');
    Route::get('resource-pool-portal/hr/dashboard', [DashboardController::class, 'index'])->name('hr.dashboard');

    Route::get('user-config/view', [UserController::class, 'view'])->name('user-config.view');
    Route::put('user-config/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user-config.resetPassword');
    Route::resource('user-config', UserController::class);
    Route::get('user-export', [UserController::class, 'export'])->name('users.export');
    Route::put('/user-data/{id}', [UserController::class, 'updateData'])->name('user.update-data');
    Route::get('user/login-history', [UserController::class, 'loginHistory'])->name('user.login.history');

    Route::get('/logs-viewer', [UserController::class, 'showLogs'])->name('users.logs.show');
    Route::get('/logs-viewer/clear', [UserController::class, 'clearLogs'])->name('users.logs.clear');

    Route::resource('permissions', PermissionController::class)->except(['show'])->middleware(['auth', 'module.permission:permissions']);;
    Route::resource('roles', RoleController::class)->middleware(['auth', 'module.permission:roles']);

    // Group all master-settings resources
    Route::middleware(['auth', 'role:Super Admin'])->prefix('master-settings')->name('master-settings.')->group(function () {
        // Index route for master settings
        Route::get('/', [MasterSettingsController::class, 'index'])->name('index');
        Route::resource('states', StateController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('designation', DesignationController::class);
        Route::resource('office-type', OfficeTypeController::class);
        Route::resource('employee-type', EmployeeTypeController::class);
        Route::resource('conducting-agency', ConductingAgencyController::class);
        Route::resource('board-university-college', BoardUniversityCollegeController::class);
        Route::resource('course', CourseController::class);
        Route::resource('discipline', DisciplineController::class);
        Route::resource('competitive-exam', ExamController::class);
        Route::resource('application-status', ApplicationStatusController::class);
        Route::resource('recruitment-mode', RecruitmentModeController::class);
        Route::resource('audit-type', AuditTypeController::class);
        Route::resource('audit-level', AuditLevelController::class);
        Route::resource('audit-query-type', AuditQueryTypeController::class);
        Route::resource('caste', CasteController::class);
        Route::resource('qms-query-type', QmsQueryTypeController::class);
        Route::resource('area-experties', AreaExpertiesController::class);
        Route::resource('bucket', BucketController::class);
        Route::resource('domain', DomainController::class);
        Route::resource('engagement', EngagementController::class);
        Route::resource('expert-professional', ExpertProfessionalController::class);
        Route::resource('gate-descipline', GateDesciplineController::class);
        Route::resource('guarantee-type', GuaranteeTypeController::class);
        Route::resource('interview-status', InterviewStatusController::class);
        Route::resource('job-type', JobTypeController::class);
        Route::resource('main-subject', MainSubjectController::class);
        Route::resource('post-held', PostHeldController::class);
        Route::resource('dms-type', DmsTypeController::class);
        Route::resource('dms-type-of-document', DmsTypeOfDocumentController::class);
    });

    Route::middleware(['auth', 'role:HR'])->prefix('hr-settings')->name('hr-settings.')->group(function () {
        // Index route for hr settings
        Route::get('/', [HrSettingsController::class, 'index'])->name('index');
    });

    Route::get('profile/{id}', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile-update', [ProfileController::class, 'profile_update'])->name('profile.update');
    //Route::post('password/backend/reset', [ProfileController::class, 'resetBackend'])->name('password.backend.update');
    Route::post('password/backend/reset', [ProfileController::class, 'resetBackend'])
        ->middleware('throttle:password-backend-email-daily')
        ->name('password.backend.update');
    Route::get('change-password/{id}', [ProfileController::class, 'changePassword'])->name('change-password');

    Route::get('resource-pool/users/view/data', [CandidateController::class, 'view'])->middleware(['auth'])->name('resource-pool.hr.listOfCandidates');
    Route::get('resource-pool/user/view/details/{id}', [CandidateController::class, 'show'])->name('resource-pool.userDetails');
    Route::get('resource-pool-user-export', [CandidateController::class, 'export'])->name('resource-pool.hr.export');
    Route::get('resource-pool-user-pdf/{id}', [CandidateController::class, 'exportPDF'])->name('resource-pool.hr.exportPDF');

    // Resource Pool - committee member
    Route::get('committee-member/dashboard', [CommitteeMemberSelectionProcessController::class, 'dashboard'])->name('committee-member.dashboard');
    Route::get('resource-pool/committee-member/selection-process', [CommitteeMemberSelectionProcessController::class, 'selectionProcess'])->name('committee-member.selection-process');
    Route::post('list-of-candidate-for-committee-member', [CommitteeMemberSelectionProcessController::class, 'getListOfCandidate'])->name('committee-member.getListOfCandidate');
    Route::post('save-draft-shortlist-for-committee-member', [CommitteeMemberSelectionProcessController::class, 'saveShortlistDraft'])->name('committee-member.saveShortlistDraft');
    Route::post('generate-shortlist-for-committee-member', [CommitteeMemberSelectionProcessController::class, 'generateShortlist'])->name('committee-member.generateShortlist');

    // Resource Pool - chairperson
    Route::get('resource-pool/chairperson/selection-process', [ChairpersonSelectionProcessController::class, 'selectionProcess'])->name('chairperson.selection-process');
    Route::post('list-of-candidate-for-chairperson', [ChairpersonSelectionProcessController::class, 'getListOfCandidate'])->name('chairperson.getListOfCandidate');
    Route::post('save-draft-shortlist-for-chairperson', [ChairpersonSelectionProcessController::class, 'saveShortlistDraft'])->name('chairperson.saveShortlistDraft');
    Route::post('generate-shortlist-for-chairperson', [ChairpersonSelectionProcessController::class, 'generateShortlist'])->name('chairperson.generateShortlist');

    Route::prefix('hr')->middleware(['auth'])->group(function () {
        Route::resource('leave/type', LeaveTypeController::class)->names('leave.type');
    });
});

//Mobile OTP Send
Route::post("send-otp", [OtpController::class, 'sendOtp'])->name('sendOtp');
Route::post("verify-otp", [OtpController::class, 'verifyOtp'])->name('verifyOtp');
