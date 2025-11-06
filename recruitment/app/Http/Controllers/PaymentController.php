<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\PaymentHistory;
// use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Payments\PaymentGateway;
use App\Services\Sms\SmsGateway;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Str;

class PaymentController extends Controller
{
    protected $payment;

    public function __construct(PaymentGateway $payment)
    {
        $this->payment = $payment;
    }

    public function index(Request $request)
    {

        $header = true;
        $sidebar = true;

        $user = auth()->user();


        $query = Order::with("createdBy");

        // print_r($query->toArray());


        // die;

        if ($request->ajax()) {



            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('response_code', function ($row) {
                    return $row->response_code ?? 'N/A';
                })
                ->editColumn('transaction_id', function ($row) {
                    return $row->transaction_id ?? 'N/A';
                })
                ->editColumn('payment_mode', function ($row) {
                    return $row->payment_mode ?? 'N/A';
                })
                ->editColumn('ref_no', function ($row) {
                    return $row->ref_no ?? 'N/A';
                })
                ->editColumn('total_amount', function ($row) {
                    return number_format($row->total_amount, 2);
                })
                ->editColumn('transaction_amount', function ($row) {
                    return number_format($row->transaction_amount, 2);
                })
                ->editColumn('transaction_date', function ($row) {
                    return $row->transaction_date ? Carbon::parse($row->transaction_date)->format('d-m-Y H:i:s') : null;
                })
                ->addColumn('action', function ($row) {

                    return 'N/A';
                    // return view('components.action-buttons', [
                    //     'id' => $row->id,
                    //     'creator_id' => $row->created_by ?? null,
                    //     'buttons' => ['view'], // or ['edit', 'delete'] if needed
                    //     'routePrefix' => 'transactions',
                    //     'role' => 'Transaction',
                    //     "module" => "transaction"
                    // ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $header = TRUE;
        $sidebar = TRUE;
        return view("payment.index", compact("header", "sidebar"));
    }

    public function pay(PaymentRequest $request)
    {   
        try {
            $inputs = $request->all();
            $orderId = generateOrderId($inputs);
            $amount = Crypt::decrypt($inputs['totalpay']) ?? 10;
            $paymentUrl = $this->payment->pay($orderId, $amount, $inputs['mobile'], $inputs);

            Order::updateOrCreate(
                [ // condition
                    'entity_id'      => $inputs['id'],
                    'transaction_id' => null
                ],
                [ // values to insert or update
                    'response_code' => null,
                    'ref_no'        => $orderId,
                    'created_by'    => user_id(),
                    'created_at'    => now()
                ]
            );
            return redirect($paymentUrl);
        } catch (Exception $ex) {
            return back()->withErrors(['error' => $ex->getMessage()]);
            throw new Exception($ex->getMessage(), 500);
        }
    }

    public function paymentCallback(Request $request)
    {
        try {
            $data = $request->all();
            Log::info('ICICI Payment Response:', $data);

            $order = Order::updateOrCreate(
                ['ref_no' => $data['ReferenceNo']], // condition to check
                [
                    'response_code' => $data['Response_Code'] ?? null,
                    'transaction_id' => $data['Unique_Ref_Number'] ?? null,
                    'payment_mode' => $data['Payment_Mode'] ?? null,
                    'total_amount' => $data['Total_Amount'] ?? null,
                    'transaction_amount' => $data['Transaction_Amount'] ?? null,
                    'transaction_date' => isset($data['Transaction_Date'])
                        ? \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $data['Transaction_Date'])
                        : now(),
                    'updated_at' => now()
                ]
            );

            // Log::info('Order fetched in payment_response', [
            //     'order_id' => $order->id ?? null,
            //     'entity_id' => $order->entity_id ?? null,
            //     'created_by' => $order->created_by ?? null,
            // ]);

            PaymentHistory::create([
                "nhidcl_orders_payment_details_id" => $order->id,
                'response_code' => $data['Response_Code'] ?? null,
                'ref_no' => $data['ReferenceNo'] ?? null,
                'response_body' => json_encode($data),
            ]);
            //Auth::guard('web')->loginUsingId($order->created_by);
            // $data['Response_Code']  = 'E000'

            $redirectUrl = route('recruitment-portal.candidate.advertisement.post', encryptId($order->entity_id));
            if($data['Response_Code']  == 'E000'){
                Alert::success('Payment successful!', 'Your transaction has been completed. Transaction ID: '. $data['ReferenceNo']);
                return redirect()->intended($redirectUrl)->with('success', 'Your transaction has been completed. Transaction ID: '. $data['ReferenceNo']);
            }else{
                Alert::success('Payment Failed!', 'Opps! Something went wrong, try again');
                return redirect()->intended($redirectUrl)->with('error', 'Opps! Something went wrong, try again');
            }
        } catch (Exception $e) {
            Log::error('ICICI response error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payment response'], 400);
        }
    }
}