<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use App\Models\RefGateDiscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class GateDesciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $getData = RefGateDiscipline::where('is_deleted', false)->orderBy('discipline_name', 'asc')->get();
            return DataTables::of($getData)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('master-settings.gate-descipline.destroy', Crypt::encrypt($row->id));

                    return '<button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                    <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display: none;">' . csrf_field() . method_field('DELETE') . '</form>';
                })
                ->editColumn('name', function ($row) {
                    return $row->discipline_name;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = true;
        $sidebar = true;
        return view("master-settings.gate_descipline", compact("header", "sidebar"));
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
                'discipline_name' => 'required|max:100',
            ]);
            $saveData = RefGateDiscipline::create($validated);
            return response()->json(['message' => 'Data saved successfully', 'discipline_name' => $saveData]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.gate-descipline.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
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
            $verifyId = RefGateDiscipline::where('id', Crypt::decrypt($id))->first();
            if ($verifyId) {
                return response()->json([
                    'discipline_name' => $verifyId->discipline_name
                ]);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.gate-descipline.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'discipline_name' => 'required|max:100'
            ]);
            $updateArray = [
                'discipline_name' => $request->discipline_name
            ];
            RefGateDiscipline::where('id', Crypt::decrypt($id))->update($updateArray);
            return response()->json(['message' => 'Data Updated successfully']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('master-settings.gate-descipline.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $verifyId = RefGateDiscipline::find(Crypt::decrypt($id));
            if (!$verifyId) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('master-settings.gate-descipline.index')->withInput()->withErrors(['msg' => ['Something went wrong, Please try again.']]);
            }
            RefGateDiscipline::where('id', Crypt::decrypt($id))->update(['is_deleted' => true, 'updated_by' => Auth::user()->id]);
            Alert::success('Success', 'Data deleted successfully');
            return redirect()->route('master-settings.gate-descipline.index')->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later');
            return redirect()->route('master-settings.gate-descipline.index')->withInput()->withErrors(['msg' => $e->getMessage()]);
        }
    }
}
