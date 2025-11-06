<?php

namespace App\Http\Controllers\BankManagement;


use App\Models\NhidclRenewBg;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Controller;
use App\Models\NhidclBankGuarantee;
use App\Models\NhidclProject;
use App\Models\NhidclReceiveing;
use App\Models\NhidclReceiving;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerifierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('module.permission:bgms-verifier-list')->only(['index']);
        $this->middleware('module.permission:bgms-verifier-create')->only(['create', 'store']);
        $this->middleware('module.permission:bgms-verifier-edit')->only(['edit', 'update']);
        $this->middleware('module.permission:bgms-verifier-view')->only(['show']);
        $this->middleware('module.permission:bgms-verifier-delete')->only(['destroy']);
    }

    public function dashboard()
    {
        $header = true;

        $sidebar = true;

        return view("bank-management.verifier.dashboard", compact("header", "sidebar"));
    }

    public function index(Request $request)
    {
        try {
            $header = true;

            $sidebar = true;

            $tab = $request->get('tab', 'verification_pending');

            if ($request->ajax()) {

                $query = NhidclBankGuarantee::with([
                    'project.projectState',
                    'project.projectType',
                    'guaranteeType'
                ]);

if ($tab == 'renew') {
    $query->select([
        'nhidcl_bgm_bank_guarantees.*',
        'nhidcl_bgm_renew_bg.status as renew_status'
    ])
    ->join('nhidcl_bgm_renew_bg', 'nhidcl_bgm_renew_bg.nhidcl_bgm_bank_guarantees_id', '=', 'nhidcl_bgm_bank_guarantees.id')
    ->where('nhidcl_bgm_renew_bg.status', 'P')
    ->where('nhidcl_bgm_bank_guarantees.verified_status', 'V')
    ->orderBy('nhidcl_bgm_bank_guarantees.created_at', 'desc');
}else {
                   // $query->wherein('status', ['P','Renew Receive'])
                                        $query->wherein('status', ['P'])

                        ->where(function ($q) {
                            $q->whereNull('verified_status')
                                ->orWhere('verified_status', 'FR');
                        });
                }

                $query->orderBy('created_at', 'desc');

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('state', function ($row) {
                        return $row->project->projectState->state_name .  '  ' . $row->id ?? 'N/A';
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
                    // ->addColumn('status', function ($row) {
                    //     return getBgStatus($row->status);
                    // })
                    ->addColumn('status', function ($row) use ($tab) {
                     if ($tab == 'renew') {
                       return getBgStatus($row->renew_status);
                     }
                       return getBgStatus($row->status); 
                     })

->addColumn('action', function ($row) use ($tab) {
    $buttons = ['verify', 'referback'];

    if ($tab == 'renew') {
        $buttons = ['show'];
    }

    // Render the component buttons
    $html = view('components.action-buttons', [
        'id' => $row->id,
        'creator_id' => null,
        'buttons' => $buttons,
        'routePrefix' => 'bgms.verifier',
        'module' => 'bgms-verifier'
    ])->render();

    // Append Renew button directly
    $html .= '<a class="btn btn-sm btn-primary return_to_technical"
                  href="' . route('bgms.verifier.showbgdetail', encryptId($row->id)) . '"
                  data-type="return_to_technical">
                  View Detail
              </a>';

    return $html;
})



                    ->rawColumns(['no_of_renew', 'track_status', 'track_claim_lodge', 'action'])
                    ->make(true);
            }



            return view("bank-management.verifier.index", compact("header", "sidebar"));
        } catch (\Exception $e) {

            Log::info("verifier index", ['E' => $e->getMessage()]);

            Alert::error('Error', $e->getMessage());
            return redirect()->route('bgms.verifier.index');
        }
    }

    public function showbgdetail(string $id)
    {
        $sidebar = true;
        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));

        return view('bank-management.uploader.bg.show', compact('bg', 'header', 'sidebar'));
    }

    public function show(string $id)
    {
        $sidebar = true;
        $header = true;

        $bg = NhidclBankGuarantee::with(['guaranteeType', 'renewals', 'createdBy', 'project'])->findOrFail(decryptId($id));

        return view('bank-management.verifier.show', compact('bg', 'header', 'sidebar'));
    }

    public function renewUpdate(Request $request)
    {
        DB::beginTransaction();

        try {

            $inputs = $request->all();

            $renew = NhidclRenewBg::findOrFail($inputs['id']);

            $action = $request->get('action', 0);

            $status = 'R';

            $receiveingArr =  [
                "nhidcl_bgm_bank_guarantees_id" => $renew->nhidcl_bgm_bank_guarantees_id,
                //"status" => 'Renew Refer',
                 "status" => 'Renew Request',
                "created_by" => user_id(),
                "created_at" => now(),
            ];

            if ($action === 'Accepted') {

                $status = 'V';

                $receiveingArr =  [
                    "nhidcl_bgm_bank_guarantees_id" => $renew->nhidcl_bgm_bank_guarantees_id,
                   // "status" => 'Renew Request',
                    "status" => 'Renew Request',
                    "created_by" => user_id(),
                    "created_at" => now(),
                    "verified_by" => $renew->verified_by,
                ];
            }

            $renew->status = $status;

            $renew->verified_by = user_id();

            $renew->verified_at = now();

            $renew->remarks = $request->get('remarks', '');

            $renew->save();

            NhidclReceiving::create($receiveingArr);

            Alert::success('Success', 'Renewal ' . $action . '
             successfully.');

            DB::commit();

            return back()->with('success', 'Renewal status updated.');
        } catch (Exception $e) {

            DB::rollBack();

            Log::info("Verifer renew update", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.verifier.index")->with("error", $e->getMessage());
        }
    }

    public function verify(Request $request, string $id)
    {
        try {

            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));//dd($bg);

            $bg->verified_status = 'V';

            $bg->verified_by = user_id();

            $bg->verified_at = now();

            $bg->remarks = $request->get('remarks', null);

            $bg->save();

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => 'Request',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $bg->verified_by,
            ]);

            Alert::success('Success', 'BG verified successfully.');

            return back()->with('success', 'BG status updated.');
        } catch (Exception $e) {


            Log::info("Verifer verify", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.verifier.index")->with("error", $e->getMessage());
        }
    }
    public function verifyRenew(Request $request, string $id)
    {//dd("4");Renew Receive
        DB::beginTransaction();
        try {

            $renew = NhidclRenewBg::findOrFail(decryptId($id));//dd($renew);

            //$renew->status = 'V';
            $renew->status = 'Renew Request';
            $renew->verified_by = user_id();

            $renew->verified_at = now();

            $renew->remarks = $request->get('remarks', '');

            $renew->save();

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $renew->nhidcl_bgm_bank_guarantees_id,
                "status" => 'Renew Request',
                //"status" => 'V',
                "created_by" => user_id(),
                "created_at" => now(),
                "verified_by" => $renew->verified_by,
            ]);

            DB::commit();
            Alert::success('Success', 'Renewal verified successfully.');

            return back()->with('success', 'BG status updated.');
        } catch (Exception $e) {


            DB::rollBack();

            echo $e->getMessage();


           

            Log::info("Renew verify", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.verifier.index")->with("error", $e->getMessage());
        }
    }
    public function referback(Request $request, string $id)
    {

        try {

            $bg = NhidclBankGuarantee::findOrFail(decryptId($id));

            $bg->verified_status = 'R';

            $bg->verified_by = user_id();

            $bg->verified_at = now();

            $bg->remarks = $request->get('remarks', null);

            $bg->save();

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $bg->id,
                "status" => 'R',
                "created_by" => user_id(),
                "created_at" => now(),
                // "verified_by" => ,
            ]);



            Alert::success('Success', 'BG Refer backed successfully.');

            return back()->with('success', 'BG status updated.');
        } catch (Exception $e) {
            // Alert::success('error', $e->getMessage());
            Log::info("Verifer referback", ['E' => $e->getMessage()]);


            return redirect()->route("bgms.verifier.index")->with("error", $e->getMessage());
        }
    }
    public function referbackRenew(Request $request, string $id)
    {//dd("5");
        DB::beginTransaction();
        try {

            $renew = NhidclRenewBg::findOrFail(decryptId($id));

            $renew->status = 'R';

            $renew->verified_by = user_id();

            $renew->verified_at = now();

            $renew->remarks = $request->get('remarks', null);

            $renew->save();

            NhidclReceiving::create([
                "nhidcl_bgm_bank_guarantees_id" => $renew->nhidcl_bgm_project_details_id,
                "status" => 'Renew Refer',
                "created_by" => user_id(),
                "created_at" => now(),
            ]);

            DB::commit();
            Alert::success('Success', 'Renew Refer back successfully.');

            return back()->with('success', 'Renew status updated.');
        } catch (Exception $e) {
            DB::rollBack();


            echo $e->getMessage();

            Log::info("Verifer referback", ['E' => $e->getMessage()]);

            return redirect()->route("bgms.verifier.index")->with("error", $e->getMessage());
        }
    }
}
