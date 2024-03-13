<?php

namespace App\Models;

use App\Models\Candidate as ModelsCandidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveInterviewSchedule extends Model
{
    use HasFactory;

    protected $table="live_interview_schedule";

    protected $fillable = [
        'candidate_id',
        'date',
        'location',
        'note',
        'status',
        'status_date',
        'status_note',
        'pdf_upload'
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
