<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'module.access:User Management']);
        // $this->middleware('module.permission:permissions-view')->only(['index']);
        // $this->middleware('module.permission:permissions-create')->only(['create', 'store']);
        // $this->middleware('module.permission:permissions-edit')->only(['edit', 'update']);
        // $this->middleware(['role:Super Admin', 'module.permission:permissions-delete'])->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leavetype = LeaveType::all();

            return DataTables::of($leavetype)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $editUrl = route('states.edit', Crypt::encrypt($row->id));
                    $deleteUrl = route('leave.type.destroy', Crypt::encrypt($row->id));

                    return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                    <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                })

                ->editColumn('leave_type', function ($row) {
                    return $row->leave_type;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        return view('leave-type.index', compact('header', 'sidebar'));
    }

    public function create()
    {
        $header = TRUE;
        $sidebar = TRUE;
        return view('leave-type.create', compact('header', 'sidebar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'leave_type' => 'required|max:100',
            ]);
            $leavetype = LeaveType::create($validated);
            return response()->json(['message' => 'Leave type created successfully', 'state'=>$leavetype]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('leave.type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $leavetype = LeaveType::where('id', Crypt::decrypt($id))->first();
            if ($leavetype) {
                return response()->json([
                    'leave_type' => $leavetype->leave_type
                ]);  // Return the state data as JSON
            } else {
                return response()->json(['message' => 'Leave type not found'], 404);
            }

        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('leave.type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'leave_type' => 'required|max:100'
            ]);
            $updatearray = [
                'leave_type' => $request->leave_type
            ];
            LeaveType::where('id', Crypt::decrypt($id))->update($updatearray);
            return response()->json(['message' => 'Leave type updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('leave.type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }

    }
    // Delete a department
    public function destroy($id)
    {
        try {
            $departments = LeaveType::find(Crypt::decrypt($id));
            if (!$departments) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('leave.type.index')->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            LeaveType::where('id', Crypt::decrypt($id))->update(['is_deleted' => true, 'updated_by' => auth()->user()->id]);
            Alert::success('Success', 'Leave type deleted successfully');
            return redirect()->route('leave.type.index')->with('success', 'Leave type deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('leave.type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}