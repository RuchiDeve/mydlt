<?php

namespace App\Http\Livewire;

use App\Enums\Roles;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MemberList extends Component
{
    use WithPagination;

    protected $members;


    public function render()
    {
        $this->members = User::query()
            ->role(Roles::Member)
            ->paginate(10);

        return view('livewire.member-list')
            ->with('members', $this->members);
    }
}
