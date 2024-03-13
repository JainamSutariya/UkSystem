<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEmailFile extends Model
{
    use HasFactory;

    protected $table = 'candidate_email_files';

    protected $fillable = [
        'candidate_id',
        'email_job_application',
        'email_interview_screening',
        'email_basic_english_test',
        'email_interview_note',
        'email_application_identity',
        'email_dbs_check',
        'training_complete'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
