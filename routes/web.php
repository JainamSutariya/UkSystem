<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReferenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('auth.verify');
Route::post('/verify', [AuthController::class, 'verifyOtp'])->name('auth.verify.verifyOtp');

Route::get('register', [AuthController::class, 'registration'])->name('register');
Route::post('post-register', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Reference Email From
Route::get('character-reference/{id}/{reference_index}', [ReferenceController::class, 'characterReference'])->name('characterReference');
Route::post('store-character-reference/{id}/{reference_index}', [ReferenceController::class, 'storeCharacterReference'])->name('storeCharacterReference');

Route::get('professional-reference/{id}/{reference_index}', [ReferenceController::class, 'professionalReference'])->name('professionalReference');
Route::post('store-professional-reference/{id}/{reference_index}', [ReferenceController::class, 'storeProfessionalReference'])->name('storeProfessionalReference');

Route::get('send-email-reference/{id}', [ReferenceController::class, 'referenceEmail'])->name('referenceEmail');
Route::get('cron-for-reference-email', [ReferenceController::class, 'cronForReferenceEmail'])->name('cronForReferenceEmail');

Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('reset-password-link', [AuthController::class, 'resetPasswordLink'])->name('reset-password-link');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password.form');

Route::post('password-update', [AuthController::class, 'passwordUpdate'])->name('password.update');


Route::resource('candidate', CandidateController::class);
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('candidate-list', [CandidateController::class, 'candidateList'])->name('candidateList');
Route::get('get_candidate', [CandidateController::class, 'getCandidate'])->name('get_candidate');
Route::post('assign-to-branch', [CandidateController::class, 'assignToBranch'])->name('assignToBranch');
Route::get('candidate-history', [CandidateController::class, 'candidateHistory'])->name('candidateHistory');

Route::post('candidate-telephonic-interview', [CandidateController::class, 'candidateTelePhonic'])->name('candidateTelePhonic');
Route::post('candidate-live-interview', [CandidateController::class, 'candidateLiveInterview'])->name('candidateLiveInterview');
Route::post('candidate-live-interview-note', [CandidateController::class, 'candidateLiveInterviewNote'])->name('candidateLiveInterviewNote');
Route::post('candidate-reference-note', [CandidateController::class, 'candidateReferenceNote'])->name('candidateReferenceNote');
Route::post('candidate-training-schedule', [CandidateController::class, 'candidateTrainingSchedule'])->name('candidateTrainingSchedule');

Route::get('branch-list', [CandidateController::class, 'branchList'])->name('branchList');
Route::get('get-branch-list', [CandidateController::class, 'getBranchList'])->name('getBranchList');

//Admin Telephonic Interview
Route::get('telephonic-interview', [CandidateController::class, 'telephonicInterview'])->name('telephonicInterview');
Route::get('get-telephonic-interview', [CandidateController::class, 'getTelephonicInterview'])->name('getTelephonicInterview');

//Get Telephonic Data
Route::post('get-telephonic-interview-data', [CandidateController::class, 'telephonicInterviewData'])->name('telephonicInterviewData');
Route::post('get-live-interview-schedule-data', [CandidateController::class, 'liveInterviewScheduleData'])->name('liveInterviewScheduleData');
Route::post('get-live-interview-note', [CandidateController::class, 'liveInterviewNoteData'])->name('liveInterviewNoteData');
Route::post('get-reference-note', [CandidateController::class, 'referenceData'])->name('referenceData');
Route::post('get-training-schedule', [CandidateController::class, 'trainingScheduleData'])->name('trainingScheduleData');

Route::post('save-training-running', [CandidateController::class, 'trainingRunningSave'])->name('trainingRunningSave');

Route::get('training-complete/{id}', [CandidateController::class, 'candidateTrainingComplete'])->name('candidateTrainingComplete');


Route::get('complete-reference', [CandidateController::class, 'completeReference'])->name('completeReference');
Route::get('get-complete-reference', [CandidateController::class, 'getCompleteReference'])->name('getCompleteReference');


//Branch Controller

Route::get('branch-candidate', [BranchController::class, 'branchCandidateList'])->name('branchCandidateList');
Route::get('get_branch_candidate', [BranchController::class, 'getBranchCandidate'])->name('get_branch_candidate');

Route::get('branch-telephonic-list', [BranchController::class, 'telephonicList'])->name('telephonicList');
Route::get('get-branch-telephonic-list', [BranchController::class, 'getTelephonicList'])->name('getTelephonicList');
Route::get('interview-screening/{id}', [BranchController::class, 'interviewScreening'])->name('interviewScreening');

Route::get('branch-live-schedule-list', [BranchController::class, 'liveScheduleList'])->name('liveScheduleList');
Route::get('get-branch-live-schedule-list', [BranchController::class, 'getLiveScheduleList'])->name('getLiveScheduleList');

Route::get('branch-live-note-list', [BranchController::class, 'liveScheduleNote'])->name('liveScheduleNote');
Route::get('get-branch-live-note-list', [BranchController::class, 'getLiveScheduleNote'])->name('getLiveScheduleNote');

Route::get('get-candidate-history/{id}', [BranchController::class, 'getCandidateHistory'])->name('getCandidateHistory');

Route::get('reference-list', [BranchController::class, 'referenceList'])->name('referenceList');
Route::get('get-reference-list', [BranchController::class, 'getReferenceList'])->name('getReferenceList');

Route::get('branch-training-schedule-list', [BranchController::class, 'trainingScheduleList'])->name('trainingScheduleList');
Route::get('get-branch-training-schedule-list', [BranchController::class, 'getTrainingScheduleList'])->name('getTrainingScheduleList');

Route::get('branch-training-running-list', [BranchController::class, 'trainingRunning'])->name('trainingRunning');
Route::get('get-branch-training-running-list', [BranchController::class, 'getTrainingRunningList'])->name('getTrainingRunningList');

Route::get('training-complete', [BranchController::class, 'trainingComplete'])->name('trainingComplete');
Route::get('get-training-complete-list', [BranchController::class, 'getTrainingCompleteList'])->name('getTrainingCompleteList');

Route::get('basic-english-test/{id}', [BranchController::class, 'basicEnglishTest'])->name('basicEnglishTest');
Route::post('store-basic-english-test', [BranchController::class, 'storeBasicEnglishTest'])->name('storeBasicEnglishTest');
Route::post('set-basic-english-test-access/{id}', [BranchController::class, 'setBasicEnglishTestAccess'])->name('setBasicEnglishTestAccess');

Route::get('care-staff/{formNumber}/{id}', [BranchController::class, 'careStaffObservation'])->name('careStaffObservation');
Route::post('store-care-staff', [BranchController::class, 'storeCareStaff'])->name('storeCareStaff');
Route::post('set-care-staff-access/{id}', [BranchController::class, 'setCareStaffObservation'])->name('setCareStaffObservation');
Route::post('/save-how-many-form', [BranchController::class, 'storeHowManyForm'])->name('storeHowManyForm');

Route::get('reference-log', [BranchController::class, 'referenceLog'])->name('referenceLog');
Route::get('reference-log-list', [BranchController::class, 'referenceLogList'])->name('referenceLogList');
Route::get('reference-log-view/{id}', [BranchController::class, 'referenceLogView'])->name('referenceLogView');

Route::get('live-interview-question/{id}', [BranchController::class, 'liveInterviewQuestion'])->name('liveInterviewQuestion');
Route::post('store-live-interview-question/{id}', [BranchController::class, 'storeLiveInterviewQuestion'])->name('storeLiveInterviewQuestion');


Route::get('application-identity', [BranchController::class, 'applicantIdentity'])->name('applicantIdentity');
Route::get('get-application-identity-list', [BranchController::class, 'getApplicantIdentityList'])->name('getApplicantIdentityList');
Route::get('application-identity/{id}', [BranchController::class, 'aplicationIdentity'])->name('aplicationIdentity');
Route::post('store-application-identity/{id}', [BranchController::class, 'storeApplicationIdentity'])->name('storeApplicationIdentity');

Route::get('right-to-work', [BranchController::class, 'rightToWork'])->name('rightToWork');
Route::get('get-right-to-work-list', [BranchController::class, 'getRightToWorkList'])->name('getRightToWorkList');
Route::post('upload-file', [BranchController::class, 'uploadFileForRightToWork'])->name('uploadFileForRightToWork');
Route::delete('delete-file-for-right-to-work/{id}', [BranchController::class, 'deleteFileForRightToWork'])->name('deleteFileForRightToWork');

Route::get('conditional-offer', [BranchController::class, 'conditionalOffer'])->name('conditionalOffer');
Route::get('get-conditional-offer-list', [BranchController::class, 'getConditionalOfferList'])->name('getConditionalOfferList');
Route::post('conditional-upload-file', [BranchController::class, 'uploadFileForConditionalOffer'])->name('uploadFileForConditionalOffer');
Route::delete('delete-file-for-conditional-offer/{id}', [BranchController::class, 'deleteFileForConditionalOffer'])->name('deleteFileForConditionalOffer');

Route::get('dbs-check', [BranchController::class, 'dbsCheck'])->name('dbsCheck');
Route::get('get-dbs-check-list', [BranchController::class, 'getDbsCheckList'])->name('getDbsCheckList');
Route::get('dbs-check/{id}', [BranchController::class, 'dbsCheckForm'])->name('dbsCheckForm');
Route::post('store-dbs-check/{id}', [BranchController::class, 'storeDbsCheckForm'])->name('storeDbsCheckForm');


Route::get('all-document', [BranchController::class, 'allDocument'])->name('allDocument');
Route::get('get-all-document', [BranchController::class, 'getAllDocument'])->name('getAllDocument');
Route::get('candidate-document-list/{id}', [BranchController::class, 'candidateDocumentList'])->name('candidateDocumentList');

Route::get('download/candidates/{id}', [BranchController::class, 'download'])->name('candidates.download');


Route::get('offer-letter', [BranchController::class, 'offerLetter'])->name('offerLetter');
Route::get('get-offer-letter-list', [BranchController::class, 'getOfferLetterList'])->name('getOfferLetterList');
Route::post('offer-letter-upload-file', [BranchController::class, 'uploadFileForOfferLetter'])->name('uploadFileForOfferLetter');
Route::delete('delete-file-for-offer-letter/{id}', [BranchController::class, 'deleteFileForOfferLetter'])->name('deleteFileForOfferLetter');

Route::get('gdpr-agreement', [BranchController::class, 'gdprAgreement'])->name('gdprAgreement');
Route::get('get-gdpr-agreement-list', [BranchController::class, 'getGDPRAgreementList'])->name('getGDPRAgreementList');
Route::post('gdpr-agreement-upload-file', [BranchController::class, 'uploadFileForGDPRAgreement'])->name('uploadFileForGDPRAgreement');
Route::delete('delete-file-for-gdpr-agreement/{id}', [BranchController::class, 'deleteFileForGDPRAgreement'])->name('deleteFileForGDPRAgreement');

Route::get('emp-contract', [BranchController::class, 'empContract'])->name('empContract');
Route::get('get-emp-contract-list', [BranchController::class, 'getEmpContractList'])->name('getEmpContractList');
Route::post('emp-contract-upload-file', [BranchController::class, 'uploadFileForEmpContract'])->name('uploadFileForEmpContract');
Route::delete('delete-file-for-emp-contract/{id}', [BranchController::class, 'deleteFileForEmpContract'])->name('deleteFileForEmpContract');

Route::get('covid-19', [BranchController::class, 'covid19Statement'])->name('covid19Statement');
Route::get('get-covid-19-list', [BranchController::class, 'getCovid19StatementList'])->name('getCovid19StatementList');
Route::post('covid-19-upload-file', [BranchController::class, 'uploadFileForCovid19'])->name('uploadFileForCovid19');
Route::delete('delete-file-for-covid-19/{id}', [BranchController::class, 'deleteFileForCovid19'])->name('deleteFileForCovid19');

Route::get('availability-form', [BranchController::class, 'availabilityForm'])->name('availabilityForm');
Route::get('get-availability-form-list', [BranchController::class, 'getAvailabilityFormList'])->name('getAvailabilityFormList');
Route::post('availability-form-upload-file', [BranchController::class, 'uploadFileForAvailabilityForm'])->name('uploadFileForAvailabilityForm');
Route::delete('delete-file-for-availability-form/{id}', [BranchController::class, 'deleteFileForAvailabilityForm'])->name('deleteFileForAvailabilityForm');

Route::get('staff-risk', [BranchController::class, 'staffRiskAssessment'])->name('staffRiskAssessment');
Route::get('get-staff-risk-list', [BranchController::class, 'getStaffRiskAssessmentList'])->name('getStaffRiskAssessmentList');
Route::post('staff-risk-upload-file', [BranchController::class, 'uploadFileForStaffRiskAssessment'])->name('uploadFileForStaffRiskAssessment');
Route::delete('delete-file-for-staff-risk/{id}', [BranchController::class, 'deleteFileForStaffRiskAssessment'])->name('deleteFileForStaffRiskAssessment');

Route::post('staff-risk-bame-form-file', [BranchController::class, 'uploadBAMEFormForStaffRiskAssessment'])->name('uploadBAMEFormForStaffRiskAssessment');
Route::delete('delete-bame-form-for-staff-risk/{id}', [BranchController::class, 'deleteBAMEFormForForStaffRiskAssessment'])->name('deleteBAMEFormForForStaffRiskAssessment');

Route::post('staff-risk-covid-vaccination-file', [BranchController::class, 'uploadCovidVaccinationForStaffRiskAssessment'])->name('uploadCovidVaccinationForStaffRiskAssessment');
Route::delete('delete-covid-vaccination-for-staff-risk/{id}', [BranchController::class, 'deleteCovidVaccinationForStaffRiskAssessment'])->name('deleteCovidVaccinationForStaffRiskAssessment');

Route::post('file-upload', [BranchController::class, 'submitForm'])->name('submitForm');

Route::get('all-form-list/{id}', [BranchController::class, 'allFormList'])->name('allFormList');

// Training Page
Route::get('training-running/{id}', [BranchController::class, 'trainingPage'])->name('trainingPage');

//Guest User

Route::get('user-listing', [BranchController::class, 'guestUser'])->name('guestUser');
Route::get('get-user-listing', [BranchController::class, 'getGuestUser'])->name('getGuestUser');
Route::get('create-user', [BranchController::class, 'createGuestUser'])->name('createGuestUser');
Route::post('store-user', [BranchController::class, 'storeGuestUser'])->name('storeGuestUser');
Route::get('edit-user/{id}', [BranchController::class, 'editGuestUser'])->name('editGuestUser');
Route::put('update-user/{id}', [BranchController::class, 'updateGuestUser'])->name('updateGuestUser');
Route::delete('delete-user/{id}', [BranchController::class, 'deleteGuestUser'])->name('deleteGuestUser');


// Admin Controller
Route::get('admin-live-schedule-list', [AdminController::class, 'adminLiveScheduleList'])->name('adminLiveScheduleList');
Route::get('get-admin-live-schedule-list', [AdminController::class, 'getAdminLiveScheduleList'])->name('getAdminLiveScheduleList');

Route::get('admin-candidate', [AdminController::class, 'adminCandidateList'])->name('adminCandidateList');
Route::get('get-admin-candidate', [AdminController::class, 'getAdminCandidate'])->name('getAdminCandidate');

Route::get('admin-pending', [AdminController::class, 'adminPendingData'])->name('adminPendingData');
Route::get('get-admin-pending-list', [AdminController::class, 'getAdminPendingList'])->name('getAdminPendingList');

Route::get('get-admin-candidate-history/{id}', [AdminController::class, 'getAdminCandidateHistory'])->name('getAdminCandidateHistory');


Route::get('admin-training-schedule', [AdminController::class, 'adminTrainingScheduleList'])->name('adminTrainingScheduleList');
Route::get('get-admin-training-schedule-list', [AdminController::class, 'getAdminTrainingScheduleList'])->name('getAdminTrainingScheduleList');

Route::get('admin-training-running', [AdminController::class, 'adminTrainingRunning'])->name('adminTrainingRunning');
Route::get('get-admin-training-running-list', [AdminController::class, 'getAdminTrainingRunningList'])->name('getAdminTrainingRunningList');

Route::get('admin-training-complete', [AdminController::class, 'adminTrainingComplete'])->name('adminTrainingComplete');
Route::get('get-admin-training-complete-list', [AdminController::class, 'getAdminTrainingCompleteList'])->name('getAdminTrainingCompleteList');

Route::get('admin-notification', [AdminController::class, 'adminNotification'])->name('adminNotification');
Route::get('get-admin-notification-list', [AdminController::class, 'adminNotificationList'])->name('adminNotificationList');

// Admin Training Page
Route::get('admin-training-running/{id}', [AdminController::class, 'adminTrainingPage'])->name('adminTrainingPage');

Route::get('user-profile/{id}', [AuthController::class, 'userProfile'])->name('userProfile');
Route::post('store-user-details', [AuthController::class, 'storeUserDetails'])->name('storeUserDetails');
