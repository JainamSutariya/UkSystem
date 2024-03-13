<?php

namespace App\Models;

use App\Models\Candidate as ModelsCandidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelephonicInterview extends Model
{
    use HasFactory;

    protected $table="telephonic_interview";

    protected $fillable = [
        "candidate_id",
        "date",
        "note",
        "position",
        "employment_type",
        "find_out_vacancy",
        "do_you_drive",
        "driving_license",
        "driving_license_type",
        "driving_share_code",
        "driving_license_number",
        "underlying_health_condition",
        "taking_any_medication",
        "receive_shielding_nhs",
        "current_job",
        "languages_speak",
        "work_experience_health",
        "previous_work_experience",
        "additional_comments",
        "current_dbs",
        "registered_update_service",
        "reference_number",
        "today_date",
        "morning_monday",
        "morning_tuesday",
        "morning_wednesday",
        "morning_thursday",
        "morning_friday",
        "morning_saturday",
        "morning_sunday",
        "late_monday",
        "late_tuesday",
        "late_wednesday",
        "late_thursday",
        "late_friday",
        "late_saturday",
        "late_sunday",
        "comments",
        "progress_interview",
        "relevant_comments",
        "staff_name",
        "sign_current_date",
        "sign",
        "form_date"
    ];

    public function candidate() {
        return $this->belongsTo(ModelsCandidate::class,'candidate_id');
    }
}
