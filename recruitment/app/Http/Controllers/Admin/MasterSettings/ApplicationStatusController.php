<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\NhidclApplicationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ApplicationStatusController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $getData = NhidclApplicationStatus::where('is_deleted', false)->orderBy('id')->get();
                return DataTables::of($getData)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $deleteUrl = route('application-status.destroy', Crypt::encrypt($row->id));

                        return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                        <a href="javascript:void(0)" class="btn  btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                    })

                    ->editColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->editColumn('created_at', function ($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            $header = true;
            $sidebar = true;
            return view("master-settings.application-status", compact("header", "sidebar"));
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|max:100',
                'type' => 'required',
            ]);
            $saveData = NhidclApplicationStatus::create($validated);
            return response()->json(['message' => 'Application status created successfully', 'applicationStatus' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $dataId = NhidclApplicationStatus::where('id', Crypt::decrypt($id))->first();
            if ($dataId) {
                return response()->json([
                    'status' => $dataId->status
                ]);
            } else {
                return response()->json(['message' => 'Application Status not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|max:100'
            ]);
            $updateArray = [
                'status' => $request->status
            ];
            NhidclApplicationStatus::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Application status updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $verifyId = NhidclApplicationStatus::find(Crypt::decrypt($id));
            if (!$verifyId) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            NhidclApplicationStatus::where('id', Crypt::decrypt($id))->update(['is_deleted' => true, 'updated_by' => Auth::user()->id]);
            Alert::success('Success', 'Application status deleted successfully');
            return redirect()->route('application-status.index')->with('success', 'Application status deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('application-status.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
