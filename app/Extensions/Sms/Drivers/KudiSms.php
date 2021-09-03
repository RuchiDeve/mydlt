<?php
namespace App\Extensions\Sms\Drivers;

use App\Extensions\Sms\Contracts\TextMessengerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class KudiSms implements TextMessengerInterface
{
    const API_DOMAIN = 'https://account.kudisms.net/api/';
    const AUTH_USERNAME = 'deecode.dlt@gmail.com';
    const AUTH_PASSWORD = 'benatry24';


    /**
     * @param string $message
     * @param array $phone_numbers
     * @param string $sender
     * @return array
     */
    public function send(string $message, array $phone_numbers, string $sender = 'DLT')
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
            $res = $client->request('GET', self::API_DOMAIN, [
                'query' => [
                    'sender' => $sender,
                    'mobiles' => $mobiles,
                    'username' => self::AUTH_USERNAME,
                    'password' => self::AUTH_PASSWORD,
                    'message' => $message
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
            $res = $client->request('GET', self::API_DOMAIN, [
                'query' => [
                    'username' => self::AUTH_USERNAME,
                    'password' => self::AUTH_PASSWORD,
                    'action' => 'balance'
                ],
                'verify' => false
            ]);

            $response = $res->getBody()->getContents() ?? null;

            $response_decoded = json_decode($response, true);

            return $response_decoded['balance'] ?? 0;

        } catch (GuzzleException $e) {
            $result['error'] = true;
            $result['remark'] = $e->getMessage();
        }

        return $result;
    }

}