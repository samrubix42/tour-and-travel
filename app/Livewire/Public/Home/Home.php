<?php

namespace App\Livewire\Public\Home;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $categories = \App\Models\Category::with(['destinations' => function($q) {
            $q->where('status', true);
        }])->where('status', true)->get();

        $banners = \App\Models\Banner::where('status', true)->get();

        return view('livewire.public.home.home', [
            'categories' => $categories,
            'banners' => $banners,
        ]);
    }
}
