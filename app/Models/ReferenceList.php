<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceList extends Model
{
    use HasFactory;

    protected $table="reference_list";

    protected $fillable = [
        'reference_1_json',
        'reference_2_json',
        'name_1',
        'email_1',
        'number_1',
        'reference_place_work_1',
        'reference_job_title_1',
        'status_1',
        'note_1',
        'name_2',
        'email_2',
        'number_2',
        'reference_place_work_2',
        'reference_job_title_2',
        'status_2',
        'note_2',
        'candidate_id',
        'pdf_upload_1',
        'pdf_upload_2',
        'is_email_send',
        'email_day_count',
        'character_email_complete',
        'professional_email_complete'
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
