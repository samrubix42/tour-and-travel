<?php

namespace App\Livewire\Admin\Destination;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Destination;
use App\Models\Category;
use App\Services\ImageKitService;
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
    public $categoryIds = [];

    protected function rules()
    {
        $uniqueRule = $this->destinationId ? "unique:destinations,slug,{$this->destinationId}" : 'unique:destinations,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => ['required','string','max:255', $uniqueRule],
            'description' => 'nullable|string',
            'status' => 'boolean',
            'categoryIds' => 'required|array|min:1',
            'categoryIds.*' => 'integer|exists:categories,id',
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

        $categories = Category::where('is_active', 1)->orderBy('name')->get();

        return view('livewire.admin.destination.destination-list', [
            'destinations' => $destinations,
            'categories' => $categories,
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
        // Use fully-qualified column name to avoid ambiguity with pivot `id`
        $this->categoryIds = $d->categories()->pluck('categories.id')->toArray();

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
            // Try uploading to ImageKit if service exists; fallback to local storage
            $uploaded = null;
            try {
                $ik = app(ImageKitService::class);
                $res = $ik->upload($this->imageFile->getRealPath(), $this->imageFile->getClientOriginalName());
                // Extract URL from common response shapes
                if (is_object($res)) {
                    $uploaded = $res->result->url ?? $res->response->url ?? $res->url ?? null;
                } elseif (is_array($res)) {
                    $uploaded = $res['result']['url'] ?? $res['response']['url'] ?? ($res['url'] ?? null);
                }
            } catch (\Throwable $e) {
                // ignore and fallback
                $uploaded = null;
            }

            if ($uploaded) {
                $data['image'] = $uploaded;
            } else {
                $path = $this->imageFile->store('destinations', 'public');
                $data['image'] = $path;
            }
        }

        if ($this->destinationId) {
            $dest = Destination::findOrFail($this->destinationId);
            // delete old image if replaced
            if ($this->imageFile && $dest->image) {
                try { Storage::disk('public')->delete($dest->image); } catch (\Throwable $e) {}
            }
            $dest->update($data);
            // sync categories
            try { $dest->categories()->sync($this->categoryIds); } catch (\Throwable $e) {}

            session()->flash('message', 'Destination updated successfully.');
        } else {
            $dest = Destination::create($data);
            try { $dest->categories()->sync($this->categoryIds); } catch (\Throwable $e) {}
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
        $this->categoryIds = [];
        $this->resetValidation();
    }
}

