<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceEmailLog extends Model
{
    use HasFactory;

    protected $table="reference_email_log";

    protected $fillable = [
        'candidate_id',
        'reference_id',
        'reference_type',
        'request',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
