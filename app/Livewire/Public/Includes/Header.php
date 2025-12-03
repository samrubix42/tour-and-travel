<?php

namespace App\Livewire\Public\Includes;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Experience;
use App\Models\TourPackage;
use Livewire\Attributes\Computed;

class Header extends Component
{
    public $destinations;
    public $experiences;
    public $religPackages;
    public $internationalPackages;
    public $hotelFeaturedDestinations;

    #[Computed]
    public function mount()
    {
        $this->destinations = Destination::where('status', 1)->orderBy('name')->get();
        $this->experiences = Experience::where('status', 1)->orderBy('name')->get();
        $this->religPackages = TourPackage::whereHas('categories', function ($q) {
            $q->where('slug', 'religious')
                ->orWhere('slug', 'religous')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%relig%']);
        })->where('status', true)->take(8)->get();
        $this->internationalPackages = TourPackage::whereHas('categories', function ($q) {
            $q->where('slug', 'international')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%international%']);
        })->where('status', true)->take(8)->get();
        $this->hotelFeaturedDestinations = Destination::where('status', 1)
            ->where(function($q){
                $q->where('is_hotel_featured', 1)->orWhere('is_hotel_featured', true);
            })
            ->orderBy('name')
            ->get();
    }
    public function render()
    {

        return view('livewire.public.includes.header');
    }
}
