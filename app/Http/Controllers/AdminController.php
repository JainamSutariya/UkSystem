<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use Yajra\DataTables\DataTables;
use App\Models\TrainingRunning;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationLog;

class AdminController extends Controller
{

    public function adminLiveScheduleList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.live-interview-schedule-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAdminLiveScheduleList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateTelephonic','>', 0)
                    ->orderBy('candidate.created_at', 'desc')
                    ->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn btn-primary candidateLiveInterview" id="'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('test_access', function($row){
                        if ($row->is_basic_test == 0) {
                            $btn = '<button class="btn btn-danger" onclick="testAccess('.$row->id.', \'1\')">No</button>';
                        } else {
                            $btn = '<button class="btn btn-success" onclick="testAccess('.$row->id.', \'0\')">Yes</button>';
                        }
                        return $btn;
                    })
                    ->addColumn('show_candidate_test', function($row){
                        if ($row->is_basic_submit == 1) {
                            $btn = '<a class="btn btn-secondary" href="basic-english-test/'. $row->id .'">Show</a>';
                        } else {
                            $btn = '';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'profile', 'test_access', 'show_candidate_test'])
                    ->make(true);
        }
    }

    public function adminCandidateList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-candidate-list');
        }
        return redirect()->route('dashboard');
    }

    public function getAdminCandidate(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->orderBy('candidate.created_at', 'desc')->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('history', function($row){
                        $btn = '<a class="btn btn-success" href="get-admin-candidate-history/'. $row->id .'">History</a>';
                        return $btn;
                    })
                    ->rawColumns(['profile', 'history'])
                    ->make(true);
        }
    }

    public function getAdminCandidateHistory($id) {
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
        $candidate = Candidate::where('id', $id)->first();
        if (!$candidate) {
            return redirect()->route('dashboard');
        }
        return view('admin.history', compact('candidate'));
    }

    public function adminTrainingScheduleList(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-training-schedule-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAdminTrainingScheduleList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTrainingSchedule'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->leftJoin('reference_list', 'candidate.id', '=', 'reference_list.candidate_id')
                    ->has('candidateReference','>', 0)
                    // ->where('reference_list.status_1', 'Approved')
                    // ->where('reference_list.status_2', 'Approved')
                    ->orderBy('candidate.created_at', 'desc');
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        if ($row->candidate_training_schedule_count != 0) {
                            $btn = '<a class="btn btn-primary trainingSchedule" id="'. $row->id .'">Update</a>';
                        } else {
                            $btn = '<a class="btn btn-primary trainingSchedule" id="'. $row->id .'">View</a>';
                        }
                        return $btn;
                    })
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'profile'])
                    ->make(true);
        }
    }

    public function adminTrainingRunning(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-training-running-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAdminTrainingRunningList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->withCount(['candidateTrainingSchedule'])
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->has('candidateTrainingSchedule','>', 0)
                    ->orderBy('candidate.created_at', 'desc');
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="admin-training-running/'.$row->id.'" class="btn btn-primary" id="'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'profile'])
                    ->make(true);
        }
    }

    public function adminTrainingPage($id) {
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Admin') {
            $training = TrainingRunning::where('candidate_id', $id)->get();
            foreach ($training as $value) {
                $value->date = date('d-m-Y', strtotime($value->date));
                $value->time_in = date('h:i A', strtotime($value->time_in));
                $value->time_out = date('h:i A', strtotime($value->time_out));
            }
            return view('admin.admin-training-running-page', compact('training', 'id'));
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function adminTrainingComplete(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-training-complete-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAdminTrainingCompleteList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = Candidate::select('candidate.*', 'users.name as branch_name')
                    ->leftJoin('users', 'candidate.branch_id', '=', 'users.id')
                    ->where('is_complete', 'Yes')
                    ->orderBy('candidate.created_at', 'desc');
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('profile', function($row){
                        $btn = '<a class="btn btn-primary" href="candidate/'. $row->id .'">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['profile'])
                    ->make(true);
        }
    }

    public function adminPendingData(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-candidate-pending-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function getAdminPendingList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = User::select('users.id', 'users.name', 'users.email', 'users.mobile_number', 'users.role', DB::raw("DATE_FORMAT(users.created_at, '%d/%m/%Y %h:%i %p') as formatted_created_at"))
                ->leftJoin('candidate', 'users.id', '=', 'candidate.user_id')
                ->where('candidate.is_submit', '=', 'No');
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    public function adminNotification(Request $request) {
        if (Auth::user()->role == 'Admin') {
            return view('admin.admin-candidate-notification-list');
        }
        if (Auth::user()->role == 'Branch') {
            return redirect()->route('branchCandidateList');
        }
        if (Auth::user()->role == 'Candidate') {
            return redirect()->route('candidate.create');
        }
    }

    public function adminNotificationList(Request $request) {
        if ($request->ajax()) {
            $data = [];
            if (Auth::user()->role == 'Admin') {
                $data = NotificationLog::select('notification_logs.id', 'candidate.first_name as name', 'candidate.email', 'notification_logs.subject', 'notification_logs.status', DB::raw("DATE_FORMAT(notification_logs.created_at, '%d/%m/%Y %h:%i %p') as formatted_created_at"))
                ->leftJoin('candidate', 'notification_logs.candidate_id', '=', 'candidate.id');
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
    }
}
