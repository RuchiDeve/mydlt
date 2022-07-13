<?php
namespace App\Extensions\Sms\Drivers;

use App\Extensions\Sms\Contracts\TextMessengerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class KudiSms implements TextMessengerInterface
{
    const API_DOMAIN = 'https://account.kudisms.net/api/';
    const AUTH_USERNAME = 'deecode.dlt@gmail.com';
    const AUTH_PASSWORD = 'benatry24';

    //termii api details
    const KEY = "TLFrFAnrVZoDf74GQ4buCKQ7SfTmCohBCrXdCDUfPIizZFOFy2DHBmt81ac4G6";
    const T_DOMAIN = "https://api.ng.termii.com/api";

    /**
     * @param string $message
     * @param array $phone_numbers
     * @param string $sender
     * @return array
     */
    public function send(string $message, array $phone_numbers, string $sender = 'mydlt')
    {
        // TODO: Implement send() method.
        /*
         * https://account.kudisms.net/api/?username=user&password=pass&message=test
         * &sender=welcome&mobiles=2348030000000,2348020000000
         */

        $client = new Client();

        $result = [];

        try {
            $mobiles = implode(', ', $phone_numbers);
            $res = $client->request('POST', self::T_DOMAIN."/sms/send", [
                'query' => [
                    'api_key' => self::KEY,
                    'from' => $sender,
                    'to' => $mobiles,
                    'type' => "plain",
                    'channel' => "generic",
                    'sms' => $message
                ],
                'verify' => false
            ]);

            $response = $res->getBody()->getContents() ?? null;

            /*
             * Success Response: {"status":"OK","count":1,"price":2}
                Failed Response: {"error":"Login denied.","errno":"103"}
             */
            $response_decoded = json_decode($response, true);
            if(isset($response_decoded['error'])){
                $result['error'] = true;
                $result['remark'] = $response_decoded['error'];
            } elseif (isset($response_decoded['status']) && ($response_decoded['status'] == 'OK')){
                $result['error'] = false;
                $result['response'] = $response_decoded;
                $result['count'] = $response_decoded['count'];
                $result['remark'] = 'Message was sent successfully. ' . $response_decoded['count'] . ' units was used.';
            }

            return $result;

        } catch (GuzzleException $e) {
            $result['error'] = true;
            $result['remark'] = $e->getMessage();
        }

        return $result;
    }

    public function getBalanceCredit()
    {
        $client = new Client();

        $result = [];
        try {
            $res = $client->request('GET', self::T_DOMAIN."/get-balance", [
                'query' => [
                    'api_key' => self::KEY,
                ],
                'verify' => false
            ]);
            // $sender = "mydlt";
            // $phone_numbers = ['2347064641016','2348063717797'];
            // $message = "Testing out api now now";
            // $mobiles = implode(', ', $phone_numbers);
            // $res = $client->request('POST', self::T_DOMAIN."/sms/send", [
            //     'query' => [
            //         'api_key' => self::KEY,
            //         'from' => $sender,
            //         'to' => "2347064641016",
            //         'type' => "plain",
            //         'channel' => "generic",
            //         'sms' => $message
            //     ],
            //     'verify' => false
            // ]);

            $response = $res->getBody()->getContents() ?? null;

            $response_decoded = json_decode($response, true);
              //  Log::info($response_decoded);
            return $response_decoded['balance'] ?? 0;

        } catch (GuzzleException $e) {
            $result['error'] = true;
            $result['remark'] = $e->getMessage();
        }

        return $result;
    }

}

