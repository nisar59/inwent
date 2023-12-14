<?php

namespace Common\Wallet\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Wallet\Entities\Wallet;
use Common\Wallet\Entities\WalletTransactions;
use Common\Wallet\Entities\AdminWallet;
use Common\Wallet\Entities\AdminWalletTransactions;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;
use Throwable;
use Auth;
use DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $wallet=Wallet::where('user_id',$user_id)->first();
            if($wallet==null){
                $wallet=Wallet::create([
                    'user_id'=>$user_id,
                    'total_available_balance'=>0,
                    'total_credit_balance'=>0,
                    'total_debit_balance'=>0,
                ]);
            }


            $data=[
                'user'=>Auth::user(),
                'wallet'=>$wallet,
            ];

            $res=['success'=>true,'message'=>'Wallet successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);

        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('wallet::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function depositRequest(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $wallet=Wallet::where('user_id',$user_id)->first();

            if($wallet==null){
                $res=['success'=>false,'message'=>'Wallet not found against your account','errors'=>[],'data'=>null];
                 return response()->json($res);
            }

            $provider = new PayPalClient;
            $config=paypalConfig();
            $provider->setApiCredentials($config);
            $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => 'http://localhost:5959/inwt/wallet/deposit-success',
                    "cancel_url" => 'http://localhost:5959/inwt/wallet/deposit-failed',
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $req->amount
                        ]
                    ]
                ]
            ]);

            if (!isset($response['id']) || $response['id'] == null) {
                $res=['success'=>false,'message'=>'Deposit Request failed because of '.json_encode($response['message']),'errors'=>[],'data'=>null];
                 return response()->json($res);
            }



            $transaction=WalletTransactions::create([
                'user_id'=>$user_id,
                'wallet_id'=>$wallet->id,
                'transaction_module'=>3,
                'transaction_type'=>0,
                'amount'=>$req->amount,
                'user_to'=>$user_id,
                'wallet_to'=>$wallet->id,
                'transaction_id'=>$response['id'],
                'status'=>0,
                'remarks'=>'Deposit Request created',
                'logs'=>json_encode($response)
            ]);


            $data=[
                'user'=>Auth::user(),
                'transaction'=>$transaction,
            ];

            $res=['success'=>true,'message'=>'Deposit Request successfully created, you are shortly redirected to complete your deposit request','errors'=>[],'data'=>$data];
             return response()->json($res);

        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       

    }







    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function depositSuccess(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];

        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $wallet=Wallet::where('user_id',$user_id)->first();

            if($wallet==null){
                $res=['success'=>false,'message'=>'Wallet not found against your account','errors'=>[],'data'=>null];
                 return response()->json($res);
            }

            $provider = new PayPalClient;
            $config=paypalConfig();
            $provider->setApiCredentials($config);
            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($req->token);


            if(!isset($response['status']) || $response['status']!='COMPLETED'){

                   $err_msg='';

                   if(isset($response['message'])){
                    $err_msg=$response['message'];
                   }elseif(isset($response['error']) && isset($response['error']['message'])){
                    $err_msg=$response['error']['message'];
                   }else{
                    $err_msg='unknown error';
                   }

                    $res=['success'=>false,'message'=>'Deposit Request failed because of '.$err_msg,'errors'=>[],'data'=>$response];
                    return response()->json($res);
            }



            $admin_wallet=AdminWallet::first();
            if($admin_wallet==null){
                $admin_wallet=AdminWallet::create([
                    'total_available_balance'=>0,
                    'total_credit_balance'=>0,
                    'total_debit_balance'=>0,
                ]);
            }

            $user_trans=WalletTransactions::where('transaction_id', $response['id'])->first();

            AdminWalletTransactions::create([
                'admin_wallet_id'=>$admin_wallet->id,
                'user_wallet_transaction_id'=>$user_trans->id,
                'amount'=>$user_trans->amount,
                'transaction_id'=>$response['id'],
                'status'=>0,
                'remarks'=>'User deposit request',
                'logs'=>json_encode($response),
            ]);



            $admin_wallet=AdminWallet::find($admin_wallet->id);

            $admin_wallet->update([
                'total_available_balance'=> (int) $admin_wallet->total_available_balance + (int) $user_trans->amount,
                'total_credit_balance'=> (int) $admin_wallet->total_credit_balance + (int) $user_trans->amount,
            ]);

            $user_trans->update(['status'=>1, 'remarks'=>'Waiting for admin approval']);

            $res=['success'=>true,'message'=>'Deposit request completed successfully, cash will be deposited after admin approval', 'errors'=>[],'data'=>null];
            return response()->json($res);

        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       

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
