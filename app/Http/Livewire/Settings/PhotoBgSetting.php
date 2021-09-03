<?php

namespace App\Http\Livewire\Settings;

use App\Enums\SettingsEnum;
use App\Models\Settings;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoBgSetting extends Component
{

    use WithFileUploads;

    public $photo;

    public $saved;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        if(!$this->photo) {
            $this->dispatchBrowserEvent('notification', [
               'type' => 'toast',
               'message' => 'No image was selected for upload!',
               'messageType' => 'error'
            ]);

            return ;
        }

        $path = $this->photo->storePublicly('public/bg');

        Settings::saveSettings(SettingsEnum::PhotoBg, Str::after($path, 'public/'));

        $this->fill(['saved' => true]);
    }


    public function render()
    {
        return view('livewire.settings.photo-bg-setting');
    }
}
