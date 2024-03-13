<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table="candidate";

    protected $fillable = [
        'prefix',
        'first_name',
        'last_name',
        'street_address',
        'country',
        'post_code',
        'email',
        'mobile_number',
        'telephone_no',
        'dob',
        'gender',
        'gender_other_details',
        'emergency_first_name',
        'emergency_last_name',
        'emergency_mobile',
        'emergency_contact_relation',
        'user_id',
        'branch_id',
        'status',
        'is_complete',
        'is_submit',
        'position',
        'employment_type',
        'work_eligible',
        'nation_insurance_number',
        'driving_license',
        'driving_license_type',
        'driving_share_code',
        'driving_license_number',
        'equality_act',
        'currently_studying',
        // 'date_of_comletion',
        // 'current_education_school',
        // 'current_education_enrolled',
        'currently_studying_details',
        'old_emp_details',
        'training_courses',
        'training_courses_details',
        'currently_emp',
        'current_name_company',
        'address_current_company',
        'current_employer_email',
        'current_employer_phone',
        'current_joining_date',
        'current_nature_business',
        'current_postion_held',
        'current_reason_for_leaving',
        'other_emp',
        'other_name_company',
        'other_address_company',
        'other_emp_email',
        'other_phone',
        'other_joining_date',
        'other_relieving_date',
        'other_nature_business',
        'other_reason_for_leaving',
        'ten_year_history',
        'supporting_desc',
        'court_martial',
        'court_martial_no_details',
        'police_cautions_no_details',
        'police_cautions',
        'privacy_policy',
        'is_basic_test',
        'is_basic_submit',
        'identity_proof',
        'address_proof',
        'is_training_complete',
        'is_shadowing_form_submit',
        'how_many_form',
        'is_read',
        'signature'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function branch() {
        return $this->belongsTo(User::class,'branch_id');
    }

    public function referenceList() {
        return $this->hasOne(ReferenceList::class,'candidate_id');
    }

    public function candidateTelephonic( ) {
        return $this->hasOne(TelephonicInterview::class,'candidate_id');
    }

    public function candidateLiveSchedule( ) {
        return $this->hasOne(LiveInterviewSchedule::class,'candidate_id');
    }

    public function candidateReference( ) {
        return $this->hasOne(ReferenceList::class,'candidate_id');
    }

    public function candidateTrainingSchedule( ) {
        return $this->hasOne(TrainingSchedule::class,'candidate_id');
    }

    public function candidateTrainingRunning( ) {
        return $this->hasMany(TrainingRunning::class,'candidate_id');
    }

    public function candidateNotification( ) {
        return $this->hasMany(NotificationLog::class,'candidate_id');
    }

    public function candidateBasicTest( ) {
        return $this->hasOne(BasicEnglishMathTest::class,'candidate_id');
    }

    public function careStaffForm( ) {
        return $this->hasMany(CareStaffForm::class,'candidate_id');
    }

    public function candidateLiveInterviewQuestion( ) {
        return $this->hasOne(LiveInterviewQuestion::class,'candidate_id');
    }

    public function candidateApplicantDetails( ) {
        return $this->hasOne(ApplicantIdentityDetails::class,'candidate_id');
    }

    public function rightToWorkData( ) {
        return $this->hasOne(RightToWork::class,'candidate_id');
    }

    public function conditionalOfferData( ) {
        return $this->hasOne(ConditionalOffer::class,'candidate_id');
    }

    public function dbsCheckData( ) {
        return $this->hasOne(DBSCheck::class,'candidate_id');
    }

    public function offerLetterData( ) {
        return $this->hasOne(OfferLetter::class,'candidate_id');
    }

    public function gdprAgreementData( ) {
        return $this->hasOne(GDPRAgreement::class,'candidate_id');
    }

    public function empContractData( ) {
        return $this->hasOne(EmpContract::class,'candidate_id');
    }

    public function covid19Data( ) {
        return $this->hasOne(Covid19::class,'candidate_id');
    }

    public function availabilityFormData( ) {
        return $this->hasOne(AvailabilityForm::class,'candidate_id');
    }

    public function staffRiskData( ) {
        return $this->hasOne(StaffRisk::class,'candidate_id');
    }

    public function emailData( ) {
        return $this->hasOne(CandidateEmailFile::class,'candidate_id');
    }
}
