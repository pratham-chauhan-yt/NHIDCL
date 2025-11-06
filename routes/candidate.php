<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\CandidateLoginController;

Route::get('resource-pool-portal/candidate/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('candidate.applicantProfile');
Route::get('resource-pool-portal/hr/applicantProfile',[HrController::class,'applicantProfile'])->name('hr.applicantProfile');
Route::get('/searchShortListedUsersByRole', [UserController::class, 'searchShortListedUsersByRole'])->name('ajax.searchShortListedUsersByRole');



Route::get('candidate/candidateAdvertisement',[ApplicantController::class,'candidateAdvertisement'])->name('candidate.candidateAdvertisement');

Route::prefix('/candidate')->group(['middleware' => ['XSS','secure.headers']], function () {
    //dd("aa gaya candidate route m");
        Route::controller(ApplicantController::class)->group(function (){
            Route::post("personal_details","personalDetails")->name("personal-details");
            Route::post("educational_details","educationalDetails")->name("educational-details");
            Route::post("work_experience_details","workExperienceDetails")->name("work-experience-details");
            Route::post("additional_details","additionalDetails")->name("additional-details");

//Route::get('candidate/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('candidate.applicantProfile');

Route::get('candidate/candidateAdvertisement',[ApplicantController::class,'candidateAdvertisement'])->name('candidate.candidateAdvertisement');
Route::prefix('/candidate')->group(function () {
    //dd("aa gaya candidate route m");
        Route::controller(ApplicantController::class)->group(function (){
            Route::post("personal_details","personalDetails")->name("personal-details");
            Route::post("educational_details","educationalDetails")->name("educational-details");
            Route::post("work_experience_details","workExperienceDetails")->name("work-experience-details");
            Route::post("additional_details","additionalDetails")->name("additional-details");



            Route::get("viewFiles","viewFiles")->name('viewFiles');
            Route::post("storeUpload_cover_photo","storeUpload_cover_photo")->name("prashadUser.storeUpload_cover_photo");
            Route::get("candidate_details","candidate_details")->name("candidate.details");
            Route::get("delete-candidate","delete_candidate")->name("delete-candidate");
            Route::get("advertisment","advertisment")->name("candidate.advertisment");
            Route::get("advertismentArchive","advertismentArchive")->name("candidate.advertismentArchive");
            
        });
});
Route::get('candidate/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');
Route::get('resource-pool-portal/hr/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');

//Route::get('hr/hrAdvertisement',[HrController::class,'hrAdvertisement'])->name('hr.create.advertisement');
Route::post('hr/storeUpload_cover_photo',[HrController::class,'storeUpload_cover_photo'])->name('hr.storeUpload_cover_photo');
Route::get('hr/viewFiles',[HrController::class,'viewFiles'])->name('hr.viewFiles');

            Route::get("viewFiles","viewFiles")->name('viewFiles');
            Route::post("storeUpload_cover_photo","storeUpload_cover_photo")->name("prashadUser.storeUpload_cover_photo");
            Route::get("candidate_details","candidate_details")->name("candidate.details");
            Route::get("delete-candidate","delete_candidate")->name("delete-candidate");
            Route::get("advertisment","advertisment")->name("candidate.advertisment");
            Route::get("advertismentArchive","advertismentArchive")->name("candidate.advertismentArchive");
            
        });
});
Route::get('candidate/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');
Route::get('candidate/{id?}/applicantProfile', [ApplicantController::class, 'applicantProfile'])->name('candidate.applicantProfile');

Route::post('hr/storeUpload_cover_photo',[HrController::class,'storeUpload_cover_photo'])->name('hr.storeUpload_cover_photo');
Route::get('hr/viewFiles',[HrController::class,'viewFiles'])->name('hr.viewFiles');
Route::prefix('/resource-pool-portal')->group(function () {
 Route::get('hr/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');   Route::get('candidate/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('candidate.applicantProfile');
    Route::get('hr/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');
    Route::get('candidate/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('candidate.applicantProfile');
 //   Route::get('hr/applicantProfile',[HrController::class,'applicantProfile'])->name('hr.applicantProfile');
 
 //   Route::get('hr/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('hr.applicantProfile');
    Route::get('candidate/candidateAdvertisement',[ApplicantController::class,'candidateAdvertisement'])->name('candidate.candidateAdvertisement');
    Route::prefix('/candidate')->group(function () {
        //dd("aa gaya candidate route m");
            Route::controller(ApplicantController::class)->group(function (){
                Route::post("personal_details","personalDetails")->name("personal-details");
                Route::post("educational_details","educationalDetails")->name("educational-details");
                Route::post("work_experience_details","workExperienceDetails")->name("work-experience-details");
                Route::post("additional_details","additionalDetails")->name("additional-details");
                Route::post("competitive-details","competitiveDetails")->name("competitive-details");

                Route::get("viewFiles","viewFiles")->name('viewFiles');
                Route::post("storeUpload_cover_photo","storeUpload_cover_photo")->name("prashadUser.storeUpload_cover_photo");
                Route::get("candidate_details","candidate_details")->name("candidate.details");
                Route::get("delete-candidate","delete_candidate")->name("delete-candidate");
                Route::get("advertisment","advertisment")->name("candidate.advertisment");
                Route::get("advertismentArchive","advertismentArchive")->name("candidate.advertismentArchive");
                
            });
    });
    Route::get('candidate/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');
    Route::get('hr/hrAdvertisement',[HrController::class,'hrAdvertisement'])->name('hr.hrAdvertisement');
    Route::post('hr/storeUpload_cover_photo',[HrController::class,'storeUpload_cover_photo'])->name('hr.storeUpload_cover_photo');
    Route::get('hr/viewFiles',[HrController::class,'viewFiles'])->name('hr.viewFiles');
    Route::post('hr/create-requisition',[HrController::class,'create_requisition'])->name('hr.create-requisition');
    Route::get("hr/posted-jobs/",[HrController::class,"postedJobs"])->name("hr.postedJobs");
    Route::get("hr/archived-jobs/",[HrController::class,"archivedJobs"])->name("hr.archivedJobs");
    Route::post('candidate/logout', [LoginController::class, 'logoutCandidate'])->name('candidate.logout');
    Route::get("hr/generateShortlisted",[HrController::class,"generateShortlisted"])->name("hr.generateShortlisted");

});

//Candidate Registration routes
Route::get('resource-pool-portal/candidate/dashboard',function(){
    return redirect()->route('candiadte.dashboard'); 
});
Route::get('resource-pool-portal/candidate', [CandidateLoginController::class, 'candidate'])->name('auth.candidate');

Route::get('resource-pool-portal/candidate/dashboard', [DashboardController::class, 'index'])->name('candidate.dashboard');

Route::get('resource-pool-portal/hr/dashboard', [DashboardController::class, 'index'])->name('hr.dashboard');

//Route::get('hr/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('hr.applicantProfile');


Route::get('/search-users-by-role', [HrController::class, 'searchUsersByRole'])->name('ajax.searchUsersByRol');

Route::get('/updateUserStatus', [HrController::class, 'updateUserStatus'])->name('updateUserStatus');

Route::get('/hr/SearchShortLeasted', [HrController::class, 'searchShortListedUsersByRole'])->name('ajax.SearchShortLeastedCandidate');

Route::get('hr/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('hr.applicantProfile');

Route::get('/user/{id}/profile', [HrController::class, 'HrCandidateDetails'])->name('user.profile');

Route::get('external.committee.store', [HrController::class, 'ExternalCommitteeStore'])->name('external.committee.store');

Route::get('fetchExternalMember', [HrController::class, 'fetchExternalMember'])->name('fetchExternalMember');


Route::get('designations{engagement_id}', [HrController::class, 'getDesignationsByEngagement'])->name('getDesignationsByEngagement');



