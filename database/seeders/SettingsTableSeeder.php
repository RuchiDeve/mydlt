<?php

namespace Database\Seeders;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::query()->insert([
            ['key' => SettingsEnum::DomainRatePerYear, 'value' => 5000],
            ['key' => SettingsEnum::SmsRate, 'value' => 4],
        ]);
    }
}
