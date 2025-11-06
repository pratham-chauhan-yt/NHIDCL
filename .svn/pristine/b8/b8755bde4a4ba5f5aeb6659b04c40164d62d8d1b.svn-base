<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\RefJobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $getData = RefJobType::where('is_deleted', false)->orderBy('job_type', 'asc')->get();
            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('master-settings.job-type.destroy', Crypt::encrypt($row->id));

                    return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                    <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                })
                ->editColumn('name', function ($row) {
                    return $row->job_type;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = true;
        $sidebar = true;
        return view("master-settings.job_type", compact("header", "sidebar"));
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
                'job_type' => 'required|max:100',
            ]);
            $saveData = RefJobType::create($validated);
            return response()->json(['message' => 'Data saved successfully', 'job_type' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.job-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
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
            $verifyId = RefJobType::where('id', Crypt::decrypt($id))->first();
            if ($verifyId) {
                return response()->json([
                    'job_type' => $verifyId->job_type
                ]);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.job-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'job_type' => 'required|max:100'
            ]);
            $updateArray = [
                'job_type' => $request->job_type
            ];
            RefJobType::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Data Updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.job-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $verifyId = RefJobType::find(Crypt::decrypt($id));
            if (!$verifyId) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('master-settings.job-type.index')->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            RefJobType::where('id', Crypt::decrypt($id))->update(['is_deleted' => true, 'updated_by' => Auth::user()->id]);
            Alert::success('Success', 'Data deleted successfully');
            return redirect()->route('master-settings.job-type.index')->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('master-settings.job-type.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
