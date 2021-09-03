<?php

namespace App\Http\Livewire\Settings;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Livewire\Component;

class MemberPageHeaderText extends Component
{

    public $setting;

    public $saved;

    public function mount()
    {
        $this->fill([
            'setting' => Settings::getMemberPageHeaderText(),
        ]);
    }

    public function updateSetting()
    {
        Settings::saveSettings(SettingsEnum::MemberPageHeaderText, $this->setting);

        $this->fill(['saved' => true]);
    }


    public function render()
    {
        return view('livewire.settings.member-page-header-text');
    }
}
