<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SmsPurchase;
use App\Models\DomainSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Settings;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('app.dashboard');
    }

    //paystack webhook go heres
    public function webhook(Request $request){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$request->reference,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_da5186ad90c40af18317d8b6aa0b62a6b95d19c3",
            "Cache-Control: no-cache",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $result =  json_decode($response);

         $email = $result->data->metadata->email;
         $amount = $result->data->amount/100;
         $reference = $request->reference;
         $paymentFor = $result->data->metadata->paymentFor;


         //check if payment is for sms unit
        if($paymentFor=='sms'){

            $unit = $result->data->metadata->unit;

        //find this user and add sms unit to his account
        $user = User::find(auth()->user()->id);
         $user->sms_unit_balance += $unit;
         $user->save();

        //update sms table for record purpose
         $request->user()->smsPurchases()->create([
             'payment_proof' => $reference,
             'amount' => $amount,
             'units' => $unit,
             'approved' => 1,
         ]);
        }elseif($paymentFor=='domain'){

            $request->user()->domainSubscriptions()->create([
                'payment_proof' => $reference,
                'amount' => Settings::getDomainRate(),
                'approved' => true,
                'expires_at' => now()->addYear(),
            ]);

        }

        $subject = "Payment for your $paymentFor";
        $message = "Hi payment is successful";

        $headers = "From: MyDLT  <noreply@mydlt.divineleverage.org/> \r\n";
        $headers .= "Reply-To: MyDLT <noreply@mydlt.divineleverage.org/> \r\n";
        $headers .= "Return-Path: MyDLT <noreply@mydlt.divineleverage.orgm>\r\n";
        $headers .= "Organization: MyDLT\r\n";
         $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "X-Priority: 3\r\n";
         $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
        @mail($email, $subject, $message, $headers);

        }

        http_response_code(200);
        return back();
     }
}
