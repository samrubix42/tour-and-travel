<?php

namespace App\Livewire\Public\Hotel;

use Livewire\Component;
use App\Models\Hotel;

class HotelView extends Component
{
    public $slug;
    public $hotel;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->hotel = Hotel::with('galleries')->where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.public.hotel.hotel-view', ['hotel' => $this->hotel]);
    }
}
