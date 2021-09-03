<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SmsRate()
 * @method static static DomainRatePerYear()
 * @method static static VideoUrl()
 * @method static static PhotoBg()
 * @method static static MemberPageHeaderText()
 */
final class SettingsEnum extends Enum
{
    const SmsRate =   'Sms Rate';
    const DomainRatePerYear =   'Domain Rate Per Year';
    const VideoUrl =   'Video Url';
    const PhotoBg =   'Photo BG';
    const MemberPageHeaderText =   'Member Page Header Text';

}
