<?php

namespace Common\Wallet\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Common\Wallet\Entities\Wallet;
use Common\Wallet\Entities\WalletTransactions;
use Common\Wallet\Entities\AdminWallet;
use Common\Wallet\Entities\AdminWalletTransactions;
use DataTables;
use Throwable;
use Auth;
Use DB;
class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // $provider = new PayPalClient;
        // $config=paypalConfig();
        // $provider->setApiCredentials($config);
        // $provider->getAccessToken();


        // $response = $provider->createOrder([
        //     "intent" => "CAPTURE",
        //     "application_context" => [
        //         "return_url" => url('successTransaction'),
        //         "cancel_url" => url('cancelTransaction'),
        //     ],
        //     "purchase_units" => [
        //         0 => [
        //             "amount" => [
        //                 "currency_code" => "USD",
        //                 "value" => "10.00"
        //             ]
        //         ]
        //     ]
        // ]);

        // if (isset($response['id']) && $response['id'] != null) {
        //     // redirect to approve href
        //     foreach ($response['links'] as $links) {
        //         if ($links['rel'] == 'approve') {
        //             return redirect()->away($links['href']);
        //         }
        //     }
        //     return 'error';
        // } else {
        //     return $response['message'];
        // }

        // $conf=paypalConfig();

        // $text = '<?php return ' . var_export($conf, true) . ';';
        // file_put_contents(config_path('paypal.php'), $text);


        return view('wallet::index');
    }




    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function deposits()
    {

        $req=request();
        if ($req->ajax()) {

            $strt   = $req->start;
            $length = $req->length;

            $transactions=AdminWalletTransactions::where('transaction_type', 0);

            if ($req->name != null) {
                $transactions->where('name','LIKE','%'.$req->name.'%');
              }
            if ($req->email != null) {
                $transactions->where('email', $req->email);
              }    
            if ($req->status != null) {
                $transactions->where('status', $req->status);
              }

            $total = $transactions->count();
            $transactions   = $transactions->offset($strt)->limit($length)->get();



           return DataTables::of($transactions)
                ->setOffset($strt)
                ->with([
                  "recordsTotal"    => $total,
                  "recordsFiltered" => $total,
                ])
           ->addColumn('action',function ($row){
            $action='';
                if($row->status!=0){
                    if($row->status==1){
                       $action.='<a class="btn btn-success btn-sm m-1" href="javascript:void(0)">Approved</a>';
                    }else{
                       $action.='<a class="btn btn-danger btn-sm m-1" href="javascript:void(0)">Cancled</a>';
                    }
                return $action;
                }
               
                $action.='<a class="btn btn-success btn-sm m-1 verify-prompt" href="javascript:void(0)" data-prompt-msg="Are you sure you want to approve this request ?" data-href="'.url('wallet/deposits/'.$row->id.'/approve').'">Approve</a>';
                $action.='<a class="btn btn-danger btn-sm m-1 verify-prompt" href="javascript:void(0)" data-prompt-msg="Are you sure you want to cancle this request ?" data-href="'.url('wallet/deposits/'.$row->id.'/cancle').'">Cancle</a>';
               return $action;
           })

            ->editColumn('status',function ($row){
               $status='';
               if($row->status==0){
                   $status.='<a class="btn btn-warning btn-sm m-1" href="javascript:void(0)">Pending</a>';
                }elseif($row->status==1){
                   $status.='<a class="btn btn-success btn-sm m-1" href="javascript:void(0)">Approved</a>';
                }else{
                   $status.='<a class="btn btn-danger btn-sm m-1" href="javascript:void(0)">Cancled</a>';
                }
               return $status;
           })->addColumn('user_name',function ($row){
                if($row->user_transaction!=null && $row->user_transaction->user!=null){
                    return $row->user_transaction->user->name;
            }
            })->addColumn('user_email',function ($row){
                if($row->user_transaction!=null && $row->user_transaction->user!=null){
                    return $row->user_transaction->user->email;
            }
           })->editColumn('transaction_id',function ($row){
             return $row->transaction_id;
           })
           ->editColumn('amount',function ($row){
             return '$'.number_format($row->amount,2);
           })

           ->rawColumns(['status', 'action', 'user_name', 'user_email'])
           ->make(true);
        }

        return view('wallet::deposits');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function status($id, $status)
    {
        DB::beginTransaction();
        try {          
            
                $admin_trans=AdminWalletTransactions::find($id);
                if($admin_trans==null){
                    return redirect()->back()->with('error', 'Something went wrong, admin transaction record not found against this transaction');
                }
                if($admin_trans!=null && $admin_trans->status!=0){
                    return redirect()->back()->with('warning', 'Sorry this transaction has already been entertained');
                }
                $user_trans=WalletTransactions::find($admin_trans->user_wallet_transaction_id);
                if($user_trans==null){
                    return redirect()->back()->with('error', 'Something went wrong, user transaction record not found against this transaction');
                }
                $user_wallet=Wallet::find($user_trans->wallet_id);
                if($user_wallet==null){
                    return redirect()->back()->with('error', 'Something went wrong, user wallet not found against this transaction');
                }


            if($status=='approve'){
                $user_wallet->update([
                    'total_available_balance'=> (int) $user_wallet->total_available_balance + (int) $user_trans->amount,
                    'total_credit_balance'=> (int) $user_wallet->total_credit_balance + (int) $user_trans->amount,
                ]);
                $user_trans->update(['status'=>2, 'remarks'=>'Deposit request approved']);
                $admin_trans->update(['status'=>1, 'remarks'=>'Deposit request approved']);
            DB::commit();

            return redirect()->back()->with('success', 'Deposit request approved successfully');

            }else{
                $user_trans->update(['status'=>3, 'remarks'=>'Deposit request cancled']);
                $admin_trans->update(['status'=>2, 'remarks'=>'Deposit request cancled']);
            DB::commit();
            return redirect()->back()->with('success', 'Deposit request cancled');

            }

        } catch (Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('wallet::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('wallet::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
