<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareStaffForm extends Model
{
    use HasFactory;

    protected $table = 'care_staff_forms';

    protected $fillable = [
        'candidate_id', 'data', 'form_number'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
