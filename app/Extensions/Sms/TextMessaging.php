<?php

namespace App\Extensions\Sms;


use App\Extensions\Sms\Contracts\TextMessengerInterface;

class TextMessaging
{

    const SMS_CHARGE_PER_UNIT_IN_NGN = 2.0;


    public static function getSmsCreditBalance()
    {
        return app(TextMessengerInterface::class)->getBalanceCredit();

    }

    public static function getSmsUnitBalance()
    {
        $credit = self::getSmsCreditBalance();

        if(!is_numeric($credit)) return 0;

        return round($credit / self::SMS_CHARGE_PER_UNIT_IN_NGN, 2);
    }

}
