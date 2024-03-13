<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSchedule extends Model
{
    use HasFactory;

    protected $table="training_schedule";

    protected $fillable = [
        'candidate_id',
        'date',
        'note',
        'status',
        'start_date',
        'end_date',
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class,'id');
    }
}
