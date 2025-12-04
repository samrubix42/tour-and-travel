<?php

namespace App\Livewire\Public\Taxi;

use Livewire\Component;

class Taxi extends Component
{
    public $cars = [];

    public function mount()
    {
        // sample car listings (requested models)
        $this->cars = [
            [
                'title' => 'Maruti Suzuki Wagon R',
                'image' => asset('asset/image/car/new-wagonR-colour-poolside-blue.jpg'),
                'rating' => 4.0,
                'seats' => 5,
                'transmission' => 'Manual',
                'luggage' => 2,
                'description' => 'Compact and fuel-efficient city car, ideal for short trips and airport runs.'
            ],
            [
                'title' => 'Suzuki Dzire',
                'image' => asset('asset/image/car/profile1731577693.avif'),
                'rating' => 3.9,
                'seats' => 4,
                'transmission' => 'Manual',
                'luggage' => 2,
                'description' => 'Comfortable sedan for city travel with good boot space for luggage.'
            ],
            [
                'title' => 'Maruti Suzuki Ertiga',
                'image' => asset('asset/image/car/ertiga-exterior-left-front-three-quarter.avif'),
                'rating' => 4.1,
                'seats' => 7,
                'transmission' => 'Manual',
                'luggage' => 4,
                'description' => 'Spacious MPV for families and groups, good for longer journeys.'
            ],
            [
                'title' => 'Toyota Innova',
                'image' => asset('asset/image/car/Toyota-Innova-Hycross-Zenix.jpg'),
                'rating' => 4.6,
                'seats' => 7,
                'transmission' => 'Manual',
                'luggage' => 5,
                'description' => 'Reliable MPV offering comfort and space for intercity travel.'
            ],
            [
                'title' => 'Maruti Suzuki Swift',
                'image' => asset('asset/image/car/20250704042326_Maruti_Suzuki_Swift_Sizzling_Red_with_Bluish_Black_Roof[1].avif'),
                'rating' => 4.2,
                'seats' => 5,
                'transmission' => 'Manual',
                'luggage' => 2,
                'description' => 'Nimble hatchback suitable for quick city runs and easy parking.'
            ],
            [
                'title' => 'Toyota Traveller',
                'image' => asset('asset/image/car/small_traveller_3050_450f195732.jpg'),
                'rating' => 4.5,
                'seats' => 12,
                'transmission' => 'Manual',
                'luggage' => 10,
                'description' => 'Large van for group transfers and long-distance travel with ample luggage space.'
            ],
        ];
    }
    public function render()
    {
        return view('livewire.public.taxi.taxi', [
            'cars' => $this->cars,
        ]);
    }
}
