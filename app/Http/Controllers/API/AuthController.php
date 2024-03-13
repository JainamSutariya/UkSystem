<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required',
            'password' => 'required|string|min:8|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'role' => 'Candidate',
        ]);

        $candidate = Candidate::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_id' => $user->id,
        ]);

        // Generate a token for the registered user
        $token = $user->createToken('MyApp')->accessToken;

        // Prepare response data
        $responseData = [
            'message' => 'Great! Your Account Successfully Registered',
            'user' => $user,
            'candidate' => $candidate,
            'token' => $token,
        ];

        // Send email
        $body = "Dear {$request->first_name},<br><br>Thank you for joining our team. Now the next step is to submit your application form using your account.<br><br>If you have any concerns, you can send an email to jobs@ndhcarec.o.uk or feel free to contact 0121 448 0568.<br><br>Best Regards,<br><br>Recruitment Team<br>NDH Care Ltd";
        $candidateController = new CandidateController();
        $candidateController->sendMail($request->email, $request->first_name, 'Account Registered Successfully!', $body, $candidate->id, 3);

        // Return JSON response with token and user details
        return response()->json($responseData, 201);
    }

    public function resetPasswordLink(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $email = $request->email;
        $userData = User::where('email', $email)->first();

        if ($userData) {
            // $resetToken = Str::random(60);
            $resetToken = str_pad(rand(0, pow(10, 6)-1), 6, '0', STR_PAD_LEFT);
            $userData->update(['reset_token' => $resetToken]);

            $body = 'To reset your password, Here is your one time OTP ' . $resetToken . '<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568';
            $this->sendMail($userData->email, $userData->name, 'Reset Password OTP', $body);
            return response()->json(['message' => 'Reset password link sent successfully.']);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function resetPassword(Request $request) {
        if ($request->password !== $request->confirm_password) {
            return response()->json(['error' => 'The password confirmation does not match.'], 422);
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $token = $request->token;
        $email = $request->email;
        $user = User::where('email', $email)->where('reset_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid or expired reset token.'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        return response()->json(['message' => 'Password reset successfully.']);
    }

    public function sendMail($toEmail, $toName, $subject, $body) {
        $mail = new PHPMailer(true);
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 2;
            $mail->Username = 'jobs.ndhcareltd@gmail.com';   //  sender username
            $mail->Password = 'jiarlhwdfjssoeky';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('jobs.ndhcareltd@gmail.com', 'Job Portal');
            $mail->addAddress($toEmail, $toName);

            $mail->addReplyTo('job@ndhcare.co.uk', 'Job Portal');
            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;
            if( !$mail->send() ) {
                return true;
            } else {
                return true;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
