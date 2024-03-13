<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterReference extends Model
{
    use HasFactory;

    protected $table = 'character_reference';

    protected $fillable = [
        'candidate_id',
        'reference_number',
        'social_care',
        'health_care_industry',
        'suitability_capacity',
        'candidates_attitude',
        'dignity_respect_1',
        'dignity_respect_2',
        'dignity_respect_3',
        'dignity_respect',
        'empower_others_1',
        'empower_others_2',
        'empower_others_3',
        'empower_others',
        'commitment_work_1',
        'commitment_work_2',
        'commitment_work_3',
        'commitment_work',
        'development_interest_1',
        'development_interest_2',
        'development_interest_3',
        'development_interest',
        'working_ability_1',
        'working_ability_2',
        'working_ability_3',
        'working_ability',
        'work_initiative_1',
        'work_initiative_2',
        'work_initiative_3',
        'work_initiative',
        'reliability_1',
        'reliability_2',
        'reliability_3',
        'reliability',
        'employee_conduct_1',
        'employee_conduct_2',
        'employee_conduct_3',
        'employee_conduct',
        'time_punctuality_1',
        'time_punctuality_2',
        'time_punctuality_3',
        'time_punctuality',
        'honest_trustworthy',
        'reliable_carrying',
        'reference_name',
        'position',
        'company_name',
        'telephone_number',
        'email_address',
        'reference_date',
        'signature',
        'document_type',
        'document_name',
        'document_path',
        'ralation_with_candidate',
        'know_the_candidate'
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
