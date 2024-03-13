<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRisk extends Model
{
    use HasFactory;

    protected $table = 'staff_risk';

    protected $fillable = [
        'candidate_id', 'ra_form', 'bame_form', 'covid_vaccination'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
