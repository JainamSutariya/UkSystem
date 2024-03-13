<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightToWork extends Model
{
    use HasFactory;

    protected $table = 'right_to_work';

    protected $fillable = [
        'candidate_id', 'file_path'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
