<?php

namespace App\Extensions\Sms\Events;


use App\Models\User;

class SmsDelivered
{
    public $message;
    public $recipients;
    public $sender;
    public $units_used;
    /**
     * @var User
     */
    public $user;


    /**
     * SmsDelivered constructor.
     * @param $message
     * @param $recipients
     * @param $sender
     * @param $units_used
     */
    public function __construct($message, $recipients, $sender, $units_used, User $user)
    {
        $this->message = $message;
        $this->recipients = $recipients;
        $this->sender = $sender;
        $this->units_used = $units_used;
        $this->user = $user;
    }
}