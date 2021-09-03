<?php

namespace App\Http\Livewire\Settings;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Livewire\Component;

class SmsRateSetting extends Component
{

    public $rate;

    public $saved;

    public function mount()
    {
        $this->fill([
            'rate' => Settings::getSmsRate(),
        ]);
    }

    public function updateRate()
    {
        Settings::saveSettings(SettingsEnum::SmsRate, $this->rate);

        $this->fill(['saved' => true]);
    }

    public function render()
    {
        return view('livewire.settings.sms-rate-setting');
    }
}
