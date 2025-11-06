<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\RefModeOfRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class RecruitmentModeController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $getData = RefModeOfRecruitment::where('is_deleted', false)->orderBy('id')->get();
                return DataTables::of($getData)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $deleteUrl = route('recruitment-mode.destroy', Crypt::encrypt($row->id));

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
            return view("master-settings.recruitment-mode", compact("header", "sidebar"));
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:100',
            ]);
            $saveData = RefModeOfRecruitment::create($validated);
            return response()->json(['message' => 'Recruitment mode created successfully', 'applicationStatus' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $dataId = RefModeOfRecruitment::where('id', Crypt::decrypt($id))->first();
            if ($dataId) {
                return response()->json([
                    'name' => $dataId->name
                ]);
            } else {
                return response()->json(['message' => 'Recruitment mode not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:100'
            ]);
            $updateArray = [
                'name' => $request->name
            ];
            RefModeOfRecruitment::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Recruitment mode updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $verifyId = RefModeOfRecruitment::find(Crypt::decrypt($id));
            if (!$verifyId) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            RefModeOfRecruitment::where('id', Crypt::decrypt($id))->update(['is_deleted' => true, 'updated_by' => Auth::user()->id]);
            Alert::success('Success', 'Recruitment mode deleted successfully');
            return redirect()->route('recruitment-mode.index')->with('success', 'Recruitment mode deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('recruitment-mode.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
