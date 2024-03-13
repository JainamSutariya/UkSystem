<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalReference extends Model
{
    use HasFactory;

    protected $table = 'professional_reference';

    protected $fillable = [
        'candidate_name',
        'date_of_birth',
        'currently_working',
        'employment_start_date',
        'employment_end_date',
        'position_held_duties',
        'reason_for_leaving',
        'known_candidate',
        'days_absent',
        're_employ',
        'consider_applicant',
        'reason',
        'applicant_not_employed',
        'other_comment',
        'dignity_respect_1',
        'dignity_respect_2',
        'dignity_respect_3',
        'dignity_respect',
        'empathy_ability_1',
        'empathy_ability_2',
        'empathy_ability_3',
        'empathy_ability',
        'commitment_attitude_1',
        'commitment_attitude_2',
        'commitment_attitude_3',
        'commitment_attitude',
        'development_interest_1',
        'development_interest_2',
        'development_interest_3',
        'development_interest',
        'team_working_1',
        'team_working_2',
        'team_working_3',
        'team_working',
        'work_initiative_1',
        'work_initiative_2',
        'work_initiative_3',
        'work_initiative',
        'reliability_1',
        'reliability_2',
        'reliability_3',
        'reliability',
        'conduct_workplace_1',
        'conduct_workplace_2',
        'conduct_workplace_3',
        'conduct_workplace',
        'punctuality_1',
        'punctuality_2',
        'punctuality_3',
        'punctuality',
        'trustworthy',
        'reliable_carrying',
        'reference_name',
        'position',
        'company_name',
        'telephone_number',
        'email_address',
        'reference_date',
        'signature',
        'candidate_id',
        'reference_number',
        'document_type',
        'document_name',
        'document_path'
    ];

    public $timestamps = true;

    public function candidate() {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
