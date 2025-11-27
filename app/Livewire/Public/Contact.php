<?php

namespace App\Livewire\Public;

use App\Models\Contact as ModelsContact;
use Livewire\Component;

class Contact extends Component
{
     public $name, $email, $phone, $message, $success = false;

    protected $rules = [
        'name'   => 'required|string|max:255',
        'email'  => 'nullable|email',
        'phone'  => 'required|string|max:20',
        'message' => 'nullable|string|max:1000'
    ];

    public function submit()
    {
        $this->validate();

        ModelsContact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        $this->reset(['name','email','phone','message']);
        $this->success = true;
    }
    public function render()
    {
        return view('livewire.public.contact');
    }
}
