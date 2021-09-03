<?php

namespace App\Http\Livewire\Settings;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Livewire\Component;

class FeatureVideoUrlSetting extends Component
{

    public $setting;

    public $saved;

    public function mount()
    {
        $this->fill([
            'setting' => Settings::getVideoUrl(),
        ]);
    }

    public function updateSetting()
    {
        Settings::saveSettings(SettingsEnum::VideoUrl, $this->setting);

        $this->fill(['saved' => true]);
    }


    public function render()
    {
        return view('livewire.settings.feature-video-url-setting');
    }
}
