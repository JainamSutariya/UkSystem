<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use App\Models\Candidate;
use App\Http\Controllers\CandidateController;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->role === 'Branch' && $user->email == 'jobs@ndhcare.co.uk') {
                $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                $user->update(['otp' => $otp]);
                $request->session()->put('email', $user->email);
                $body = $otp . ' is your one time password (OTP). Please do not share the OTP with others.<br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568';
                $this->sendMail($user->email, $user->name, 'OTP for Login', $body);
                return redirect()->route('auth.verify')->with('email', $user->email);
            } else {
                // For other roles, proceed with regular authentication
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
                }
            }
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $data = $request->all();
        $data['role'] = "Candidate";
        $lastUser = $this->create($data);
        $candidateData = Candidate::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'user_id' => $lastUser->id,
        ]);
        $body = "Dear ". $data['first_name'] . ",<br><br> Thank you for joining our team. Now next step is submit your application form using your account.<br><br>If you have any concerns, you can send an email to jobs@ndhcarec.o.uk or feel free to contact 0121 448 0568.<br><br>Best Regards,<br><br>Recruitment Team<br>NDH Care Ltd";
        $candidateController = new CandidateController();
        $candidateController->sendMail($data['email'], $data['first_name'], 'Account Register Successfully!', $body, $candidateData->id, 3);
        return redirect("login")->withSuccess('Great! Your Account Successfully Register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            if (Auth::user()->role == 'Admin') {
                $candidateCount = Candidate::count();
                $pendingCandidate = Candidate::where('status', 'Pending')->count();
                $branchCount = User::where('role', 'Branch')->count();
                $rejectedCount = User::where('role', 'Branch')->count();
                return view('dashboard', compact('candidateCount', 'pendingCandidate', 'branchCount', 'rejectedCount'));
            } else if (Auth::user()->role == 'Candidate') {
                return redirect()->route('candidate.create');
            } else {
                return redirect()->route('branchCandidateList');
            }
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['first_name'],
        'email' => $data['email'],
        'mobile_number' => $data['mobile_number'] ?? null,
        'password' => Hash::make($data['password']),
        'role' => $data['role']
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
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

    public function showVerifyForm(Request $request)
    {
        $email = $request->session()->get('email');
        return view('auth.verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'digit1' => 'required|numeric',
            'digit2' => 'required|numeric',
            'digit3' => 'required|numeric',
            'digit4' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

        $otp = $request->input('digit1') . $request->input('digit2') . $request->input('digit3') . $request->input('digit4');
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        if ($user && $user->otp === $otp) {
            auth()->login($user);
            return redirect()->intended('dashboard')->withSuccess('You have Successfully logged in');
        }
        return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->withInput($request->input());
    }

    public function forgetPassword() {
        return view('auth.forget-password');
    }

    public function resetPasswordLink(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }
        $email = $request->email;
        $userData = User::where('email', $email)->first();
        if ($userData) {
            $resetToken = Str::random(60);
            $userData->update(['reset_token' => $resetToken]);
            $resetLink = url('reset-password', $resetToken);

            $body = 'To reset your password, click on the following link: <a href="' . $resetLink . '">Reset Password</a><br><br><br><br>Thank you,<br><br>Heena Patel,<br><br>Recruitment<br><br>NDH Care Ltd.<br>0121 448 0568';
            $this->sendMail($userData->email, $userData->name, 'Reset Password Link', $body);
            return redirect()->route('login');
        }
    }

    public function showResetPasswordForm($token) {
        $user = User::where('reset_token', $token)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('auth.passwords.reset', compact('user'));
    }

    public function passwordUpdate(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $userData = User::where('email', $request->email)->first();
        if ($userData) {
            $userData->password = Hash::make($request->password);
            $userData->save();
        }
        return redirect()->route('login')->withSuccess('Your password changed successfully');
    }

    public function userProfile($id) {
        $userData = User::find($id);
        $candidateData = [];
        if ($userData->role == 'Candidate') {
            $candidateData = Candidate::where('user_id', $userData->id)->first();
        }
        return view('auth.profile', compact('userData', 'candidateData'));
    }

    public function storeUserDetails(Request $request) {
        $requestData = $request->all();
        $userId = $request->user_id;
        $userData = User::find($userId);
        if ($userData->role == 'Candidate') {
            $candidateData = Candidate::where('user_id', $userData->id)->first();
            $candidateData->email = $requestData['email'];
            $candidateData->mobile_number = $requestData['mobile_number'];
            $candidateData->street_address = $requestData['street_address'];
            $candidateData->country = $requestData['country'];
            $requestData['signature'] = $candidateData ? $candidateData->signature : null;
            if (isset($request->signature) && !empty($request->signature)) {
                $image = $request->file('signature');
                $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/candidate/sign');
                $image->move($destinationPath, $name);
                $requestData['signature'] = asset('candidate/sign/' . $name);

                // $image_parts = explode(";base64,", $request->signature);
                // $image_type_aux = explode("image/", $image_parts[0]);
                // $image_type = $image_type_aux[1];
                // $image_base64 = base64_decode($image_parts[1]);
                // $signFileName = time() . '_' . uniqid() . '.' . $image_type;
                // $destinationPath = public_path('/candidate/sign');
                // $file = $destinationPath . '/' . $signFileName;
                // file_put_contents($file, $image_base64);
                // $requestData['signature'] = asset('candidate/sign/' . $signFileName);
            }
            $candidateData->signature = $requestData['signature'];
            if (isset($request->password) && !empty($request->password)) {
                $userData->password = Hash::make($requestData['password']);
                $userData->save();
            }
            $candidateData->save();
        }

        if ($userData->role == 'Branch') {
            $userData->name = $request->name;
            $userData->email = $request->email;
            if (isset($request->password) && !empty($request->password)) {
                $userData->password = Hash::make($request->password);
            }
            $requestData['signature'] = $userData ? $userData->signature : null;
            if ($request->hasFile('signature')) {
                $image = $request->file('signature');
                $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/candidate/sign');
                $image->move($destinationPath, $name);
                $requestData['signature'] = asset('candidate/sign/' . $name);

                // $image_parts = explode(";base64,", $request->signature);
                // $image_type_aux = explode("image/", $image_parts[0]);
                // $image_type = $image_type_aux[1];
                // $image_base64 = base64_decode($image_parts[1]);
                // $signFileName = time() . '_' . uniqid() . '.' . $image_type;
                // $destinationPath = public_path('/candidate/sign');
                // $file = $destinationPath . '/' . $signFileName;
                // file_put_contents($file, $image_base64);
                // $requestData['signature'] = asset('candidate/sign/' . $signFileName);
            }
            $userData->signature = $requestData['signature'];
            $userData->save();
        }
        return redirect()->route('userProfile', ['id' => $userId])->with('success', 'Profile updated successfully!');
    }
}
