<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveInterviewQuestion extends Model
{
    use HasFactory;

    protected $table="live_interview_question";

    protected $fillable = [
        'candidate_name',
        'date',
        'dbs_text',
        'health_sector_radio',
        'health_care_sector',
        'tell_me_about_yourself',
        'domiciliary_care_work',
        'citizen_home',
        'safe_and_healthy',
        'privacy_and_dignity',
        'effective_team_working',
        'knowledge_other',
        'data_protection',
        'running_late',
        'medication',
        'reference',
        'care_certificate',
        'dbs_working',
        'dbspay_period',
        'covid_vaccination',
        'covid_regular_testing',
        'additional_comment',
        'attitude',
        'communication',
        'willing_to_work',
        'work_experience',
        'professional_experience',
        'education',
        'english_math_skill',
        'interview_question',
        'total_score',
        'decision_radio',
        'reason',
        'person_name',
        'person_date',
        'signature',
        'candidate_id',
        'health_care_sector_other',
        'tell_me_about_yourself_other',
        'domiciliary_care_work_other',
        'citizen_home_other',
        'safe_and_healthy_other',
        'privacy_and_dignity_other',
        'effective_team_working_other',
        'knowledge_other_other',
        'data_protection_other',
        'running_late_other',
        'medication_other',
        'total_score_selection'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
