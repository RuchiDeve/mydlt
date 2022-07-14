<?php

namespace App\Extensions\Sms\Tasks;


use App\Extensions\Sms\Contracts\TextMessengerInterface;
use App\Extensions\Sms\Events\SmsDelivered;
use App\Extensions\TaskManager\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendTextMessage extends Task
{

    /**
     * @var string
     */
    public $message;
    /**
     * @var array
     */
    public $recipients;
    /**
     * @var string
     */
    public $sender;

    /**
     * @var TextMessengerInterface
     */
    private $sms_client;
    /**
     * @var array
     */
    public $payload;

    /**
     * SendTextMessage constructor.
     */
    public function __construct()
    {

        $this->sms_client = app(TextMessengerInterface::class);
    }

    private function isSmsEnabled()
    {
        return config('sms.enabled');
    }


    /**
     * @param array $args
     */
    public function execute(...$args)
    {

        $this->message = $args[0];
        $this->recipients = $args[1];
        $this->sender = $args[2];
        $user = $args[3];

        if(!$this->isSmsEnabled()) return ;

        $response = $this->sms_client->send($this->message, $this->recipients, $this->sender);

        if($response['error']){
            // an error occurred
            Log::error($response['remark']);

        } else {
            $units_used = $response['count'];

            // message was delivered
            event(new SmsDelivered($this->message, $this->recipients, $this->sender, $units_used, $user));

        }
    }
}
