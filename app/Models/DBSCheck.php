<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBSCheck extends Model
{
    use HasFactory;

    protected $table = 'dbs_check';

    protected $fillable = [
        'staff_name', 'certification_number', 'conviction', 'date_of_issue', 'received_name', 'received_date', 'received_signature', 'candidate_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
