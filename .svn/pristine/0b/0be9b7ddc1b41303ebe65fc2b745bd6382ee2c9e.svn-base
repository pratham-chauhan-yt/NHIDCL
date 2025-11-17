<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhidclEmsEmployeeAppraisalCycle;
use App\Models\NhidclEmsEmployeeAppraisalDetail;
use App\Models\NhidclEmsEmployeeAppraisalRating;
use App\Models\NhidclEmsEmployeeAppraisalKpi;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;



class AppraisalManagementController extends Controller
{
    //
    // Show list of appraisals
    public function appraisalList()
    {
        $allCycles = NhidclEmsEmployeeAppraisalCycle::where('is_deleted', false)
            ->orderBy('id', 'desc')
            ->get(); // ✅ use get() instead of paginate()

        $statuses = DB::table('ref_status')->get();


        $header = true;
        $sidebar = true;

        return view('appraisal.appraisallist', compact('header', 'sidebar', 'allCycles', 'statuses'));
    }


    // Show form to create new appraisal
    public function appraisalCreate()
    {
        $statuses = DB::table('ref_status')->get();
        $header = true;
        $sidebar = true;
        return view('appraisal.appraisalcreate', compact('header', 'sidebar', 'statuses')); // resources/views/appraisal/appraisalcreate.blade.php
    }
    public function changeStatus($id)
    {
        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($id);

        // Toggle status (1 = Active, 0 = Inactive)
        $cycle->ref_status_id = $cycle->ref_status_id == 1 ? 0 : 1;
        $cycle->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    public function storeAppraisal(Request $request)
    {
        $request->validate([
            'cycle_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        //  dd(Auth::user()->id);
        $login_user_Id = Auth::user()->id;

        $cycle =    NhidclEmsEmployeeAppraisalCycle::create([
            'cycle_name' => $request->cycle_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'ref_status_id' =>  $request->status,
            'created_by' => $login_user_Id,
            'created_at' => now(),

        ]);

        $cycleId = $cycle->id;

        // 3️⃣ Insert record in nhidcl_ems_employee_appraisal_details
        NhidclEmsEmployeeAppraisalDetail::create([
            'ref_users_id' => $login_user_Id,
            'nhidcl_ems_appraisal_cycle_id' => $cycleId,
            'created_by' => $login_user_Id,
            'created_at' => now(),
        ]);



        return redirect()->back()->with('success', 'Create Appraisal submitted successfully!');
    }


    public function edit($id)
    {
        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($id);

        // Get statuses for dropdown
        $statuses = DB::table('ref_status')->get();
        $header = true;
        $sidebar = true;


        return view('appraisal.appraisal_edit', compact('header', 'sidebar', 'cycle', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cycle_name' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required',
        ]);

        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($id);

        $cycle->update([
            'cycle_name' => $request->cycle_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'ref_status_id' => $request->status,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ]);

        return redirect()->route('employee-management.appraisal.appraisallist')
            ->with('success', 'Appraisal Cycle updated successfully!');
    }

    public function assignEmployeesToCycle(Request $request)
    {

        $allCycles = NhidclEmsEmployeeAppraisalCycle::where('is_deleted', false)
            ->orderBy('id', 'desc')
            ->get(); //  use get() instead of paginate()

        $statuses = DB::table('ref_status')->get();


        $header = true;
        $sidebar = true;

        return view('appraisal.appraisallist', compact('header', 'sidebar', 'allCycles', 'statuses'));
    }

    public function showAssignForm()
    {
        $cycles = NhidclEmsEmployeeAppraisalCycle::where('ref_status_id', 3)->get();
        // $employees = DB::table('users')->where('role', 'Employee')->get();
        // $managers = DB::table('users')->where('role', 'Manager')->get();
        $employees = DB::table('ref_users')->get();
        $managers = DB::table('ref_users')->get();
        $header = true;
        $sidebar = true;

        return view('appraisal.assign_employees', compact('header', 'sidebar', 'cycles', 'employees', 'managers'));
    }
    // AppraisalManagementController.php
    public function assignEmployees(Request $request)
    {
        // $request->validate([
        //     'cycle_id' => 'required',
        //     'employee_ids' => 'required|array',
        //     'employee_ids.*' => 'exists:users,id',
        //     'manager_id' => 'required|exists:users,id',
        // ]);

        $login_user_Id =  Auth::user()->id;
        $successCount = 0;
        $failedCount = 0;
        foreach ($request->employee_ids as $empId) {
            try {
                $insert =  NhidclEmsEmployeeAppraisalDetail::create([
                    'nhidcl_ems_employee_appraisal_cycle_id' => $request->cycle_id,
                    'ref_users_id' => $empId,
                    'ref_users_id_gm' => $request->manager_id,
                    'ref_status_id_gm' => 1, // “Assigned”
                    'created_by' => $login_user_Id,
                    'created_at' => now(),
                ]);
                if ($insert) {
                    $successCount++;
                    Log::info("✅ Appraisal detail inserted for employee ID: {$empId}");
                } else {
                    $failedCount++;
                    Log::warning("⚠️ Insert failed for employee ID: {$empId}");
                }
            } catch (\Exception $e) {
                $failedCount++;
                Log::error("❌ Exception for employee ID {$empId}: " . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Employees assigned successfully!');
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'appraisal_detail_id' => 'required|exists:nhidcl_ems_employee_appraisal_details,id',
            'goal_title' => 'required|string|max:255',
            'self_rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $rating = NhidclEmsEmployeeAppraisalRating::create([
            'nhidcl_ems_appraisal_details_id' => $request->appraisal_detail_id,
            'goal_title' => $request->goal_title,
            'self_rating' => $request->self_rating,
            'comment' => $request->comment,
            'created_by' => Auth::id(),   // ✅ Track who inserted
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Rating saved successfully!');
    }

    public function viewRatings($appraisalDetailId)
    {
        $ratings = NhidclEmsEmployeeAppraisalRating::with('createdBy')
            ->where('nhidcl_ems_appraisal_details_id', $appraisalDetailId)
            ->where('is_deleted', false)
            ->orderBy('id', 'desc')
            ->get();

        return view('appraisal.rating_list', compact('ratings'));
    }


    public function index($cycleId)
    {
        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($cycleId);
        $kpis = NhidclEmsEmployeeAppraisalKpi::where('nhidcl_ems_employee_appraisal_cycle_id', $cycleId)
            //  ->where('is_deleted', false)
            ->orderBy('id', 'desc')
            ->get();
        $statuses = DB::table('ref_status')->get();
        //  $kpis=array();
        $header = true;
        $sidebar = true;
        return view('appraisal.kpi.index', compact('header', 'sidebar', 'cycle', 'kpis', 'statuses'));
    }
    public function create($cycleId)
    {
        $header = true;
        $sidebar = true;
        $statuses = DB::table('ref_status')->get();
        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($cycleId);
        return view('appraisal.kpi.create', compact('header', 'sidebar', 'cycle', 'statuses'));
    }

    // ✅ 3️⃣ Store new KPI
    public function store(Request $request)
    {
        $request->validate([
            'cycle_id' => 'required',
            'kpi_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        NhidclEmsEmployeeAppraisalKpi::create([
            'kpi_name' => $request->kpi_name,
            'nhidcl_ems_employee_appraisal_cycle_id' => $request->cycle_id,
            'ref_status_id' => $request->status,
            'created_by' => Auth::id(),
            'created_at' => now(),
        ]);

        return redirect()->route('employee-management.kpi.index', $request->cycle_id)
            ->with('success', 'KPI created successfully!');
    }

    // ✅ 4️⃣ Edit KPI
    public function editKpi($id)
    {
        $header = true;
        $sidebar = true;
        $statuses = DB::table('ref_status')->get();
        $kpi = NhidclEmsEmployeeAppraisalKpi::findOrFail($id);
        return view('appraisal.kpi.edit', compact('kpi', 'header', 'sidebar', 'statuses'));
    }

    // ✅ 5️⃣ Update KPI
    public function updateKpi(Request $request, $id)
    {
        $request->validate([
            'kpi_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $kpi = NhidclEmsEmployeeAppraisalKpi::findOrFail($id);
        $kpi->update([
            'kpi_name' => $request->kpi_name,
            'ref_status_id' => $request->status,
            'updated_by' => Auth::id(),
            'updated_at' => now(),

        ]);

        return redirect()->route('employee-management.kpi.index', $kpi->nhidcl_ems_employee_appraisal_cycle_id)
            ->with('success', 'KPI updated successfully!');
    }
    public function selfappraisalList()
    {

        $allCycles = NhidclEmsEmployeeAppraisalCycle::where('is_deleted', false)->where('ref_status_id', 3)
            ->orderBy('id', 'desc')
            ->get(); // ✅ use get() instead of paginate()

        $statuses = DB::table('ref_status')->get();


        $header = true;
        $sidebar = true;

        return view('appraisal.selfappraisal.selfappraisallist', compact('header', 'sidebar', 'allCycles', 'statuses'));
    }

    public function selfAppraisalForm($cycleId)
    {
        $employeeId = Auth::id();

        // Get all KPIs for this cycle
        $kpis = NhidclEmsEmployeeAppraisalKpi::where('nhidcl_ems_employee_appraisal_cycle_id', $cycleId)
            ->where('ref_status_id', '3')
            ->get();

        // Get existing ratings (if already filled)
        $ratings = NhidclEmsEmployeeAppraisalRating::where('created_by', $employeeId)
            ->where('is_deleted', false)
            ->get();
        // ->keyBy('goal_title');
        $header = true;
        $sidebar = true;
        $cycle = NhidclEmsEmployeeAppraisalCycle::findOrFail($cycleId);


        return view('appraisal.selfappraisal.self_form', compact('header', 'sidebar', 'cycleId', 'kpis', 'ratings', 'cycle'));
    }

    public function storeSelfAppraisal(Request $request)
    {
        $employeeId = Auth::id();
        //dd($request->all());
        foreach ($request->kpi_name as $index => $kpiName) {
            NhidclEmsEmployeeAppraisalRating::updateOrCreate(
                [
                    'goal_title' => $kpiName,
                    'created_by' => $employeeId,
                    'nhidcl_ems_appraisal_details_id' => $request->appraisal_detail_id,
                ],
                [
                    'self_rating' => $request->self_rating[$index],
                    'comment' => $request->comment[$index],
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->back()->with('success', 'Self-appraisal submitted successfully!');
    }

    public function employeeappraisalList()
    {
        $reporting_manager_id = Auth::id();
        $allCycles = NhidclEmsEmployeeAppraisalCycle::where('is_deleted', false)->where('ref_status_id', 3)
            ->orderBy('id', 'desc')
            ->get(); // ✅ use get() instead of paginate()

        $listofemployee = DB::table('ref_users')->where('reporting_manager_id', $reporting_manager_id)->get();
        //  print_r($listofemployee);die;

        //   $statuses = DB::table('ref_status')->get();


        $header = true;
        $sidebar = true;

        return view('appraisal.manager.employeeappraisallist', compact('header', 'sidebar', 'allCycles', 'listofemployee'));
    }

    public function listEmployees()
    {
        $reporting_manager_id = Auth::id();

        $listofemployee = DB::table('ref_users')
            ->where('reporting_manager_id', $reporting_manager_id)
            // ->select('id', 'name', 'email', 'designation')
            ->get();
        $cycles =   NhidclEmsEmployeeAppraisalCycle::where('is_deleted', false)->where('ref_status_id', 3)
            ->orderBy('id', 'desc')
            ->get(); // ✅ use get() instead of paginate()
        $header = true;
        $sidebar = true;

        return view('appraisal.manager.employee_list', compact('listofemployee', 'header', 'sidebar', 'cycles'));
    }

    // ✅ Show employee’s KPI for evaluation
    public function evaluate($employeeId, $cycleId)
    {
        // Get all active KPIs for this cycle
        $kpis = DB::table('nhidcl_ems_employee_appraisal_kpi')
            ->where('nhidcl_ems_employee_appraisal_cycle_id', $cycleId)
            ->where('ref_status_id', '3')
            ->get();

        // Get previous ratings by employee (if self-filled)
        $ratings = DB::table('nhidcl_ems_employee_appraisal_rating')
            ->where('created_by', $employeeId)
            ->where('nhidcl_ems_appraisal_details_id', $cycleId)
            ->get()
            ->keyBy('goal_title');
        $employee = DB::table('ref_users')
            ->select('id', 'name', 'email')
            ->where('id', $employeeId)
            ->first();

        // Get cycle name
        $cycle = DB::table('nhidcl_ems_employee_appraisal_cycle')
            ->select('id', 'cycle_name')
            ->where('id', $cycleId)
            ->first();

        $header = true;
        $sidebar = true;

        return view('appraisal.manager.evaluate', compact('employeeId', 'employee', 'cycle', 'header', 'sidebar', 'cycleId', 'kpis', 'ratings'));
    }

    // ✅ Store Manager Ratings

    public function storemanagerRating(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer',
            'cycle_id' => 'required|integer',
            'ratings' => 'required|array',
        ]);

        foreach ($request->ratings as $kpi_id => $data) {
            DB::table('nhidcl_ems_employee_appraisal_rating')->updateOrInsert(
                [
                    'nhidcl_ems_appraisal_details_id' => $request->cycle_id,
                    'created_by' => $request->employee_id,
                    'goal_title' => $data['goal_title'],
                ],
                [
                    'gm_rating' => $data['manager_rating'],
                    'comment' => $data['comment'] ?? null,
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]
            );
        }

        return back()->with('success', 'Manager ratings saved successfully!');
    }


    public function listForEvaluation()
    {
        // Get employees who have both self and manager ratings completed
        $employees = DB::table('nhidcl_ems_employee_appraisal_rating as r')
            ->join('ref_users as u', 'r.created_by', '=', 'u.id')
            ->join('nhidcl_ems_employee_appraisal_cycle as c', 'r.nhidcl_ems_appraisal_details_id', '=', 'c.id')
            ->select(
                'u.id as employee_id',
                'u.name as employee_name',
                'u.email',
                'c.id as cycle_id',
                'c.cycle_name'
            )
            ->whereNotNull('r.self_rating')
            ->whereNotNull('r.gm_rating') // Manager rating done
            ->groupBy('u.id', 'u.name', 'u.email', 'c.id', 'c.cycle_name')
            ->get();

        $header = true;
        $sidebar = true;

        return view('appraisal.hr.hr_employee_list', compact('employees', 'header', 'sidebar'));
    }
    public function hrEvaluate($employeeId, $cycleId)
    {
        // Fetch all KPIs for this cycle
        $kpis = DB::table('nhidcl_ems_employee_appraisal_kpi')
            ->where('nhidcl_ems_employee_appraisal_cycle_id', $cycleId)
            ->where('ref_status_id', 3)
            ->get();

        // Get existing ratings
        $ratings = DB::table('nhidcl_ems_employee_appraisal_rating')
            ->where('nhidcl_ems_appraisal_details_id', $cycleId)
            ->where('created_by', $employeeId)
            ->get()
            ->keyBy('goal_title');

        // Get employee + cycle name
        $employee = DB::table('ref_users')->find($employeeId);
        $cycle = DB::table('nhidcl_ems_employee_appraisal_cycle')->find($cycleId);


        $header = true;
        $sidebar = true;

        return view('appraisal.hr.hr_evaluate', compact('header', 'sidebar', 'employee', 'cycle', 'kpis', 'ratings'));
    }

    public function storeRatinghr(Request $request)
    {
        $employeeId = $request->employee_id;
        $cycleId = $request->cycle_id;

        foreach ($request->hr_rating as $goal => $hrRating) {
            DB::table('nhidcl_ems_employee_appraisal_rating')
                ->updateOrInsert(
                    [
                        'nhidcl_ems_appraisal_details_id' => $cycleId,
                        'goal_title' => $goal,
                        'created_by' => $employeeId
                    ],
                    [
                        'hr_rating' => $hrRating,
                        'comment' => $request->comment[$goal] ?? null,
                        'updated_by' => Auth::id(),
                        'updated_at' => now()
                    ]
                );
        }

        return redirect()->back()->with('success', 'HR ratings saved successfully!');
    }
}
