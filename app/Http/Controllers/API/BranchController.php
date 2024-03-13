<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BasicEnglishMathTest;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function storeBasicEnglishTestAPI(Request $request) {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required',
            'third_answer' => 'nullable|array',
            'sixth_answer' => 'nullable|array',
            'ten_answer' => 'nullable|array',
            'fifth_maths_answer' => 'nullable|array',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $requestData = $request->all();
        $requestData['third_answer'] = $request->has('third_answer') ? json_encode($request->third_answer) : null;
        $requestData['sixth_answer'] = $request->has('sixth_answer') ? json_encode($request->sixth_answer) : null;
        $requestData['ten_answer'] = $request->has('ten_answer') ? json_encode($request->ten_answer) : null;
        $requestData['fifth_maths_answer'] = $request->has('fifth_maths_answer') ? json_encode($request->fifth_maths_answer) : null;

        $score = 0;
        if (strtolower($request->first_answer) == '5') {
            $score = $score + 1;
        }
        if (strtolower($request->second_answer) == 'help desk') {
            $score = $score + 1;
        }
        if (strtolower($request->third_answer[0]) == 'f' && strtolower($request->third_answer[1]) == 'g' && strtolower($request->third_answer[2]) == 'h' && strtolower($request->third_answer[3]) == 'i' && strtolower($request->third_answer[4]) == 'k' && strtolower($request->third_answer[5]) == 'm' && strtolower($request->third_answer[6]) == 'n' && strtolower($request->third_answer[7]) == 'o') {
            $score = $score + 2;
        }
        if (strtolower($request->fourth_answer) == 'saturday') {
            $score = $score + 1;
        }
        if (strtolower($request->fifth_answer) == 'medicine or tablets' || strtolower($request->fifth_answer) == 'medicine' || strtolower($request->fifth_answer) == 'tablets') {
            $score = $score + 2;
        }
        if (strtolower($request->sixth_answer[0]) == 'bare' && strtolower($request->sixth_answer[1]) == 'bear' && strtolower($request->sixth_answer[2]) == 'blue' && strtolower($request->sixth_answer[3]) == 'break' && strtolower($request->sixth_answer[4]) == 'build') {
            $score = $score + 2;
        }
        if (strtolower($request->seven_a_answer) == 'but' && strtolower($request->seven_b_answer) == 'also') {
            $score = $score + 2;
        }
        if (strtolower($request->eight_answer) == "communicate") {
            $score = $score + 1;
        }
        if (strtolower($request->nine_answer) == "admissions ward") {
            $score = $score + 1;
        }
        if (strtolower($request->ten_answer[0]) == 'a significant decrease' && strtolower($request->ten_answer[1]) == 'a marked increase' && strtolower($request->ten_answer[2]) == 'reached a peak' && strtolower($request->ten_answer[3]) == 'a significant rise' && strtolower($request->ten_answer[4]) == 'more popular') {
            $score = $score + 2;
        }
        $mathsScore = 0;
        if (strtolower($request->first_maths_answer) == '22nd july' || strtolower($request->first_maths_answer) == 'a') {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->second_maths_answer) == '30' || strtolower($request->second_maths_answer) == "a") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->third_maths_answer) == "10.40am" || strtolower($request->third_maths_answer) == "c") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->fourth_maths_answer) == "£9.50" || strtolower($request->fourth_maths_answer) == "b") {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->fifth_maths_answer[0]) == 'blue' && strtolower($request->fifth_maths_answer[1]) == 'pink' && strtolower($request->fifth_maths_answer[2]) == 'yellow') {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->sixth_maths_answer == "16:00")) {
            $mathsScore = $mathsScore + 1;
        }
        if (strtolower($request->seven_maths_answer) == "1st clock" || strtolower($request->seven_maths_answer) == "clock 1") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->eight_maths_answer == "42" || strtolower($request->eight_maths_answer) == "b") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->nine_maths_answer == "£16.80" || strtolower($request->nine_maths_answer) == "c") {
            $mathsScore = $mathsScore + 1;
        }
        if ($request->ten_maths_answer == '27' || strtolower($request->ten_maths_answer) == 'a') {
            $mathsScore = $mathsScore + 1;
        }
        $requestData['learner_total_score'] = $score;
        $requestData['learner_total_score_maths'] = $mathsScore;
        $requestData['english_assessment_score'] = $score;
        $requestData['math_assessment_score'] = $mathsScore;
        $requestData['total_score'] = $score + $mathsScore;
        $requestData['date_assessment'] = date('Y-m-d');
        $candidateTestData = BasicEnglishMathTest::where('candidate_id', $request->candidate_id)->first();
        if ($candidateTestData) {
            BasicEnglishMathTest::where('candidate_id', $request->candidate_id)->update($requestData);
        } else {
            BasicEnglishMathTest::create($requestData);
            // Candidate::find($request->candidate_id)->update([
            //     'is_basic_submit' => "1"
            // ]);
        }
        return response()->json(['message' => 'Test submitted successfully'], 200);
    }
}
