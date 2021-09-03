<?php

namespace App\Extensions\Sms;


use App\Extensions\Sms\Contracts\TextMessengerInterface;
use App\Extensions\TaskManager\RegistersTasksFromPath;
use Illuminate\Support\ServiceProvider;


class SmsServiceProvider extends ServiceProvider
{
    use RegistersTasksFromPath;

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/sms.php', 'sms');

        $this->app->bind(TextMessengerInterface::class, config('sms.driver'));

        $this->loadTasksFrom(__DIR__ . '/Tasks', 'App\Extensions\Sms\Tasks');

    }


}