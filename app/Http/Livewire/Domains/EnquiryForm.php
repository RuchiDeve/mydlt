<?php

namespace App\Http\Livewire\Domains;

use App\Actions\MemberDomain\CreateEnquiry;
use App\Models\User;
use Livewire\Component;

class EnquiryForm extends Component
{

    public $username;

    public $product;

    public $name;
    public $phone;
    public $email;
    public $message;

    public $sent;

    protected $rules = [
        'name' => 'required|string',
        'phone' => 'required|numeric',
        'email' => 'required|string|email',
        'message' => 'required|string',
    ];

    /**
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMessage()
    {
        $payload = $this->validate();

        $payload['product_name'] = $this->product->name;

        (new CreateEnquiry())->create($this->getMemberProperty(), $payload);

        $this->sent = true;

        $this->reset(['name', 'phone', 'email', 'message']);

    }

    public function mount($product)
    {
        $this->username = request('member');
        $this->product = $product;

    }

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getMemberProperty()
    {
        return User::query()->where('username', $this->username)->first();
    }

    public function render()
    {
        return view('livewire.domains.enquiry-form');
    }
}
