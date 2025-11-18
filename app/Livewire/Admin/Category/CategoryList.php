<?php

namespace App\Livewire\Admin\Category;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ImageKitService;


class CategoryList extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;

    public $categoryId;
    public $name;
    public $description;
    public $slug;
    public $is_active = true;
    public $category_image;
    public $imageFile;

    protected function rules()
    {
        $uniqueRule = $this->categoryId ? "unique:categories,slug,{$this->categoryId}" : 'unique:categories,slug';

        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'is_active' => 'boolean',
            'category_image' => 'nullable|string|max:255',
            'imageFile' => 'nullable|image|max:2048',
        ];
    }
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Category::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('slug', 'like', "%{$this->search}%");
        }

        $categories = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.category.category-list', [
            'categories' => $categories,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->slug = $category->slug;
        $this->is_active = (bool) $category->is_active;
        $this->category_image = $category->category_image;

        $this->showModal = true;
    }

    public function save(ImageKitService $imageKit): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
        ];

        // Upload to ImageKit (store in '/categories' folder). Fallback to local storage.
        if ($this->imageFile) {
            $tempPath = $this->imageFile->getRealPath();
            $fileName = time() . '-' . Str::slug($this->name) . '.' . $this->imageFile->extension();

            $uploadResult = null;
            try {
                $uploadResult = $imageKit->uploadToFolder($tempPath, $fileName, '/categories');
            } catch (\Throwable $e) {
                $uploadResult = null;
            }

            $uploadedUrl = null;
            if ($uploadResult) {
                if (is_object($uploadResult)) {
                    $uploadedUrl = $uploadResult->result->url ?? $uploadResult->url ?? $uploadResult->response->url ?? null;
                } elseif (is_array($uploadResult)) {
                    $uploadedUrl = $uploadResult['result']['url'] ?? $uploadResult['url'] ?? ($uploadResult['response']['url'] ?? null);
                }
            }

            if ($uploadedUrl) {
                $data['category_image'] = $uploadedUrl;
            } else {
                // fallback to storing locally
                $path = $this->imageFile->store('categories', 'public');
                $data['category_image'] = $path;
            }

            // If replacing an existing local image, delete it. Do not attempt to delete remote ImageKit URLs here.
            if ($this->categoryId) {
                $existing = Category::findOrFail($this->categoryId);
                if ($existing->category_image && !Str::startsWith($existing->category_image, ['http://', 'https://', '//'])) {
                    try { Storage::disk('public')->delete($existing->category_image); } catch (\Throwable $e) {}
                }
            }
        }

        if ($this->categoryId) {
            Category::findOrFail($this->categoryId)->update($data);
            $this->dispatch('success', 'Category updated successfully.');
        } else {
            Category::create($data);
            $this->dispatch('success', 'Category created successfully.');
        }

        $this->imageFile = null;

        $this->closeModal();
        $this->resetPage();
    }


    public function confirmDelete(int $id): void
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if ($this->categoryId) {
            Category::destroy($this->categoryId);
            $this->dispatch('success', 'Category deleted.');
        }

        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! (bool) $category->is_active;
        $category->save();

        $this->dispatch('success', 'Category status updated.');
        $this->resetPage();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->categoryId = null;
    }

    protected function resetForm(): void
    {
        $this->categoryId = null;
        $this->name = null;
        $this->description = null;
        $this->slug = null;
        $this->is_active = true;
        $this->category_image = null;
        $this->resetValidation();
    }
}
