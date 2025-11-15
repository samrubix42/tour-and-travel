<?php

namespace App\Livewire\Destination;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

class DestinationList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public $showModal = false;
    public $showDeleteModal = false;

    public $destinationId;
    public $name;
    public $slug;
    public $description;
    public $status = 1;
    public $image;
    public $imageFile;

    protected function rules()
    {
        $uniqueRule = $this->destinationId ? "unique:destinations,slug,{$this->destinationId}" : 'unique:destinations,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => ['required','string','max:255', $uniqueRule],
            'description' => 'nullable|string',
            'status' => 'boolean',
            'imageFile' => 'nullable|image|max:4096',
        ];
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Destination::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%");
        }

        $destinations = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.destination.destination-list', [
            'destinations' => $destinations,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $d = Destination::findOrFail($id);
        $this->destinationId = $d->id;
        $this->name = $d->name;
        $this->slug = $d->slug;
        $this->description = $d->description;
        $this->status = $d->status;
        $this->image = $d->image;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // ensure status is boolean/int
        $this->status = $this->status ? 1 : 0;

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status ?? 0,
        ];

        if ($this->imageFile) {
            $path = $this->imageFile->store('destinations', 'public');
            $data['image'] = $path;
        }

        if ($this->destinationId) {
            $dest = Destination::findOrFail($this->destinationId);
            // delete old image if replaced
            if ($this->imageFile && $dest->image) {
                try { Storage::disk('public')->delete($dest->image); } catch (\Throwable $e) {}
            }
            $dest->update($data);
            session()->flash('message', 'Destination updated successfully.');
        } else {
            Destination::create($data);
            session()->flash('message', 'Destination created successfully.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->destinationId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->destinationId) {
            $d = Destination::find($this->destinationId);
            if ($d) {
                if ($d->image) {
                    try { Storage::disk('public')->delete($d->image); } catch (\Throwable $e) {}
                }
                $d->delete();
                session()->flash('message', 'Destination deleted.');
            }
        }

        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->destinationId = null;
    }

    public function toggleStatus($id)
    {
        $d = Destination::findOrFail($id);
        $d->status = $d->status ? 0 : 1;
        $d->save();
        session()->flash('message', 'Destination status updated.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->destinationId = null;
        $this->name = null;
        $this->slug = null;
        $this->description = null;
        $this->status = 1;
        $this->image = null;
        $this->imageFile = null;
        $this->resetValidation();
    }
}
