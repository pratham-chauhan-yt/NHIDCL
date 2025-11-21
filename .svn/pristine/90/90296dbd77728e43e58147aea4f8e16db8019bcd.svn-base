<?php

namespace App\Http\Controllers\BankManagement;


use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Uploader\ProjectRequest;
use DB;

use App\Http\Controllers\Controller;
use App\Models\NhidclProject;
use App\Models\RefState;
use App\Models\RefProjectType;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module.permission:bgms-project-list')->only(['index']);
        $this->middleware('module.permission:bgms-project-create')->only(['create', 'store']);
        $this->middleware('module.permission:bgms-project-edit')->only(['edit', 'update']);
        $this->middleware('module.permission:bgms-project-view')->only(['show']);
        $this->middleware('module.permission:bgms-project-delete')->only(['destroy']);
    }

    public function dashboard()
    {
        $header = true;

        $sidebar = true;


        $states = RefState::where("is_deleted", "false")->get();

        return view("bank-management.uploader.project.dashboard", compact("header", "sidebar", "states"));
    }

    public function index(Request $request)
    {

        $header = true;
        $sidebar = true;

        if ($request->ajax()) {
            $query = NhidclProject::with(['projectState', 'projectType'])
                ->orderBy('created_by', 'desc');

            return DataTables::of($query)
                ->addColumn('project_state', function ($row) {

                    return $row->projectState->state_name ?? 'N/A';
                })
                ->addColumn('project_type', function ($row) {
                    return $row->projectType->project_type ?? 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    return view('components.action-buttons', [
                        'id' => $row->id,
                        'creator_id' => $row->created_by ?? null,
                        'buttons' => ['show', 'edit', 'delete'],
                        'routePrefix' => 'bgms.project',
                        'role' => 'UploaderProject',
                        'module' => 'bgms-project'
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view("bank-management.uploader.project.index", compact("header", "sidebar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header = true;
        $sidebar = true;

        $bgmsAssignedState = bgmsAssignedState();
        return view("bank-management.uploader.project.create", compact("header", "sidebar", "bgmsAssignedState"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {

            $inputs = $request->all();

            $projectId  = getProjectId();

            $project = NhidclProject::create([
                'job_no' => $inputs['job_no'],
                'project_id' => $projectId,
                'upc_no' => $inputs['upc_no'],
                'project_name' => $inputs['project_name'],
                'ref_project_type_id' => $inputs['ref_project_type_id'],
                'ref_project_state_id' => $inputs['ref_project_state_id'],
                'sap_id' => $inputs['sap_id'],
                "created_by" => user_id(),
                "created_at" => now()
            ]);

            Alert::success('Success', 'Project created successfully');
            return redirect()->back()->with(["tab" => "ProjectList"]);
        } catch (Exception $e) {

            Log::info("project Create", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.project.index")->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $sidebar = True;
        $header = True;
        $project = NhidclProject::findOrFail(decryptId($id));
        return view('bank-management.uploader.project.viewproject', compact('project', 'header', 'sidebar'));
        // echo "Under development UI Pending";
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $sidebar = True;
            $header = True;
            $project = NhidclProject::findOrFail(decryptId($id));

            return view('bank-management.uploader.project.edit', compact('project', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('bgms.project.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, $id)
    {
        try {

            $project = NhidclProject::findOrFail(decryptId($id));

            $inputs = $request->all();

            $project->update([
                'job_no' => $inputs['job_no'],
                'upc_no' => $inputs['upc_no'],
                'project_name' => $inputs['project_name'],
                'ref_project_type_id' => $inputs['ref_project_type_id'],
                'ref_project_state_id' => $inputs['ref_project_state_id'],
                'sap_id' => $inputs['sap_id'],
                'updated_by' => user_id(),
                'updated_at' => now(),
            ]);

            Alert::success('Success', 'Project updated successfully');
            return redirect()->route("bgms.project.create")->with(["tab" => "ProjectList"]);
        } catch (Exception $e) {
            Log::info("project update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.project.index")->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {

            $project = NhidclProject::find(decryptId($id));

            if (!$project) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('bgms.project.index');
            }

            $project->is_deleted = true;

            $project->save();

            foreach ($project->bg as $bg) {
                $bg->receiving()->delete();
                $bg->renewals()->delete();
                $bg->delete();
            }

            $project->delete();

            Alert::success('Success', 'Project deleted successfully');

            return redirect()->route('bgms.project.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            Log::info("project delete", ['E' => $e->getMessage()]);

            return redirect()->route('bgms.project.index');
        }
    }

    public function list()
    {
        $header = true;
        $sidebar = true;

        $bgmsAssignedState = bgmsAssignedState();
        return view("bank-management.uploader.project.list", compact("header", "sidebar", "bgmsAssignedState"));
    }
    public function stateSearch(Request $request)
    {
        if ($request->state == 'all') {
            $data['project_data'] = NhidclProject::
                select('ref_project_type_id', \DB::raw('COUNT(*) as total'))
                ->groupBy('ref_project_type_id')
                ->get();
        } else {
            $type = RefProjectType::pluck('project_type', 'id')->get();
            $data['project_data'] = NhidclProject::where('ref_project_state_id', $request->state)
                ->select($type->project_type, \DB::raw('COUNT(*) as total'))
                ->groupBy('ref_project_type_id')
                ->get();
        }

        return view('bank-management.uploader.project.task', $data)->render();
    }
}
