<?php

namespace App\Livewire\Public\Hotel;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Hotel as HotelModel;
use App\Models\Page;

class Hotel extends Component
{
    use WithPagination;

    public $perPage = 12;
    public $search = '';
    public $destination = null;

    protected $queryString = ['search', 'destination'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDestination()
    {
        $this->resetPage();
    }
    #[Title('Hotels - Find & Book Hotels')]
    public function render()
    {
        $query = HotelModel::query()->where('status', 1);
        if (!empty($this->search)) {
            $query->where(function($q){
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('address', 'like', '%'.$this->search.'%');
            });
        }

        if (!empty($this->destination)) {
            $query->whereHas('destination', function($q){
                $q->where('slug', $this->destination);
            });
        }

        $hotels = $query->with('destination','category')->latest()->paginate($this->perPage);

        $page = Page::where('slug', 'hotels')->first();

        return view('livewire.public.hotel.hotel', compact('hotels', 'page'));
    }
}
