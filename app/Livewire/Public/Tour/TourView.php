<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use App\Models\TourPackage;

class TourView extends Component
{
    public $package;

    public function mount($slug)
    {
        $this->package = TourPackage::with(['destinations', 'experiences', 'galleries'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (! $this->package) {
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.public.tour.tour-view', [
            'package' => $this->package,
        ]);
    }
}
