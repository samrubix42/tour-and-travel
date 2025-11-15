<?php

namespace App\Livewire\Hotel\Hotel;

use App\Models\Destination;
use App\Models\Hotel as HotelModel;
use App\Models\HotelCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class AddHotel extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $category_id;
    public $destination_id;
    public $address;
    public $rating;
    public $description;
    public $image;
    public $status = true;

    public $categories = [];
    public $destinations = [];

    public function mount()
    {
        $this->loadLists();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'address' => 'nullable|string|max:1000',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ];
    }

    public function loadLists()
    {
        $this->categories = HotelCategory::where('status', 1)->get();
        $this->destinations = Destination::where('status', 1)->get();
    }

    public function saveHotel()
    {
        $data = $this->validate();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($this->name);
        }

        if ($this->image) {
            $path = $this->image->store('hotels', 'public');
            $data['image'] = $path;
        }

        $data['status'] = isset($data['status']) ? (bool)$data['status'] : false;

        HotelModel::create($data);

        session()->flash('message', 'Hotel created successfully.');
        return redirect()->route('admin.hotel.list');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.hotel.hotel.add-hotel');
    }
}
