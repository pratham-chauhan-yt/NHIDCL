<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourcePool\HR\HrController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ResourcePool\HR\CandidateAssessmentController;
use App\Http\Controllers\ResourcePool\HR\CandidateSelectionController;

Route::middleware(['auth.redirect', 'auth', 'twofactor', 'no.cache', 'secure.headers'])->group(function () {

    Route::get('/searchShortListedUsersByRole', [UserController::class, 'searchShortListedUsersByRole'])->name('ajax.searchShortListedUsersByRole');

    // Route::post('hr/storeUpload_cover_photo', [HrController::class, 'storeUpload_cover_photo'])->name('hr.storeUpload_cover_photo');
    // Route::get('hr/viewFiles', [HrController::class, 'viewFiles'])->name('hr.viewFiles');

    Route::prefix('/resource-pool')->group(function () {
        Route::get('hr/manual/selection-process', [HrController::class, 'selectionProcessManual'])->name('hr.manual.selection-process');
        Route::get('hr/candidate/list', [HrController::class, 'selectionCandidateList'])->name('resource-pool.hr.candidate.list');
        Route::get('hr/selection-process', [HrController::class, 'selectionProcess'])->name('hr.selection-process');
    });

    Route::prefix('/resource-pool-portal')->group(function () {
        Route::get('hr/change-password', [ProfileController::class, 'candidateChangePassword'])->name('candidate.change-password');

        
        Route::get('advertisement/hr/create', [HrController::class, 'hrAdvertisement'])->name('hr.create.advertisement');
        Route::post('hr/storeUpload_cover_photo', [HrController::class, 'storeUpload_cover_photo'])->name('hr.storeUpload_cover_photo');
        Route::get('hr/viewFiles', [HrController::class, 'viewFiles'])->name('hr.viewFiles');
        Route::post('hr/create-requisition', [HrController::class, 'create_requisition'])->middleware('XSS')->name('hr.create-requisition');
        Route::get("hr/posted-jobs/", [HrController::class, "postedJobs"])->name("hr.postedJobs");
        Route::get("hr/archived-jobs/", [HrController::class, "archivedJobs"])->name("hr.archivedJobs");
        Route::get("hr/generateShortlisted", [HrController::class, "generateShortlisted"])->name("hr.generateShortlisted");
        Route::get("hr/manual/generateShortlisted", [HrController::class, "generateManualShortlisted"])->name("hr.manual.generateShortlisted");
        Route::get("hr/saveDraft", [HrController::class, "saveDraft"])->name("hr.saveDraft");

        Route::get('resource-pool-portal/hr/dashboard', [DashboardController::class, 'index'])->name('hr.dashboard');
        Route::get('/search-users-by-role', [HrController::class, 'searchUsersByRole'])->name('ajax.searchUsersByRol');
        Route::get('/updateUserStatus', [HrController::class, 'updateUserStatus'])->name('updateUserStatus');
        Route::get('/hr/SearchShortLeasted', [HrController::class, 'searchShortListedUsersByRole'])->name('ajax.SearchShortLeastedCandidate');
        // Route::get('hr/applicantProfile',[ApplicantController::class,'applicantProfile'])->name('hr.applicantProfile');
        // Route::get('/user/{id}/profile', [HrController::class, 'HrCandidateDetails'])->name('user.profile');
        Route::get('external.committee.store', [HrController::class, 'ExternalCommitteeStore'])->name('external.committee.store');
        Route::get('fetchExternalMember', [HrController::class, 'fetchExternalMember'])->name('fetchExternalMember');
        Route::get('designations{engagement_id}', [HrController::class, 'getDesignationsByEngagement'])->name('getDesignationsByEngagement');
        Route::get("hr/editPostedJobs/{id}", [HrController::class, "editPostedJobs"])->name("hr.editPostedJobs");
        Route::post("hr/updatePostedJobs/{id}", [HrController::class, "updatePostedJobs"])->name("hr.updatePostedJobs");
        Route::get("hr/viewPostedJobs/{id}", [HrController::class, "viewPostedArchiveJobs"])->name("hr.viewPostedJobs");
        Route::get("hr/deletePostedJobs/{id}", [HrController::class, "deletePostedJobs"])->name("hr.deletePostedJobs");
        Route::get("fetchusersortlistedByChairperson", [CandidateAssessmentController::class, "fetchusersortlistedByChairperson"])->name("hr.fetchusersortlistedByChairperson");
        Route::post("hr/candidate-batch", [CandidateAssessmentController::class, "candidateBatch"])->name("hr.candidateBatch");
        Route::get("hr/batchlisted-users", [CandidateSelectionController::class, "batchListedUser"])->name("hr.batchlistedUsers");
        Route::get("hr/get-list-of-batches", [CandidateSelectionController::class, "getListOfBatches"])->name("hr.get-list-of-batches");
        Route::post('hr/finalize-candidate-shortlist-status', [CandidateSelectionController::class, 'finalShortlistCandidate'])->name('hr.finalize-candidate-shortlist-status');

        /********************************Resource-pool Selection Process Routes ********************************************** */
        Route::post('efileCommittee', [HrController::class, 'efileCommittee'])->name('hr.efileCommittee');

        /**********************************End Resource-pool Selection Process Routes ******************************************/
    });
});
