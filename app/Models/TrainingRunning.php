<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRunning extends Model
{
    use HasFactory;

    protected $table="training_running";

    protected $fillable = [
        'candidate_id',
        'day',
        'time_in',
        'time_out',
        'date'
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class,'id');
    }
}
