<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Covid19 extends Model
{
    use HasFactory;

    protected $table = 'covid_19';

    protected $fillable = [
        'candidate_id', 'file_path'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
