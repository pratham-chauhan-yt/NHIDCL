<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourcePool\Candidate\ApplicantCandidateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\CandidateLoginController;


Route::prefix('/resource-pool-portal')->middleware(['auth', 'twofactor', 'no.cache', 'secure.headers', 'XSS'])->group(function () {
    Route::get('candidate/applicant/profile', [ApplicantCandidateController::class, 'applicantProfile'])->middleware(['auth', 'module.permission:resource-pool-applicant-profile'])->name('candidate.applicantProfile');

    Route::get('candidate/candidateAdvertisement', [ApplicantCandidateController::class, 'candidateAdvertisement'])->middleware(['auth', 'module.permission:advertisement'])->name('candidate.candidateAdvertisement');
    Route::prefix('/candidate')->group(function () {
        Route::controller(ApplicantCandidateController::class)->middleware(['no.cache', 'secure.headers', 'XSS'])->group(function () {
            Route::post("personal_details", "personalDetails")->middleware('XSS')->name("personal-details");
            Route::post("educational_details", "educationalDetails")->middleware('check.steps')->name("educational-details");
            Route::post("work_experience_details", "workExperienceDetails")->middleware('check.steps')->name("work-experience-details");
            Route::post("competitive-details", "competitiveDetails")->name("competitive-details");
            Route::post("additional_details", "additionalDetails")->name("additional-details");

            Route::get("viewFiles", "viewFiles")->name('viewFiles');
            Route::post("storeUpload_cover_photo", "storeUpload_cover_photo")->middleware('XSS')->name("prashadUser.storeUpload_cover_photo");
            Route::get("candidate_details", "candidate_details")->name("candidate.details");
            Route::get("delete-candidate", "delete_candidate")->name("delete-candidate");
            Route::get("advertisment", "advertisment")->name("candidate.advertisment");
            Route::get("advertismentArchive", "advertismentArchive")->name("candidate.advertismentArchive");
            Route::get('archiveDetails', 'archiveDetails')->name('candidate.archiveDetails');
            Route::post('training-details', 'trainingDetails')->name('training-details');
            Route::post("final-clouser", "finalClouser")->middleware('check.steps')->name("final-clouser.submition");

            Route::match(['get', 'post'], 'test-data', 'testData')->name('candidate.testdata');
        });
    });
    Route::get('candidate/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');
    Route::get('candidate/login-history', [ProfileController::class, 'candidateLoginHistory'])->name('candidate.login-history');
    Route::match(['get', 'post'], 'candidate/check-data', [ProfileController::class, 'candidateTestData'])
    ->middleware('XSS')
    ->name('candidate.check-data');
    Route::get('/candidate/check-profile-complete', [ApplicantCandidateController::class, 'checkProfileComplete']);
    Route::get('/profile-pdf', [ApplicantCandidateController::class, 'profilePDF'])->middleware('check.steps')->name('profile.download');
    Route::post('candidate/logout', [LoginController::class, 'logout'])->name('candidate.logout');
});


Route::middleware(['auth', 'twofactor', 'no.cache', 'secure.headers'])->group(function () {
    Route::get('resource-pool-portal/advertisement/candidate', [ApplicantCandidateController::class, 'candidateAdvertisement'])->name('candidate.candidateAdvertisement');


    Route::get('resource-pool-portal/candidate/dashboard', function () {

        return redirect()->route('candiadte.dashboard');
    });

    Route::get('resource-pool-portal/candidate', [CandidateLoginController::class, 'candidate'])->name('auth.candidate');

    Route::get('resource-pool-portal/candidate/dashboard', [DashboardController::class, 'index'])->name('candidate.dashboard');
});
