<style>
span {
    font-size: 15px;
    letter-spacing: 1px;
    font-weight: 500;
}
.vertical-menu.\<div.data-simplebar.class\= {
    background-color: #2a3042;
}
li.menu-title {
    font-size: 23px;
    color: #fff !important;
}
a.active:active {
    color: #fff !important;
}
</style>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @guest
                @else
                @if (Auth::user()->role == 'Candidate')
                <li class="menu-title" key="t-menu">MENU LIST</li>
                <li>
                    <a href="{{route('candidate.create')}}">
                        <i class="bx bx bx-user"></i>
                        <span key="t-tables" >Candidate Form</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('candidateHistory')}}">
                        <i class="bx bx bx-user"></i>
                        <span key="t-tables" >History</span>
                    </a>
                </li>
                @php
                    $candidate = \App\Models\Candidate::where('user_id', Auth::user()->id)->first();
                @endphp
                @if ($candidate && $candidate->is_basic_test == 1 && $candidate->is_basic_submit == 0)
                <li>
                    <a href="{{route('basicEnglishTest', $candidate->id)}}">
                        <i class="bx bx bx-user"></i>
                        <span key="t-tables">Basic English Math Test</span>
                    </a>
                </li>
                @endif
                @if ($candidate && $candidate->is_training_complete == 1)
                @if (!empty($candidate->how_many_form) && $candidate->how_many_form > 0)
                @for ($i = 1; $i <= $candidate->how_many_form; $i++)
                    <li>
                        <a href="{{ route('careStaffObservation', ['formNumber' => $i, 'id' => $candidate->id]) }}">
                            <i class="bx bx bx-user"></i>
                            <span key="t-tables">Shadowing Form {{ $i }}</span>
                        </a>
                    </li>
                @endfor
                @else
                <li>
                    <a href="{{route('careStaffObservation', ['formNumber' => 1, 'id' => $candidate->id])}}">
                        <i class="bx bx bx-user"></i>
                        <span key="t-tables">Shadowing Form 1</span>
                    </a>
                </li>
                @endif
                @endif
                @elseif (Auth::user()->role == 'Admin')
                <li class="menu-title" key="t-menu">MENU LIST</li>
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="bx bxs-dashboard"></i>
                        <span key="t-tables">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminNotification')}}">
                        <i class="bx bx-notification"></i>
                        <span key="t-tables">Notification</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminCandidateList')}}">
                        <i class="bx bx-history"></i>
                        <span key="t-tables">History</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Action</li>
                <li>
                    <a href="{{route('branchList')}}">
                        <i class="bx bx-git-branch"></i>
                        <span key="t-tables">Branch Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminPendingData')}}">
                        <i class="bx bx-user"></i>
                        <span key="t-tables">Pending Application</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('candidateList')}}">
                        <i class="bx bxs-eraser"></i>
                        <span key="t-tables">New Application</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('telephonicInterview')}}">
                        <i class="bx bxs-phone"></i>
                        <span key="t-tables">Telephonic Interview</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminLiveScheduleList')}}">
                        <i class="bx bxs-stopwatch"></i>
                        <span key="t-tables">Live Interview</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">REPORTING</li>
                <li>
                    <a href="{{route('adminTrainingScheduleList')}}">
                        <i class="bx bx-time-five"></i>
                        <span key="t-tables">Training Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminTrainingRunning')}}">
                        <i class="bx bx-pie-chart-alt-2"></i>
                        <span key="t-tables">Training Running</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminTrainingComplete')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Training Complete</span>
                    </a>
                </li>
                @else
                <li class="menu-title" key="t-menu">MENU LIST</li>
                <li>
                    <a href="{{route('branchCandidateList')}}">
                        <i class="bx bx bx-user"></i>
                        <span key="t-tables">Candidate List</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('telephonicList')}}">
                        <i class="bx bx bx-phone"></i>
                        <span key="t-tables">Telephonic Screening</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('liveScheduleList')}}">
                        <i class="bx bx bx-stopwatch"></i>
                        <span key="t-tables">Live Interview Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('liveScheduleNote')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Live Interview Note</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('applicantIdentity')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Applicant Identity</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('rightToWork')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Right To Work</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('conditionalOffer')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Conditional Offer</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dbsCheck')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">DBS Check</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('referenceList')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Reference Varification</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('referenceLog')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Reference Logs</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('completeReference')}}">
                        <i class="bx bx bx-note"></i>
                        <span key="t-tables">Complete Reference</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">REPORTING</li>
                <li>
                    <a href="{{route('trainingScheduleList')}}">
                        <i class="bx bx-time-five"></i>
                        <span key="t-tables">Training Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('trainingRunning')}}">
                        <i class="bx bx-pie-chart-alt-2"></i>
                        <span key="t-tables">Training Running</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('trainingComplete')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Training Complete</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('offerLetter')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Offer Letter</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('gdprAgreement')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">GDPR Agreement</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('staffRiskAssessment')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Staff Risk Assessment</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('empContract')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Employment Contract</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('covid19Statement')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Covid-19 Staff Confirmation Statement</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('availabilityForm')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Availability Forms</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Current Staff</li>
                <li>
                    <a href="{{route('allDocument')}}">
                        <i class="bx bxs-save"></i>
                        <span key="t-tables">Current Staff List</span>
                    </a>
                </li>
                @endif
                @endguest
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
