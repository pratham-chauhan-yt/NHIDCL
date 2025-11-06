<?php

use App\Http\Controllers\Recruitment\CandidateProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Recruitment\BasicDetailsController;
use App\Http\Controllers\Recruitment\AdvertisementController;
use App\Http\Controllers\Recruitment\PostController;
use App\Http\Controllers\Recruitment\CandidateController;
use App\Http\Controllers\Recruitment\EmployeeJoiningApplicationController;

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

Route::controller(EmployeeJoiningApplicationController::class)->group(function () {
    Route::get('recruitment/employeeJoiningApplication', 'employeeJoiningApplication')->name('recruitment.employeeJoiningApplication');
    Route::post('recruitment/empApplicationFormStore', 'empApplicationFormStore')->name('recruitment.empApplicationFormStore');
    Route::get('recruitment/viewEmpJoiningApplication', 'viewEmpJoiningApplication')->name('recruitment.viewEmpJoiningApplication');
    Route::get('recruitment/editEmployeeDetails/{id}', 'editEmployeeDetails')->name('recruitment.editEmployeeDetails');
    Route::post('recruitment/updateEmployeeDetails', 'updateEmployeeDetails')->name('recruitment.updateEmployeeDetails');
    Route::get('recruitment/showEmployeeDetails/{id}', 'showEmployeeDetails')->name('recruitment.showEmployeeDetails');

});

/* Created by Mayank Raghav */

Route::middleware(['auth:web', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->prefix('recruitment-portal')->as('recruitment-portal.')->group(function () {
    Route::get('dashboard', [CandidateController::class, 'index'])->name('recruitment.dashboard');
    Route::get('profile', [CandidateController::class, 'profileData'])->name('recruitment.profile');
    Route::get('change/password', [CandidateController::class, 'changePasswordForm'])->name('recruitment.change.password');
    Route::post('update/password', [CandidateController::class, 'updatePasswordProfile'])->name('recruitment.update.password');
    Route::get('login/history', [CandidateController::class, 'userLoginHistory'])->name('recruitment.login.history');
    Route::get('candidate/application', [CandidateController::class, 'myApplication'])->name('recruitment.candidate.application');

    Route::get('candidate/view', [CandidateController::class, 'candidateDataView'])->name('candidate.view');
    Route::get('recruitment/current/vacancies', [CandidateController::class, 'recruitmentVacancies'])->name('candidate.current.vacancies');
    Route::get('candidate/advertisement', [CandidateController::class, 'candidateAdvertisement'])->name('candidate.advertisement');
    Route::get('candidate/advertisement/{id}', [CandidateController::class, 'candidateAdvertisementShow'])->name(name: 'candidate.advertisement.show');
    Route::get('candidate/archieve/advertisement', [CandidateController::class, 'candidateArchieveAdvertisement'])->name('candidate.archieve.advertisement');
    Route::match(['get', 'post'], 'candidate/advertisement/post/{id}', [CandidateController::class, 'candidateAdvertisementPost'])->name('candidate.advertisement.post')->withoutMiddleware(['single.device']);
        
    // User Profile for recruitment portal
    Route::get('candidate/profile', [CandidateProfileController::class, 'candidateProfile'])->name('candidate.profile');
    Route::post('candidate/personal_details', [CandidateProfileController::class, 'personalDetails'])->name('candidate.personal-details');
    Route::post('candidate/work/experience/choice', [CandidateProfileController::class, 'workExperienceChoice'])->name('candidate.work-experience-choice');
    Route::post('candidate/educational_details', [CandidateProfileController::class, 'educationalDetails'])->middleware('check.steps')->name('candidate.educational-details');
    Route::delete('/candidate/educational_details/delete/{id}', [CandidateProfileController::class, 'educationalDetailsDelete'])->name('candidate.educational-details.delete');
    Route::post('candidate/work_experience_details', [CandidateProfileController::class, 'workExperienceDetails'])->name('candidate.work-experience-details');
    Route::delete('/candidate/work_experience_details/delete/{id}', [CandidateProfileController::class, 'workExperienceDetailsDelete'])->name('candidate.work-experience-details.delete');
    Route::get('candidate/delete-candidate', [CandidateProfileController::class, 'delete_candidate'])->name('candidate.delete-candidate');
    Route::get('candidate/candidate_details', [CandidateProfileController::class, 'candidate_details'])->name('candidate.details');
    Route::post('candidate/gate/score', [CandidateProfileController::class, 'gateScoreDetails'])->name('candidate.gate.score');
    Route::get('candidate/gate/score/table', [CandidateProfileController::class, 'gateScoreDataTable'])->name('candidate.gate.score.table');
    Route::delete('candidate/gate/score/delete/{id}', [CandidateProfileController::class, 'deleteGateScore'])->name('candidate.gate.score.delete');
    Route::post('candidate/application/disclosure', [CandidateProfileController::class, 'candidateApplicationDisclosure'])->name('candidate.application.disclosure');
    Route::post('candidate/apply/advertisement/post/application', [CandidateController::class, 'candidateAdvertisementPostApplication'])->name('candidate.advertisement.post.application');
    Route::post('candidate/state/group/choice', [CandidateController::class, 'stateGroupChoice'])->name('candidate.state.group.choice');
    Route::post('candidate/profile/download', [CandidateController::class, 'profilePDF'])->name('candidate.profile.download');
    Route::post('users/logout', [CandidateController::class, 'logout'])->name('recruitment.logout');
});

Route::middleware(['auth:recruitment,web'])->prefix('recruitment-portal')->as('recruitment-portal.')->group(function () {
    Route::post('candidate/advertisement/upload/files', [CandidateController::class, 'candidateUploadFiles'])->name('candidate.advertisement.uploadfile')->withoutMiddleware(['auth:recruitment']);
    Route::get('candidate/advertisement/view/files', [CandidateController::class, 'candidateViewFiles'])->name('candidate.advertisement.viewfiles')->withoutMiddleware(['auth:recruitment']);
});

Route::middleware(['auth:web', 'single.device', 'no.cache', 'secure.headers', 'block.xss'])->prefix('recruitment-portal')->as('recruitment-portal.')->group(function () {
    Route::resource('advertisement', AdvertisementController::class);
    Route::resource('post', PostController::class);
    Route::get('applicant/profile/view/{pid}/{id}', [CandidateProfileController::class, 'candidateApplicationProfile'])->name('candidate.application.profile');
    Route::get('export/selection/data', [CandidateProfileController::class, 'exportSelectionData'])->name('candidate.export.data');
    Route::match(['get', 'post'], 'selection/process', [AdvertisementController::class, 'selectionProcess'])->name('selection.process');
    Route::match(['get', 'post'], 'selection/process/candidate', [AdvertisementController::class, 'selectionProcessCandidate']);
    Route::post('candidate/shortlist/process', [AdvertisementController::class, 'candidateShortlistProcess'])->name('candidate.shortlist.process');
    Route::post('candidate/assesment/process', [AdvertisementController::class, 'candidateAssesmentProcess'])->name('candidate.assesment.process');
    Route::post('selection/process/interview/status', [AdvertisementController::class, 'candidateInterviewStatus'])->name('candidate.interview.status');
    Route::post('selection/process/application/status', [AdvertisementController::class, 'candidateApplicationStatus'])->name('candidate.application.status');
    Route::post('advertisement/post/data', [AdvertisementController::class, 'advertisementApplicantData'])->name('advertisement.post.data');
    Route::get('application/activity/data', [AdvertisementController::class, 'applicationLogsData'])->name('application.activity.data');
    Route::get('application/activity/export', [AdvertisementController::class, 'applicationLogsExport'])->name('application.activity.export');
    Route::post('update-application-status', [AdvertisementController::class, 'updateApplicationStatus'])->name('update.application.status');
    Route::post('advertisement/storeUpload_cover_photo', [AdvertisementController::class, 'storeUpload_cover_photo'])->name('advertisement.storeUpload_cover_photo');
    Route::get('advertisement/view/files', [AdvertisementController::class, 'viewFiles'])->name('advertisement.viewFiles');
});