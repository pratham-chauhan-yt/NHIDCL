<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\GrievanceRequest;
use App\Http\Requests\SmsTemplateRequest;
use App\Models\Grievance;
use App\Models\SmsTemplate;

class SmsTemplateController extends Controller
{


    public function index(Request $request)
    {

        $header = true;
        $sidebar = true;

        if ($request->ajax()) {

            $user = auth()->user();



            $query = SmsTemplate::get();

            return DataTables::of($query)

                ->editColumn('created_at', function ($row) {

                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->addColumn('action', function ($row) {
                    return  '<a href="' . route('template.edit', encryptId($row->id)) . '" class="btn btn-default btn-sm">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        return view("sms-template.index", compact("header", "sidebar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header = true;
        $sidebar = true;

        return view("sms-template.create", compact("header", "sidebar"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SmsTemplateRequest $request)
    {
        try {

            $inputs = $request->all();

            SmsTemplate::create([
                'template_name' => $inputs['template_name'],
                'template_id'   => $inputs['template_id'],
                'event_id'      => $inputs['event_id'],
                'message'       => $inputs['message'],
                'status'        => $inputs['status'],
            ]);

            Alert::success('Success', 'Template created successfully');

            return redirect()->route("template.index");
        } catch (Exception $e) {

          echo  $e->getMessage();

            die;
            return redirect()->route("template.index")->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $sidebar = True;
            $header = True;
            $grievance = Grievance::findOrFail(decryptId($id));
            return view('grievance.edit', compact('grievance', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('grievance.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GrievanceRequest $request, $id)
    {
        try {

            $grievance = Grievance::findOrFail(decryptId($id));

            $data = $request->validated();
            $data['updated_by'] = user_id();
            $data['updated_at'] = now();

            $grievance->update($data);

            Alert::success('Success', 'Grievance updated successfully');

            return redirect()->route('grievance.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Oops, something went wrong. Please try again later.');
            return redirect()->route('grievance.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {

            $grievance = Grievance::find(decryptId($id));

            if (!$grievance) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('grievance.index');
            }

            $grievance->is_deleted = true;

            $grievance->delete();

            Alert::success('Success', 'Grievance deleted successfully');

            return redirect()->route('grievance.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('grievance.index');
        }
    }
}
