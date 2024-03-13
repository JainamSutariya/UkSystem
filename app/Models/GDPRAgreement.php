<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GDPRAgreement extends Model
{
    use HasFactory;

    protected $table = 'gdpr_agreement';

    protected $fillable = [
        'candidate_id', 'file_path'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
