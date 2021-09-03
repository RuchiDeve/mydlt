<?php

namespace App\Extensions\Sms\Contracts;


interface TextMessengerInterface
{
    /**
     * @param string $message
     * @param array $phone_numbers
     * @param string $sender
     * @return array
     */
    public function send(string $message, array $phone_numbers, string $sender);
    public function getBalanceCredit();

}