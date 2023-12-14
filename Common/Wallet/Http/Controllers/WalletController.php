<?php

namespace Common\Wallet\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
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
