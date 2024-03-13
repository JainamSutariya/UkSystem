<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpContract extends Model
{
    use HasFactory;

    protected $table = 'emp_contract';

    protected $fillable = [
        'candidate_id', 'file_path'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
