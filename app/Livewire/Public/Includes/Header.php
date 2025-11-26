<?php

namespace App\Livewire\Public\Includes;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Experience;
use Livewire\Attributes\Computed;

class Header extends Component
{
    #[Computed]
    public function render()
    {
        $destinations = Destination::where('status', 1)->orderBy('name')->get();
        $experiences = Experience::where('status', 1)->orderBy('name')->get();
        return view('livewire.public.includes.header', compact('destinations', 'experiences'));
    }
}
