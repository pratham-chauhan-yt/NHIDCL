<?php

namespace App\Http\Controllers\BankManagement;


use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Controller;
use App\Models\NhidclBankGuarantee;
use App\Models\NhidclReceiving;
use App\Models\NhidclRenewBg;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class FinanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module.permission:bgms-finance-accept')->only(['accept']);
        $this->middleware('module.permission:bgms-finance-view')->only(['show']);
        $this->middleware('module.permission:bgms-finance-referback')->only(['referback']);
    }

    public function dashboard()
    {
        $header = true;

        $sidebar = true;

        return view("bank-management.verifier.dashboard", compact("header", "sidebar"));
    }

    public function receiveRefer(Request $request)
    {
        $header = true;
        $sidebar = true;
        if ($request->ajax()) {
            $tab = $request->get('tab', 'receive_or_refer_back_bg');
            $query = NhidclBankGuarantee::with([
                'project.projectState',
                'project.projectType',
                'guaranteeType'
            ]);
            if ($tab == 'renew') {
                    // $query->where("status", 'A')
                    //     ->where('verified_status', 'V');

                // $query->with(['renewals' => function ($q) {
                //     $q->where('status', 'Renew Request');
                //     $q->orderBy('id', 'desc');
            //   }]);

            $query->select([
            'nhidcl_bgm_bank_guarantees.*',
            'nhidcl_bgm_renew_bg.status as renew_status'
            ])
            ->join('nhidcl_bgm_renew_bg', 'nhidcl_bgm_renew_bg.nhidcl_bgm_bank_guarantees_id', '=', 'nhidcl_bgm_bank_guarantees.id')
            ->where('nhidcl_bgm_renew_bg.status', 'Renew Request')
            ->where('nhidcl_bgm_bank_guarantees.verified_status', 'V')
            ->orderBy('nhidcl_bgm_bank_guarantees.created_at', 'desc');
            } else {

                $query->whereIn("status", ['P', 'RR'])
                    ->where('verified_status', 'V');
            }

            $query->orderBy('created_at', 'desc');

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

                    return '<span class="badge bg-warning">' . $count . '</span>';
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
->addColumn('action', function ($row) use ($tab) {
    $buttons = ['receive', 'referback'];

    if ($tab == 'renew') {
        $buttons = ['renewsubmit'];
    }

    $html = view('components.action-buttons', [
        'id' => $row->id,
        'creator_id' => null,
        'buttons' => $buttons,
        'routePrefix' => 'bgms.finance',
        'module' => 'bgms-finance'
    ])->render();

    $html .= '<a class="btn btn-sm btn-primary"
                  href="' . route('bgms.verifier.showbgdetail', encryptId($row->id)) . '">
                  Detail
              </a>';

    return $html;
})


                ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                ->make(true);
        }


        return view("bank-management.finance.receive", compact("header", "sidebar"));
    }

    public function receiveUpdate(Request $request, $id)
    {

        try {

            $bgId = decryptId($id);
            $bg = NhidclBankGuarantee::findOrFail($bgId);

            $inputs = $request->all();

            $updateArr = [];

            $updateArr = [
                'status' => 'Received',
                'physical_location' => $inputs['remarks']
            ];

            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bgId,
                "status" => 'Received',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'Bg Received successfully');

            return redirect()->back();
        } catch (Exception $e) {
            Log::info(" Finance receive udpate", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }
    public function referback(Request $request, $id)
    {

        try {

            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));

            $inputs = $request->all();

            $updateArr = [];

            $updateArr = [
                'status' => 'R',
                'remarks' => $inputs['remarks']
            ];

            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => 'R',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'Refer back successfully');

            return redirect()->back();
        } catch (Exception $e) {
            Log::info(" Finance referback", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }
    public function accept(Request $request)
    {
        $header = true;

        $sidebar = true;

        if ($request->ajax()) {

            // $tab = $request->get('tab', 'accept_or_refer_back_bg');

            // $query = NhidclBankGuarantee::with([
            //     'project.projectState',
            //     'project.projectType',
            //     'guaranteeType'
            // ])
            //     ->where("status", 'F')
            //     ->where('verified_status', 'V')
            //     ->orderBy('created_at', 'desc');

    $tab = $request->get('tab', 'accept_or_refer_back_bg');

    $query = NhidclBankGuarantee::with([
        'project.projectState',
        'project.projectType',
        'guaranteeType'
    ]);

    if ($tab === 'renew') {
        $query->select([
            'nhidcl_bgm_bank_guarantees.*',
            'nhidcl_bgm_renew_bg.status as renew_status'
        ])
        ->join('nhidcl_bgm_renew_bg', 'nhidcl_bgm_renew_bg.nhidcl_bgm_bank_guarantees_id', '=', 'nhidcl_bgm_bank_guarantees.id')
        ->where('nhidcl_bgm_renew_bg.status', 'Renew Receive')
        ->where('nhidcl_bgm_bank_guarantees.verified_status', 'V')
        ->orderBy('nhidcl_bgm_bank_guarantees.created_at', 'desc');
    } else {
        $query->where("status", 'F')
              ->where('verified_status', 'V')
              ->orderBy('created_at', 'desc');
    }

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


                    return  'N/A';
                })
                ->addColumn('track_claim_lodge', function () {
                    return "N/A";
                })
    ->addColumn('action', function ($row) use ($tab) {
      if ($tab == 'renew') {
        return 
    '<a href="' . route('bgms.finance.acceptRenew', encryptId($row->id)) . '" 
         class="btn btn-sm btn-primary me-1">
         View
     </a>' .
    '<a href="' . route('bgms.finance.acceptshow', encryptId($row->id)) . '" 
         class="btn btn-sm btn-warning">
         Edit
     </a>';
      }

    return view('components.action-buttons', [
        'id' => $row->id,
        'creator_id' => null,
        'buttons' => ['show'],
        'routePrefix' => 'bgms.finance',
        'module' => 'bgms-verifier'
    ])->render();
   })

                ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                ->make(true);
        }



        return view("bank-management.finance.accept", compact("header", "sidebar"));
    }
    public function show(Request $request, $id)
    {
        $sidebar = true;

        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));
        return view('bank-management.finance.showupdated', compact('bg', 'header', 'sidebar'));
    }
    public function acceptReferStore(Request $request)
    {//dd($request->all());
        try {

            $bg = NhidclBankGuarantee::findOrFail($request->nhidcl_bgm_bank_guarantees_id);

            $inputs = $request->all();

            $updateArr = [];

            if ($inputs['accept_or_refer'] == 'Accept') {
                $status = 'A';
                $updateArr =  [
                    'mode_of_confirmation_master_id' =>  $inputs['mode_of_confirmation_master_id'],
                    'physical_location' =>  $inputs['physical_location'],
                    'mode_of_confirmation_file' =>  $inputs['bg_file'],
                    'confirmation_uploaded_date' =>  now(),
                    'confirmation_uploaded_by' =>  user_id(),
                    'status' =>  'A',
                ];
            } else {
                $status = 'R';
                $updateArr = ['refer_back_remark' => $inputs['refer_back_remark']];
            }



            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => $status,
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);


            Alert::success('Success', 'Bg ' . $inputs['accept_or_refer'] . ' successfully');

            return redirect()->redirect("bgms.finanace.accept");
        } catch (Exception $e) {
            Log::info(" Finance accept", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.accept")->with("error", $e->getMessage());
        }
    }
    public function acceptReferStorebg(Request $request)
    {//dd($request->all());
        try {

            $bg = NhidclBankGuarantee::findOrFail($request->nhidcl_bgm_bank_guarantees_id);

            $inputs = $request->all();

            $updateArr = [];

            if ($inputs['accept_or_refer'] == 'Accept') {
                $status = 'A';
                $updateArr =  [
                    'mode_of_confirmation_master_id' =>  $inputs['mode_of_confirmation_master_id'],
                    'physical_location' =>  $inputs['physical_location'],
                    'mode_of_confirmation_file' =>  $inputs['bg_file'],
                    'confirmation_uploaded_date' =>  now(),
                    'confirmation_uploaded_by' =>  user_id(),
                    'status' =>  'A',
                ];
            } else {
                $status = 'R';
                $updateArr = ['refer_back_remark' => $inputs['refer_back_remark']];
            }



            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => $status,
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);


            Alert::success('Success', 'Bg ' . $inputs['accept_or_refer'] . ' successfully');

            return redirect()->redirect("bgms.finanace.accept");
        } catch (Exception $e) {
            Log::info(" Finance accept", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.accept")->with("error", $e->getMessage());
        }
    }

    public function accepted(Request $request)
    {
        $header = true;

        $sidebar = true;

        $userPermissions = getUserPermissions();

        if ($request->ajax()) {

            $tab = $request->get('tab', 'accepted_bg');

            $query = NhidclBankGuarantee::with([
                'project.projectState',
                'project.projectType',
                'guaranteeType'
            ]);
        if ($tab === 'renew') {
        $query->select([
            'nhidcl_bgm_bank_guarantees.*',
            'nhidcl_bgm_renew_bg.status as renew_status'
        ])
        ->join('nhidcl_bgm_renew_bg', 'nhidcl_bgm_renew_bg.nhidcl_bgm_bank_guarantees_id', '=', 'nhidcl_bgm_bank_guarantees.id')
        ->where('nhidcl_bgm_renew_bg.status', 'Renew Accept')
        ->where('nhidcl_bgm_bank_guarantees.verified_status', 'V')
        ->orderBy('nhidcl_bgm_bank_guarantees.created_at', 'desc');
       } else{
            // $query->where("status", 'A')
            //     ->where('verified_status', 'V');
             $query->where('status', 'A')
            ->where('verified_status', 'V')
            ->whereNotExists(function ($sub) {
                $sub->select(DB::raw(1))
                    ->from('nhidcl_bgm_renew_bg')
                    ->whereRaw('nhidcl_bgm_renew_bg.nhidcl_bgm_bank_guarantees_id = nhidcl_bgm_bank_guarantees.id');
            })
            ->orderBy('nhidcl_bgm_bank_guarantees.created_at', 'desc');
      }
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
              ->addColumn('track_claim_lodge', function ($row) {
    return '<button type="button" class="btn btn-sm btn-primary track_claim_lodge"
        data-action="' . route('bgms.bg.track_lodge', encryptId($row->id)) . '">
        Claim Lodge
    </button>';
})

               ->addColumn('action', function ($row) use ($userPermissions) {
    $buttons = '';

    // Return to Technical
    $buttons .= '<button type="button" class="btn btn-sm btn-primary return_to_technical"
        data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" 
        data-type="return_to_technical">
        Return to Technical
    </button> ';

    // Return to Contractor
    $buttons .= '<button type="button" class="btn btn-sm btn-primary return_to_contractor"
        data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" 
        data-type="return_to_contractor">
        Return to Contractor
    </button> ';

    // Send for Encashment
    $buttons .= '<button type="button" class="btn btn-sm btn-primary return_to_encashment"
        data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" 
        data-type="return_to_encashment">
        Send for Encashment
    </button> ';

    // Claim Lodge
    $buttons .= '<button type="button" class="btn btn-sm btn-primary return_to_claim_lodge"
        data-action="' . route('bgms.finance.accepted.update', encryptId($row->id)) . '" 
        data-type="return_to_claim_lodge">
        Claim Lodge
    </button> ';

    // View button
    $buttons .= '<a class="btn btn-sm btn-primary "
        href="' . route('bgms.verifier.showbgdetail', encryptId($row->id)) . '"
        data-type="">
        View
    </a>';

    return $buttons;
})


                ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                ->make(true);
        }



        return view("bank-management.finance.accepted", compact("header", "sidebar"));
    }

    public function acceptedUpdate(Request $request, $id)
    { //dd( $request->all());

        try {

            $inputs = $request->all();
            $bgId  =  decryptId($id); //dd($bgId);

            $bg = NhidclBankGuarantee::findOrFail($bgId);

            $updateArr = [];

            // if ($inputs['return_to_technical'] === "true") {
            //     $status = 'FRT';
            //     $updateArr =  [
            //         'remark' =>  $inputs['remarks'],
            //         'status' =>  $status,
            //     ];
            // } else {
            //     $status = 'Archive';
            //     $updateArr = [
            //         'bg_file' => $inputs['bg_file'],
            //         'status' => $status
            //     ];
            // }
            //dd(vars: $request->action_type);
            if ($request->action_type === "technical") {
                $status = 'FRT';
                $updateArr =  [
                    'remarks' => $request->input('remarks_tech'),
                    'status' =>  $status,
                ];
            } elseif ($request->action_type === "encashment") {
                $status = 'SE';
                $updateArr =  [
                    'remarks' =>  $request->input('remarks_encash'),
                    'status' =>  $status,
                ];
            } elseif ($request->action_type === "claimlodge") {
                $status = 'TRUE';
                $updateArr =  [
                    'remarks' =>  $request->input('remarks_claim'),
                    'status' =>  $status,
                ];
            } elseif ($request->action_type === "bg-encashment") {
                $status = 'Encashed';
                $updateArr =  [
                    'remarks' =>  $request->input('remarks_encashment'),
                    'status' =>  $status,
                ];
            } else {
                $status = 'Archive';
                $updateArr = [
                    'bg_file' => $inputs['bg_file'],
                    'status' => $status
                ];
            }

            $bg->update($updateArr);

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => $status,
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'Bg updated successfully');

            if ($request->action_type === "bg-encashment") {
                return view("bgms.bg.encashment", compact("header", "sidebar"));
            } else {
                return view("bank-management.finance.accepted", compact("header", "sidebar"));
            }
        } catch (Exception $e) {
            Log::info(" Finance accepted", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.accepted")->with("error", $e->getMessage());
        }
    }


    public function updateReceive(Request $request,$id)
    {//dd($request->all());
        try { 
           //$renew = NhidclRenewBg::findOrFail(decryptId($id));dd($renew);
            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));
            $renew = NhidclRenewBg::where('nhidcl_bgm_bank_guarantees_id',decryptId($id))->first();

            //$renew->status = 'V';
            $renew->status = 'Renew Receive';
            $renew->verified_by = user_id();

            $renew->verified_at = now();

           // $renew->remarks = $request->get('remarks', '');
           // $renew->remarks = $request->remarks;
            $renew->physical_location = $request->remarks;
            $renew->save();


            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => 'Renew Receive',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
                'reason' => $request->remarks,
                'physical_location' => $request->remarks,

            ]);

            Alert::success('Success', 'Bg Received successfully');

            return redirect()->back();
        } catch (Exception $e) {
            Log::info(" Finance receive udpate", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }

    public function showRenew(Request $request, $id)
    {
        $sidebar = true;

        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));

        return view('bank-management.finance.showrenew', compact('bg', 'header', 'sidebar'));
    }

    
    public function acceptRenew(Request $request, $id)
    {
        $sidebar = true;

        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));


        return view('bank-management.finance.acceptrenew', compact('bg', 'header', 'sidebar'));
    }

    public function financeAcceptRenew(Request $request,$id)
    {
        try { 
           //$renew = NhidclRenewBg::findOrFail(decryptId($id));dd($renew);
            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));
            $renew = NhidclRenewBg::where('nhidcl_bgm_bank_guarantees_id',decryptId($id))->first();

            //$renew->status = 'V';
            $renew->status = 'Renew Accept';
            $renew->verified_by = user_id();

            $renew->verified_at = now();

           // $renew->remarks = $request->get('remarks', '');
            $renew->remarks = $request->remarks;
            $renew->save();


            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => 'Renew Accept',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
                'reason' => $request->remarks,

            ]);

            Alert::success('Success', 'Renew Bg Accept successfully');

            return redirect()->back();
        } catch (Exception $e) {
            Log::info(" Finance receive udpate", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.finance.receive.refer")->with("error", $e->getMessage());
        }
    }


    public function acceptshow(Request $request, $id)
    {
        $sidebar = true;
        $header = true;
        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));
        return view('bank-management.finance.acceptrenewsubmit', compact('bg', 'header', 'sidebar'));
    }

    public function acceptReferStoreRenew(Request $request)
    {
        try {
            $bg = NhidclRenewBg::where('nhidcl_bgm_bank_guarantees_id', $request->nhidcl_bgm_bank_guarantees_id)->firstOrFail();
            $inputs = $request->all();
            $updateArr = [];
            if ($inputs['accept_or_refer'] == 'Accept') {
                $status = 'Renew Accept';
                $updateArr =  [
                    'mode_of_confirmation_master_id' =>  $inputs['mode_of_confirmation_master_id'],
                    'physical_location' =>  $inputs['physical_location'],
                    'mode_of_confirmation_file' =>  $inputs['bg_file'],
                    'confirmation_uploaded_date' =>  now(),
                    'confirmation_uploaded_by' =>  user_id(),
                    'status' =>  'Renew Accept',
                ];
            } else {
                $status = 'Renew Refer';
                $updateArr = ['refer_back_remark' => $inputs['refer_back_remark']];
            }
            $bg->update($updateArr);
            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => $status,
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);
            Alert::success('Success', 'Bg ' . $inputs['accept_or_refer'] . ' successfully');
            return redirect()->redirect("bgms.finanace.accept-refer");
        } catch (Exception $e) {
            Log::info(" Finance accept", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.finance.accept")->with("error", $e->getMessage());
        }
    }

}
