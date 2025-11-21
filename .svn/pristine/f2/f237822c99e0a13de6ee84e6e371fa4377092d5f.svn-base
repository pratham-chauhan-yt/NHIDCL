<?php

namespace App\Http\Controllers\BankManagement;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uploader\BgRenewRequest;
use App\Http\Requests\Uploader\BgRequest;
use App\Models\NhidclBankGuarantee;
use App\Models\NhidclReceiveing;
use App\Models\NhidclReceiving;
use App\Models\NhidclRenewBg;
use App\Models\NhidclProject;
use App\Models\RefProjectType;
use Illuminate\Support\Facades\Log;

class BgController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module.permission:bgms-bg-list')->only(['index']);
        $this->middleware('module.permission:bgms-bg-create')->only(['create', 'store']);
        $this->middleware('module.permission:bgms-bg-edit')->only(['edit', 'update']);
        $this->middleware('module.permission:bgms-bg-view')->only(['show']);
        $this->middleware('module.permission:bgms-bg-delete')->only(['destroy']);
    }

    public function dashboard()
    {
        $header = true;

        $sidebar = true;

        return view("bank-management.uploader.bg.dashboard", compact("header", "sidebar"));
    }

    public function index(Request $request)
    {
        try {
            $header = true;

            $sidebar = true;

            if ($request->ajax()) {
                $buttons   = ['show', 'delete'];
                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->whereIn('status', ['P', 'R'])
                    ->where(function ($q) {
                        $q->whereNull('verified_status')
                            ->orWhereIn('verified_status', ['FR', 'V', 'R']);
                    })
                    ->orderBy('created_at', 'desc');

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name . '' . $row->id ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                        // return '<span class="badge bg-warning">' . $count . '</span>';
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A'; 
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                    ->addColumn('action', function ($row) use ($buttons) {

                        if ($row->verified_status == 'R' || $row->status == 'R') {
                            $buttons[] = 'edit';
                        }

                        return view('components.action-buttons', [
                            'id' => $row->id,
                            'creator_id' => null,
                            'buttons' => $buttons,
                            'routePrefix' => 'bgms.bg',
                            'role' => 'UploaderProject',
                            'module' => 'bgms-bg'
                        ])->render();
                    })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.index", compact("header", "sidebar"));
        } catch (Exception $e) {

            Log::info("BG list", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.bg.index")->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header = true;
        $sidebar = true;
        return view("bank-management.uploader.bg.create", compact("header", "sidebar"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BgRequest $request)
    {//dd($request->all());
        try {

            $inputs = $request->all();

            $bgId = getBgId();

            $bankguarantee = NhidclBankGuarantee::create([
                "nhidcl_bgm_project_details_id" => $inputs["nhidcl_bgm_project_details_id"],
                "bg_id" => $bgId,
                "ref_guarantee_type_id" => $inputs["ref_guarantee_type_id"],
                "agency_name" => $inputs["agency_name"],
                "agency_mob_no" => $inputs["agency_mob_no"],
                "agency_email" => $inputs["agency_email"],
                "agency_address" => $inputs["agency_address"],
                "bg_no" => $inputs["bg_no"],
                "bank_name" => $inputs["bank_name"],
                "issuing_bank_branch" => $inputs["issuing_bank_branch"],
                "issuing_bank_mob_no" => $inputs["issuing_bank_mob_no"],
                "issuing_bank_email" => $inputs["issuing_bank_email"],
                "issuing_bank_address" => $inputs["issuing_bank_address"],
                "operable_bank_mob_no" => $inputs["operable_bank_mob_no"],
                "operable_bank_email" => $inputs["operable_bank_email"],
                "operable_bank_address" => $inputs["operable_bank_address"],
                "operable_bank_branch" => $inputs["operable_bank_branch"],
                "bg_amount" => $inputs["bg_amount"],
                "status" => 'P',
                "issue_date" => $inputs["issue_date"],
                "bg_valid_upto" => $inputs["bg_valid_upto"],
                "claim_expiry_date" => $inputs["claim_expiry_date"],
                "bg_file" => $inputs["bg_file"],
                'operable_bank_name' =>  $inputs["operable_bank_name"],
                'issuing_bank_name' =>  $inputs["issuing_bank_name"],                
                "created_by" => user_id(),
                "created_at" => now()
            ]);

            $lastId = $bankguarantee->id;

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $lastId,
                "status" => 'P',
                'reason' => 'BG Created',
                'receiving_file' => $inputs["bg_file"],
                "created_by" => user_id(),
                "created_at" => now(),
            ]);

            Alert::success('Success', 'Bg created successfully');

            return redirect()->back()->with(["tab" => "BgList"]);
        } catch (Exception $e) {

            Log::info("BG create", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.bg.index")->with("error", $e->getMessage());
        }
    }

    public function type() // New Pratham
    {
        $header = true;

        $sidebar = true;

        return view("bank-management.uploader.bg.type", compact("header", "sidebar"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sidebar = true;
        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));

        return view('bank-management.uploader.bg.show', compact('bg', 'header', 'sidebar'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $sidebar = true;
            $header = true;
            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));

            return view('bank-management.uploader.bg.edit', compact('bg', 'header', 'sidebar'));
        } catch (\Exception $e) {

            Log::info("BG edit", ['E' => $e->getMessage()]);

            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('bgms.bg.index');
        }
    }
    public function renew(string $id)
    {
        try {
            $sidebar = true;
            $header = true;
            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));

            return view('bank-management.uploader.bg.renew', compact('bg', 'header', 'sidebar'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Invalid data provided.');
            Log::info("BG renew", ['E' => $e->getMessage()]);

            return redirect()->route('bgms.bg.index');
        }
    }
    public function renewStore(BgRenewRequest $request)
    {
        try {
            $inputs = $request->all();

            $renew = NhidclRenewBg::create([
                "nhidcl_bgm_bank_guarantees_id" => $inputs["nhidcl_bgm_bank_guarantees_id"],
                'issue_date' => $inputs['issue_date'],
                'valid_upto' => $inputs['valid_upto'],
                'claim_expiry_date' => $inputs['claim_expiry_date'],
                'renew_bg_file' => $inputs['bg_file'],
                'is_renew' => $inputs['is_renew'],
                'status' => 'P',
                "created_by" => user_id(),
                "created_at" => now()
            ]);

            Alert::success('Success', 'New renew created successfully');

            return redirect()->route("bgms.bg.accepted")->with(["tab" => "BgList"]);
        } catch (\Exception $e) {

            Log::info("BG renew store", ['E' => $e->getMessage()]);


            Alert::error('Error', 'Invalid data provided.');
            return redirect()->route('bgms.bg.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BgRequest $request, $id)
    {
        try {
            $inputs = $request->all();

            $bankguarantee = NhidclBankGuarantee::findOrFail(decryptId($id));



            // print_r($bankguarantee->toArray());

            // die;
            $bankguarantee->update([
                "nhidcl_bgm_project_details_id" => $inputs["nhidcl_bgm_project_details_id"],
                "ref_guarantee_type_id" => $inputs["ref_guarantee_type_id"],
                "agency_name" => $inputs["agency_name"],
                "agency_mob_no" => $inputs["agency_mob_no"],
                "agency_email" => $inputs["agency_email"],
                "agency_address" => $inputs["agency_address"],
                "bg_no" => $inputs["bg_no"],
                "bank_name" => $inputs["bank_name"],
                "issuing_bank_branch" => $inputs["issuing_bank_branch"],
                "issuing_bank_mob_no" => $inputs["issuing_bank_mob_no"],
                "issuing_bank_email" => $inputs["issuing_bank_email"],
                "issuing_bank_address" => $inputs["issuing_bank_address"],
                "operable_bank_mob_no" => $inputs["operable_bank_mob_no"],
                "operable_bank_email" => $inputs["operable_bank_email"],
                "operable_bank_address" => $inputs["operable_bank_address"],
                "operable_bank_branch" => $inputs["operable_bank_branch"],
                "bg_amount" => $inputs["bg_amount"],
                "issue_date" => $inputs["issue_date"],
                "bg_valid_upto" => $inputs["bg_valid_upto"],
                "claim_expiry_date" => $inputs["claim_expiry_date"],
                "bg_file" => $inputs["bg_file"],
                "updated_by" => user_id(),
                "updated_at" => now(),
                "status" => $bankguarantee->status == 'R' ? 'RR' : $bankguarantee->status,
                "verified_status" => $bankguarantee->verified_status == 'R' ? 'FR' : $bankguarantee->verified_status,
            ]);

            Alert::success('Success', 'BG updated successfully');

            return redirect()->route("bgms.bg.index")->with(["tab" => "BgList"]);
        } catch (\Exception $e) {

            Log::info("BG update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.bg.index")->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {

            $bg = NhidclBankGuarantee::find(decryptId($id));

            if (!$bg) {
                Alert::error('Error', 'Something went wrong, Please try again.');
                return redirect()->route('bgms.bg.index');
            }

            $bg->renewals()->delete();

            $bg->receiving()->delete();

            $bg->is_deleted = true;

            $bg->delete();

            Alert::success('Success', 'Bg deleted successfully');

            return redirect()->route('bgms.bg.index');
        } catch (\Exception $e) {

            Log::info("BG delete", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }



    // public function upload(Request $request)
    // {
    //     try {

    //         $uploadPath = 'uploads/bg/';

    //         $ext = $request->filled('ext') ? explode(',', $request->ext) : ['png'];

    //         $inputName = $request->input('bg_file', 'bg_file');

    //         if ($request->ajax()) {
    //             if ($request->hasFile($inputName)) {
    //                 return storeMedia($request, $uploadPath, $ext, $inputName);
    //             }
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Invalid Request'
    //             ]);
    //         }
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Invalid Request'
    //         ]);


    //       //  die;
    //         if ($request->hasFile('bg_file')) {
    //             $file = $request->file('bg_file');
    //             $uploadPath = public_path('uploads/bg');

    //             if (!file_exists($uploadPath)) {
    //                 mkdir($uploadPath, 0755, true);
    //             }
    //             $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    //             $file->move($uploadPath, $fileName);

    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'File uploaded successfully',
    //                 'file_name' => $fileName,
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'No file uploaded',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'OOPS, Something went wrong. Please try again later.' . $e->getMessage(),
    //         ]);
    //     }
    // }

   
   
public function upload(Request $request)
{
    try {
        $uploadPath = 'uploads/bg';
        $inputName = $request->input('bg_file', 'bg_file');

        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => 'Invalid Request']);
        }

        if (!$request->hasFile($inputName)) {
            return response()->json(['status' => false, 'message' => 'No file uploaded']);
        }

        $file = $request->file($inputName);
        $uploadFullPath = public_path($uploadPath);

        if (!file_exists($uploadFullPath)) {
            mkdir($uploadFullPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadFullPath, $fileName);

        return response()->json([
            'status' => true,
            'message' => 'File uploaded successfully',
            'file_name' => $fileName,
            'path' => $uploadPath . '/' . $fileName,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'OOPS, Something went wrong. ' . $e->getMessage(),
        ]);
    }
}


    public function view(Request $request)
    {
        // $fileName = urldecode($request->fileName);
        // $file = public_path('uploads/bg/' . $fileName);

        // $aa = viewFilePath($fileName);



        $pathName = $request->pathName;
        $fileName = $request->fileName;

        Log::info("file", ['P' => $pathName]);

        $file = viewFilePath($pathName) . urldecode($fileName);

        if (file_exists($file)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: inline; filename=" . basename($file));
            header("Content-Type: " . mime_content_type($file));
            header("Content-Length: " . filesize($file));
            header("Content-Transfer-Encoding: binary");
            readfile($file);
            exit;
        } else {
            abort(404, 'File not found');
        }
    }

    public function receive(Request $request)
    {
        try {

            $header = true;

            $sidebar = true;

            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->where('status', 'Received')->where('verified_status', 'V')->orderBy('created_at', 'desc');


                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                        // return '<span class="badge bg-warning">' . $count . '</span>';
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                    ->addColumn('action', function ($row) {
                        return view('components.action-buttons', [
                            'id' => $row->id,
                            'creator_id' => null,
                            'buttons' => ['show', 'receive'],
                            'routePrefix' => 'bgms.bg',
                            // 'role' => '',
                            'module' => 'bgms-bg'
                        ])->render();
                    })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.received", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }


    public function receiveUpdate(Request $request, $id)
    {

        try {

            $bgId = decryptId($id);

            $bg = NhidclBankGuarantee::findOrFail($bgId);

            $updateArr = [];

            $updateArr = [
                'status' => 'F',
                'update_at' => now()
            ];

            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bgId,
                "status" => 'F',
                "receiving_file" => $request->get('bg_file', null),
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'Bg updated successfully');

            return redirect()->back();
        } catch (Exception $e) {


            Log::info("BG receive update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.bg.receive")->with("error", $e->getMessage());
        }
    }
    public function track_status(Request $request, $id)
    {

        try {

            $bgId = decryptId($id);

            $bgData = NhidclReceiving::with(['createdBy', 'verifiedBy'])
                ->where("nhidcl_bgm_bank_guarantees_id", $bgId)
                ->orderBy("created_at")
                ->get()
                ->map(function ($item) {

                    $receivingLink = '';
                    if ($item->receiving_file) {
                        $pathName = '/uploads/bg/';
                        $fileName = $item->receiving_file;

                        $receivingLink = '<a target="_blank" href="'
                            . route("bgms.bg.view")
                            . '?pathName=' . urlencode($pathName)
                            . '&fileName=' . urlencode($fileName)
                            . '">View</a>';
                    }

                    return [
                        'status'      => getBgStatus($item->status),
                        'updated_by'  => $item->createdBy->name ?? '',
                        'verified_by' => $item->verifiedBy->name ?? '',
                        'reason'      => $item->reason ?? '',
                        'receiving'   => $receivingLink,
                        'date'        => $item->created_at ? format_datetime($item->created_at, 'Y-m-d h:i:s') : '',
                    ];
                });

            return response()->json($bgData);
        } catch (Exception $e) {

            Log::info("BG receive update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }

    public function financeReturned(Request $request)
    {
        try {

            $header = true;

            $sidebar = true;

            $userPermissions = getUserPermissions();

            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->where('status', 'FRT')->where('verified_status', 'V')->orderBy('created_at', 'desc');


                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                        // return '<span class="badge bg-warning">' . $count . '</span>';
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                    ->addColumn('action', function ($row) use ($userPermissions) {

                        $buttons = '';
                        // if (canAccess('receive', $userPermissions, 'bgms-bg-receive')) {
                        $buttons .= '<button type="button" class="btn btn-sm btn-primary receive-btn"
                                            data-action="' . route('bgms.bg.frt.update', encryptId($row->id)) . '" data-type="return_to_technical">
                                        Return To Finance
                                    </button> ';
                        // }

                        return $buttons;
                    })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.finance-returned", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }


    public function financeReturnedUpdate(Request $request, $id)
    {

        try {

            $bgId = decryptId($id);

            $bg = NhidclBankGuarantee::findOrFail($bgId);

            $updateArr = [
                'status' => 'Archive',
                'updated_by' => user_id(),
                'update_at' => now()
            ];

            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bgId,
                "status" => 'Archive',
                "receiving_file" => $request->get('bg_file', null),
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'Bg updated successfully');

            return redirect()->back();
        } catch (Exception $e) {


            Log::info("financeReturnedUpdate update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.bg.receive")->with("error", $e->getMessage());
        }
    }
    public function archive(Request $request)
    {


        try {

            $header = true;

            $sidebar = true;

            $userPermissions = getUserPermissions();

            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->where('status', 'Archive')->where('verified_status', 'V')->orderBy('created_at', 'desc');

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                        // return '<span class="badge bg-warning">' . $count . '</span>';
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                    ->addColumn('action', function ($row) use ($userPermissions) {

                        $buttons = '';
                        // if (canAccess('receive', $userPermissions, 'bgms-bg-receive')) {
                        // $buttons .= '<button type="button" class="btn btn-sm btn-primary receive-btn"
                        //                     data-action="' . route('bgms.bg.frt.update', encryptId($row->id)) . '" data-type="return_to_technical">
                        //                 Return To Finance
                        //             </button> ';
                        // }

                        return $buttons;
                    })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.archive", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }


    public function accepted(Request $request)
    {
        $header = true;

        $sidebar = true;

        $userPermissions = getUserPermissions();

        if ($request->ajax()) {

            $query = NhidclBankGuarantee::with([
                'project.projectState',
                'project.projectType',
                'guaranteeType'
            ])->where("status", 'A')
                ->where("created_by", user_id())
                ->where('verified_status', 'V');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('state', function ($row) {
                    return $row->project->projectState->state_name ?? 'N/A';
                })
                ->addColumn('guarantee_type', function ($row) {
                    return $row->guaranteeType?->guarantee_type ?? 'N/A';
                })
                ->addColumn('no_of_renew', function ($row) {
                    $count = $row->renewals->count();

                    return $count;
                })
                ->editColumn('bg_valid_upto', function ($row) {
                    return $row->bg_valid_upto
                        ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                        : 'N/A';
                })
                ->addColumn('ref_no', function ($row) {
                    return $row->ref_no ?? 'N/A';
                })
                ->addColumn('sap_id', function ($row) {

                    return $row->project?->sap_id ?? 'N/A';
                })
                ->addColumn('bg_no', function ($row) {
                    return $row->bg_no ?? 'N/A';
                })
                ->addColumn('track_status', function ($row) {
                    return    '<button type="button" class="btn btn-sm btn-primary track_status"
                            data-action="' . route('bgms.bg.track_status', encryptId($row->id)) . '">
                          Status
                        </button> ';
                })
                ->addColumn('track_claim_lodge', function () {
                    return "N/A";
                })
                ->addColumn('action', function ($row) use ($userPermissions) {
                    $buttons = '';

                    // if (canAccess('receive', $userPermissions, 'bgms-finance-returntotechnical')) {
                    $buttons .= '<a  class="btn btn-sm btn-primary return_to_technical"
                            href="' . route('bgms.bg.renew', encryptId($row->id)) . '" data-type="return_to_technical">
                         Renew
                        </a> ';
                    // }

                    return $buttons;
                })

                ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                ->make(true);
        }





        return view("bank-management.uploader.bg.accepted", compact("header", "sidebar"));
    }


  public function search(Request $request)
    {
        try {

            $header = true;

            $sidebar = true;

            if ($request->ajax()) {
                $buttons = ['show', 'delete'];
                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->where('status', 'A')->where('verified_status', 'V')->orderBy('created_at', 'desc');


                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                        // return '<span class="badge bg-warning">' . $count . '</span>';
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                    ->addColumn('action', function ($row) {
                        return view('components.action-buttons', [
                            'id' => $row->id,
                            'creator_id' => null,
                            'buttons' => ['show', 'receive'],
                            'routePrefix' => 'bgms.bg',
                            // 'role' => '',
                            'module' => 'bgms-bg'
                        ])->render();
                    })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            } 

            return view("bank-management.uploader.bg.search", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }


    public function encashmentList(Request $request)
    {
        try {

            $header = true;

            $sidebar = true;
            $userPermissions = getUserPermissions();
            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->wherein('status', ['SE', 'Encashed'])->where('verified_status', 'V')->orderBy('created_at', 'desc');


                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                        ->addColumn('action', function ($row) use ($userPermissions) {
                    $buttons = '';
                    if($row->status == 'SE'){
                    $buttons .= '<button type="button" class="btn btn-sm btn-danger bg-encashment"
                            data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" data-type="bg-encashment">
                           Encashment
                        </button> ';
                    }else{
                         $buttons .= '<button type="button" class="btn btn-sm btn-primary "
                            data-action="" data-type="bg-encashment">
                           Encashed
                        </button> ';
                    }
                          return $buttons;
                })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.encashed", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }

   public function claimlodgeList(Request $request)
    {
        try {

            $header = true;

            $sidebar = true;
            $userPermissions = getUserPermissions();
            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ])->where('status', 'TRUE')->where('verified_status', 'V')->orderBy('created_at', 'desc');


                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name ?? 'N/A';
                    })
                    ->addColumn('guarantee_type', function ($row) {
                        return $row->guaranteeType?->guarantee_type ?? 'N/A';
                    })
                    ->addColumn('no_of_renew', function ($row) {
                        $count = $row->renewals->count();

                        return $count;
                    })
                    ->editColumn('bg_valid_upto', function ($row) {
                        return $row->bg_valid_upto
                            ? Carbon::parse($row->bg_valid_upto)->format('d-m-Y')
                            : 'N/A';
                    })
                    ->addColumn('ref_no', function ($row) {
                        return $row->ref_no ?? 'N/A';
                    })
                    ->addColumn('sap_id', function ($row) {

                        return $row->project?->sap_id ?? 'N/A';
                    })
                    ->addColumn('bg_no', function ($row) {
                        return $row->bg_no ?? 'N/A';
                    })
                    ->addColumn('track_status', function () {
                        return "N/A";
                    })
                    ->addColumn('track_claim_lodge', function () {
                        return "N/A";
                    })
                    ->addColumn('status', function ($row) {
                        return getBgStatus($row->status);
                    })
                        ->addColumn('action', function ($row) use ($userPermissions) {
                    $buttons = '';
                    if($row->status == 'TRUE'){
                    $buttons .= '<button type="button" class="btn btn-sm btn-danger bg-encashment"
                            data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" data-type="bg-encashment">
                           Claim Lodge
                        </button> ';
                    }
                          return $buttons;
                })

                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }

            return view("bank-management.uploader.bg.claimlodge", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("BG receive", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.bg.index');
        }
    }


    public function track_lodge(Request $request, $id)
    {

        try {

            $bgId = decryptId($id);

            $bgData = NhidclReceiving::with(['createdBy', 'verifiedBy'])
                ->where("nhidcl_bgm_bank_guarantees_id", $bgId)
                ->orderBy("created_at")
                ->get()
                ->map(function ($item) {

                    $receivingLink = '';
                    if ($item->receiving_file) {
                        $pathName = '/uploads/bg/';
                        $fileName = $item->receiving_file;

                        $receivingLink = '<a target="_blank" href="'
                            . route("bgms.bg.view")
                            . '?pathName=' . urlencode($pathName)
                            . '&fileName=' . urlencode($fileName)
                            . '">View</a>';
                    }

                    return [
                        'status'      => getBgStatus($item->status),
                        'reason'      => $item->reason ?? '',
                        //'updated_by'  => $item->createdBy->name ?? '',
                        'created_by'  => $item->createdBy->name ?? '',
                       // 'verified_by' => $item->verifiedBy->name ?? '',
                        
                        //'receiving'   => $receivingLink,
                        'date'        => $item->created_at ? format_datetime($item->created_at, 'Y-m-d h:i:s') : '',
                    ];
                });

            return response()->json($bgData);
        } catch (Exception $e) {

            Log::info("BG receive update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }

    public function encashmentSearch(Request $request)
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
