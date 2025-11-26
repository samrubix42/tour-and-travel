<?php

namespace App\Livewire\Public\Includes;

use Livewire\Component;
use App\Models\Destination;

class Header extends Component
{
    public function render()
    {
        $destinations = Destination::where('status', 1)->orderBy('name')->get();
        return view('livewire.public.includes.header', compact('destinations'));
    }
}
