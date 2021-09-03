<?php

namespace App\Extensions\Sms\Tasks;


use App\Extensions\Sms\Events\SmsDelivered;
use App\Extensions\TaskManager\Task;

class UpdateSmsQuotaFromSentMessage extends Task
{

    protected $trigger = SmsDelivered::class;


    /**
     * @param array $args
     */
    public function execute(...$args)
    {
        /** @var SmsDelivered $event */
        $event = $args[0];

        $user = $event->user;

        $user->deductSmsUnit($event->units_used);
    }
}