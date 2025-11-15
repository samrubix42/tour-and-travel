<?php

namespace App\Livewire\Hotel\Hotel;

use App\Models\Hotel as HotelModel;
use App\Models\Destination;
use App\Models\HotelCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateHotel extends Component
{
    use WithFileUploads;

    public $hotelId;
    public $name;
    public $slug;
    public $category_id;
    public $destination_id;
    public $address;
    public $rating;
    public $description;
    public $image; // new upload
    public $existingImage; // existing stored image
    public $status = true;

    public $categories = [];
    public $destinations = [];

    public function mount($id)
    {
        $this->hotelId = $id;
        $this->loadLists();
        $this->loadForEdit($id);
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

    public function loadForEdit($id)
    {
        $hotel = HotelModel::find($id);
        if (!$hotel) return;

        $this->hotelId = $hotel->id;
        $this->name = $hotel->name;
        $this->slug = $hotel->slug;
        $this->category_id = $hotel->category_id;
        $this->destination_id = $hotel->destination_id;
        $this->address = $hotel->address;
        $this->rating = $hotel->rating;
        $this->description = $hotel->description;
        $this->existingImage = $hotel->image;
        $this->status = (bool) $hotel->status;
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
        } else {
            if ($this->existingImage) {
                $data['image'] = $this->existingImage;
            }
        }

        $data['status'] = isset($data['status']) ? (bool)$data['status'] : false;

        $hotel = HotelModel::find($this->hotelId);
        if ($hotel) {
            $hotel->update($data);
            session()->flash('message', 'Hotel updated successfully.');
        }

        return redirect()->route('admin.hotel.list');
    }

    #[\Livewire\Attributes\Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.hotel.hotel.update-hotel');
    }
}
