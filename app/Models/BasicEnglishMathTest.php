<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicEnglishMathTest extends Model
{
    use HasFactory;

    protected $table = 'basic_english_math_tests';

    protected $fillable = [
        'first_answer',
        'second_answer',
        'third_answer',
        'fourth_answer',
        'fifth_answer',
        'sixth_answer',
        'seven_a_answer',
        'seven_b_answer',
        'eight_answer',
        'nine_answer',
        'ten_answer',
        'learner_total_score',
        'first_maths_answer',
        'second_maths_answer',
        'third_maths_answer',
        'fourth_maths_answer',
        'fifth_maths_answer',
        'sixth_maths_answer',
        'seven_maths_answer',
        'eigth_maths_answer',
        'nine_maths_answer',
        'ten_maths_answer',
        'learner_total_score_maths',
        'assessor_sign_maths',
        'english_assessment_score',
        'math_assessment_score',
        'total_score',
        'candidate_name',
        'date_assessment',
        'candidate_sign',
        'recruitment_matrix_score',
        'assessor_name',
        'assessor_sign',
        'assessment_comment',
        'candidate_id',
    ];
}
