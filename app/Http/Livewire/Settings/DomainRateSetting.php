<?php

namespace App\Http\Livewire\Settings;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Livewire\Component;

class DomainRateSetting extends Component
{

    public $rate;

    public $saved;

    public function mount()
    {
        $this->fill([
            'rate' => Settings::getDomainRate(),
        ]);
    }

    public function updateRate()
    {
        Settings::saveSettings(SettingsEnum::DomainRatePerYear, $this->rate);

        $this->fill(['saved' => true]);
    }


    public function render()
    {
        return view('livewire.settings.domain-rate-setting');
    }
}
