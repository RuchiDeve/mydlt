<?php
namespace App\Extensions\Sms\Drivers;

use App\Extensions\Sms\Contracts\TextMessengerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Zeevx\LaraTermii\LaraTermii;

class TermiiSms implements TextMessengerInterface
{

    //termii api details
    const API_KEY = "TLFrFAnrVZoDf74GQ4buCKQ7SfTmCohBCrXdCDUfPIizZFOFy2DHBmt81ac4G6";
    const API_DOMAIN = "https://api.ng.termii.com/api";

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
         * https://developers.termii.com/messaging
         *
         */
        $client = new Client();

        $oldBalance = $this->getBalanceCredit();

        $result = [];

        try {
            $mobiles = implode(', ', $phone_numbers);
            $res = $client->request('POST', self::API_DOMAIN."/sms/send", [
                'query' => [
                    'api_key' => self::API_KEY,
                    'from' => $sender,
                    'to' => $mobiles,
                    'type' => "plain",
                    'channel' => "generic",
                    'sms' => $message
                ],
                'verify' => false
            ]);

            $response = $res->getBody()->getContents() ?? null;
            $response_decoded = json_decode($response, true);

            if($response_decoded['code'] == 'ok'){
                $result['error'] = false;
                $result['response'] = $response_decoded;
                $result['count'] = $oldBalance - $response_decoded['balance'];
                $result['remark'] = 'Message was sent successfully. ' . $response_decoded['count'] . ' units was used.';

            } else{
                $result['error'] = true;
                $result['remark'] = "Message could\'nt sent";
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
            $res = $client->request('GET', self::API_DOMAIN."/get-balance", [
                'query' => [
                    'api_key' => self::API_KEY,
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

