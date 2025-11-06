<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\RefDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $getData = RefDomain::orderBy('domain_name', 'desc')->get();

            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('master-settings.domain.destroy', Crypt::encrypt($row->id));

                    return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                    <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                })

                ->editColumn('domain_name', function ($row) {
                    return $row->domain_name;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = true;
        $sidebar = true;
        return view("master-settings.domain", compact("header", "sidebar"));
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
                'domain_name' => 'required|max:50',
            ]);
            $saveData = RefDomain::create($validated);
            return response()->json(['message' => 'Data stored successfully', 'domain_name' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.domain.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $verifyId = RefDomain::where('id', Crypt::decrypt($id))->first();
            if ($verifyId) {
                return response()->json([
                    'domain_name' => $verifyId->domain_name
                ]);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.domain.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'domain_name' => 'required|max:100'
            ]);
            $updateArray = [
                'domain_name' => $request->domain_name
            ];
            RefDomain::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Data Updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.domain.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $auditType = RefDomain::find(Crypt::decrypt($id));

            if (!$auditType) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('master-settings.domain.index')->withErrors(['msg' => 'Something went wrong, Please try again.']);
            }
            $auditType->update(['updated_by' => Auth::user()->id]);
            $auditType->delete();

            Alert::success('Success', 'Record deleted successfully');
            return redirect()->route('master-settings.domain.index')->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.domain.index')->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
