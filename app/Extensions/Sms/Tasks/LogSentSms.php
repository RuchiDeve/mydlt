<?php

namespace App\Extensions\Sms\Tasks;


use App\Extensions\Sms\Events\SmsDelivered;
use App\Extensions\TaskManager\Task;
use App\Models\SmsUsage;

class LogSentSms extends Task
{

    protected $trigger = SmsDelivered::class;

    /**
     * @param array $args
     */
    public function execute(...$args)
    {
        /** @var SmsDelivered $event */
        $event = $args[0];

        SmsUsage::query()->create([
            'user_id' => $event->user->id,
            'units_used' => $event->units_used,
            'message' => $event->message,
            'recipients' => implode(', ', $event->recipients)
        ]);
    }
}