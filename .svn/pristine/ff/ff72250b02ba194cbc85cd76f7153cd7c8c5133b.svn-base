<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\{AdvertisementPost, NhidclRecruitmentApplications, NhidclRecruitmentApplicationsLogs};
use Illuminate\Http\Request;
use App\Models\{User, Role, Grievance};
use App\Models\Recruitment\CandidateProfile\NhidclRpApplicantPersonalDetails;
use App\Models\Recruitment\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Additional check after auth: verify user still exists
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user && !User::find($user->id)) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('auth.login')
                    ->withErrors(['error' => 'Your session is no longer valid. Please log in again.']);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $header = TRUE;
        $sidebar = TRUE;
        $userId = Auth::user()->id;
        $sections = [
            'ref_applicant_personal_details' => DB::table('ref_applicant_personal_details')->where('ref_users_id', $userId)->exists(),
            'nhidcl_applicant_education_details' => DB::table('nhidcl_applicant_education_details')->where('ref_users_id', $userId)->exists(),
            'nhidcl_applicant_work_experience_details' => DB::table('nhidcl_applicant_work_experience_details')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_applicant_additional_details' => DB::table('nhidcl_applicant_additional_details')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_competitive_exams' => DB::table('nhidcl_competitive_exams')->where('ref_users_id', $userId)->exists(),
            //'nhidcl_training_certificate' => DB::table('nhidcl_training_certificate')->where('ref_users_id', $userId)->exists(),
            'nhidcl_disclouser_questions' => DB::table('nhidcl_disclouser_questions')->where('ref_users_id', $userId)->exists(),
        ];

        $filled = array_filter($sections);
        $totalSections = count($sections);
        $completed = count($filled);
        $percentage = ($completed / $totalSections) * 100;

        $statusCounts = DB::table('ref_users as u')
        ->join('nhidcl_user_status as us', 'u.id', '=', 'us.ref_users_id')
        ->join('ref_interview_status as ris', 'us.ref_interview_status_id', '=', 'ris.id')
        ->select('ris.status', DB::raw('COUNT(*) as total'))
        ->whereIn('ris.status', ['SHORTLISTED', 'REJECTED', 'SELECTED', 'RESERVED'])
        ->groupBy('ris.status')
        ->pluck('total', 'status'); // This gives: ['SHORTLISTED' => 10, 'REJECTED' => 5, 'SELECTED' => 7]
        $ShortlestedUser = $statusCounts['SHORTLISTED'] ?? 0;
        $rejectedUser    = $statusCounts['REJECTED'] ?? 0;
        $selectedUser    = $statusCounts['SELECTED'] ?? 0;
        $ReservedUsers   = $statusCounts['RESERVED'] ?? 0;

        if ($request->ajax()) {
            $advertisementId = $request->input('advertisementId');

            // Process...
            if ($advertisementId) {
                $data = AdvertisementPost::where("nhidcl_recruitment_advertisement_id", $advertisementId)->get();
                return response()->json([
                    'status' => true,
                    'data' => $data
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid Advertisement ID'
            ]);
        }

        if(auth()->user()->hasRole('Super Admin')){
            session(['moduleName' => 'User Management System']);
            $userQuery = User::where('is_deleted', '!=', '1')
            ->whereHas('roles', function ($query) {
                $query->whereIN('name', ['HR Admin', 'HR-Recruitment']);
            });
            $users = $userQuery->orderBy('id', 'DESC')->get();
            $application = NhidclRpApplicantPersonalDetails::with('user', 'education.passingYear', 'gatescore.passingYear', 'gatescore.gateDiscpline', 'experience')->get();
            $advertisement = Advertisement::count();
            $post = AdvertisementPost::count();
            $incompleteCount = NhidclRpApplicantPersonalDetails::query()
            ->whereDoesntHave('user')
            ->orWhereDoesntHave('education')
            ->orWhereDoesntHave('gatescore')
            ->orWhereDoesntHave('experience')
            ->count();
            $counts = Advertisement::select(
                    DB::raw("CASE WHEN expiry_datetime >= NOW() THEN 'active' ELSE 'closed' END as status"),
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('status')
                ->pluck('total','status');

            // Add total count
            $counts['total'] = array_sum($counts->toArray());
            return view('dashboard.index', compact('header', 'sidebar', 'users', 'application', 'advertisement', 'post', 'incompleteCount', 'counts', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser', 'percentage', 'sections', 'completed', 'totalSections') + [
            'chartData' => [
                'Shortlisted' => $ShortlestedUser,
                'Selected' => $selectedUser ?? 0,
                'Rejected'    => $rejectedUser,
            ]]);
        }elseif (auth()->user()->hasRole(['HR-Recruitment', 'Recruitment User'])){
            session(['moduleName' => 'Recruitment Portal']);
            $userQuery = User::whereNull('deleted_at')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Recruitment User');
            });
            $users = $userQuery->orderBy('id', 'DESC')->get();
            $application = NhidclRecruitmentApplications::query()
            ->where('action', 'submit')
            ->whereNull('deleted_at') // exclude soft-deleted applications
            ->whereIn('nhidcl_recruitment_posts_id', function ($q) {
                $q->select('id')
                ->from('nhidcl_recruitment_posts')
                ->whereNull('deleted_at'); // exclude soft-deleted posts
            })
            ->get();

            $appcounts = NhidclRecruitmentApplicationsLogs::query()
            ->where('status', 'submit')
            ->whereNull('deleted_at')->count();

            $advertisement = Advertisement::whereNull('deleted_at')->count();
            $post = AdvertisementPost::whereNull('deleted_at')->count();
            $incompleteCount = NhidclRecruitmentApplications::query()->where('action', 'draft')->orWhereNull('action')->count();
            
            $counts = Advertisement::select(
                    DB::raw("CASE WHEN expiry_datetime >= NOW() THEN 'active' ELSE 'closed' END as status"),
                    DB::raw("COUNT(*) as total")
                )
                ->whereNull('deleted_at')
                ->groupBy('status')
                ->pluck('total','status');
            // Add total count
            $counts['total'] = array_sum($counts->toArray());
            $distribution = NhidclRpApplicantPersonalDetails::with('caste')
            ->select('gender', 'ref_caste_id', DB::raw('COUNT(*) as total'))
            ->groupBy('gender', 'ref_caste_id')
            ->get()
            ->map(function($row) {
                return [
                    'gender'   => $row->gender,
                    'category' => $row->caste ? $row->caste->caste : null,
                    'total'    => $row->total,
                ];
            });
            //dd($distribution);
            $listOfAdvertisement = Advertisement::whereNull('deleted_at')->orderBy('id', 'asc')->get();
            return view('recruitment-management.dashboard', compact('header', 'sidebar', 'listOfAdvertisement', 'distribution', 'counts', 'advertisement', 'post', 'incompleteCount', 'users', 'application', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser', 'appcounts') + [
            'chartData' => [
                'Shortlisted' => $ShortlestedUser,
                'Selected' => $selectedUser ?? 0,
                'Rejected'    => $rejectedUser,
            ]]);
        }else{
            session(['moduleName' => 'Resource Pool Portal']);
            return view('recruitment-management.dashboard', compact('header', 'sidebar', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser', 'percentage', 'sections', 'completed', 'totalSections') + [
            'chartData' => [
                'Shortlisted' => $ShortlestedUser,
                'Selected' => $selectedUser ?? 0,
                'Rejected'    => $rejectedUser,
            ]]);
        }
        //return view('dashboard.index', compact('header', 'sidebar', 'ReservedUsers', 'ShortlestedUser', 'rejectedUser', 'selectedUser', 'percentage', 'sections', 'completed', 'totalSections'));
    }

}
