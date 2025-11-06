<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\RefAuditType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AuditTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $getData = RefAuditType::orderBy('audit_type', 'desc')->get();

            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('master-settings.audit-type.destroy', Crypt::encrypt($row->id));

                    return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                    <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                })

                ->editColumn('audit_type', function ($row) {
                    return $row->audit_type;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = true;
        $sidebar = true;
        return view("master-settings.auditType", compact("header", "sidebar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'audit_type' => 'required|max:100',
            ]);
            $saveData = RefAuditType::create($validated);
            return response()->json(['message' => 'Audit Type successfully', 'exam' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.audit-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
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
    public function edit(string $id)
    {
        try {
            $verifyId = RefAuditType::where('id', Crypt::decrypt($id))->first();
            if ($verifyId) {
                return response()->json([
                    'audit_type' => $verifyId->audit_type
                ]);
            } else {
                return response()->json(['message' => 'Audit Type not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.audit-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'audit_type' => 'required|max:100'
            ]);
            $updateArray = [
                'audit_type' => $request->audit_type
            ];
            RefAuditType::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Audit Type Updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.audit-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $auditType = RefAuditType::find(Crypt::decrypt($id));

            if (!$auditType) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('audit-type.index')->withErrors(['msg' => 'Something went wrong, Please try again.']);
            }
            $auditType->update(['master-settings.updated_by' => Auth::user()->id]);
            $auditType->delete(); 

            Alert::success('Success', 'Audit Type deleted successfully');
            return redirect()->route('master-settings.audit-type.index')->with('success', 'Audit Type deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.audit-type.index')->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
