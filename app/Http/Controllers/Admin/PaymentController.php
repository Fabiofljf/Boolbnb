<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Publicity;
use Braintree;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function select(Apartment $apartment)
    {
        $publicities = Publicity::all();
        //dd($publicities);
        //dd($publicities, $apartment);
        return view('admin.publicity.index', compact('publicities', 'apartment'));
    }

    public function take(Apartment $apartment, Publicity $publicity)
    {
        /* $apartments = Apartment::all(); */
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        //dd($publicity, $apartment, $token);
        return view('admin.publicity.edit', compact('apartment', 'publicity', 'token'));
    }

    public function checkout(Request $request, Apartment $apartment, Publicity $publicity)
    {
        //dd($request->all());
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $resultCustomer = $gateway->customer()->create([
            'email' => Auth::user()->email,
        ]);
        //dd($resultCustomer->customer->id);
        $customerId = $resultCustomer->customer->id;

        $resultCreate = $gateway->paymentMethod()->create([
            'customerId' => $customerId,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'verifyCard' => true,
            ]
        ]);

        //dd($resultCreate);

        if ($resultCreate->success) {
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
            $expirationDate = Carbon::now()->addHours($publicity->duration);
            $currentDate = Carbon::now();
            //dd($expirationDate, $publicity->duration, $currentDate);
            $publicity->apartments()->attach([$apartment->id => ['publicity_start_date' => $currentDate, 'publicity_expiration_date' => $expirationDate]]);
            //dd($currentDate);
            // $apartment->publicities()->sync($request->publicities);
            return redirect()->route('admin.apartment.index')->with('message', "Sponsorizzazione di \"$apartment->title\" avvenuta con successo");
        } else {
            return redirect()->back()->with('message', "La transazione non è stata accettata. Si prega di riprovare con una carta valida");
        }
    }
}