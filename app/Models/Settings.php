<?php

namespace App\Models;

use App\Enums\SettingsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Settings extends Model
{
    use HasFactory;


    protected $fillable = [
        'key', 'value'
    ];

    public static function saveSettings($key, $value)
    {
        $settings = self::query()->where('key', $key)->firstOrNew();

        $settings->fill([
            'key' => $key,
            'value' => $value,
        ]);

        $settings->save();
    }


    public static function getMemberPageHeaderText()
    {
        return self::getSettingsValue(SettingsEnum::MemberPageHeaderText);
    }


    public static function getPhotoBgSetting()
    {
        return Storage::url(self::getSettingsValue(SettingsEnum::PhotoBg));
    }


    public static function getVideoUrl()
    {
        return self::getSettingsValue(SettingsEnum::VideoUrl) ?? 'https://www.youtube.com/embed/5x610GuaPpc';
    }


    public static function getSmsRate()
    {
        return self::getSettingsValue(SettingsEnum::SmsRate);
    }

    public static function getDomainRate()
    {
        return self::getSettingsValue(SettingsEnum::DomainRatePerYear);
    }


    public static function getSettingsValue($key)
    {
        $setting = self::query()->where('key', $key)->first();

        return $setting ? $setting->value : null;
    }

}
