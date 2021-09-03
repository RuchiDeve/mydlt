<?php

namespace App\Http\Livewire;

use App\Enums\Roles;
use App\Models\User;
use Livewire\Component;

class MemberStatCard extends Component
{

    public $totalMembers;

    public $monthTotal;

    public function mount()
    {
        $this->fill([
            'totalMembers' => User::query()->role(Roles::Member)->count(),
            'monthTotal' => User::query()->whereMonth('created_at', date('m'))->role(Roles::Member)->count(),
        ]);
    }

    public function render()
    {
        return view('livewire.member-stat-card');
    }
}
