<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Hotel;
use App\Models\TourPackage;
use App\Models\Destination;
use App\Models\User;
use App\Models\ContactForHotel;
use App\Models\ContactForTour;

class Dashboard extends Component
{
    #[Layout('components.layouts.admin')]
    public array $counts = [];
    public $recentHotelContacts = [];
    public $recentTourContacts = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $this->counts = [
            'hotels' => Hotel::count(),
            'tours' => TourPackage::count(),
            'destinations' => Destination::count(),
            'users' => User::count(),
            'hotel_contacts' => ContactForHotel::count(),
            'tour_contacts' => ContactForTour::count(),
        ];

        $this->recentHotelContacts = ContactForHotel::orderBy('created_at','desc')->take(6)->get();
        $this->recentTourContacts = ContactForTour::orderBy('created_at','desc')->take(6)->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dashboard', [
            'counts' => $this->counts,
            'recentHotelContacts' => $this->recentHotelContacts,
            'recentTourContacts' => $this->recentTourContacts,
        ]);
    }
}
