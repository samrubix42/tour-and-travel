<div>
    <div class="container mt-3">
        <div class="category-panel mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h1 mb-0">Categories</h1>
                    <p class="text-muted mb-0 small">Manage categories — add, edit, upload images and toggle status.</p>
                </div>
                <div class="text-end">
                    <button wire:click="create" class="btn btn-primary btn-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        &nbsp;New Category
                    </button>
                </div>
            </div>
        <div class="row mb-2">
            <div class="col-md-8">
                <div class="d-flex gap-2">
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search categories...">
                    <select wire:model="perPage" class="form-select" style="width:70px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-4 text-end">
                <button wire:click="create" class="btn btn-primary">New Category</button>
            </div> -->
        </div>

        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</nobr>
                            </th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-center">
                                <label class="form-check form-switch d-inline-block" for="activeSwitch{{ $category->id }}">
                                    <input class="form-check-input" type="checkbox" id="activeSwitch{{ $category->id }}"
                                           wire:click="toggleActive({{ $category->id }})"
                                           @if($category->is_active) checked @endif
                                           wire:loading.attr="disabled">
                                    <span class="form-check-label"></span>
                                </label>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-outline-primary">Edit</button>
                                <button wire:click="confirmDelete({{ $category->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries</p>
                <ul class="pagination m-0 ms-auto">
                    {{ $categories->links() }}
                </ul>
            </div>
        </div>

        @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
            <div class="modal-dialog modal-lg" role="document" style="z-index:1060; margin-top:5vh;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $categoryId ? 'Edit Category' : 'New Category' }}</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input wire:model.defer="slug" type="text" class="form-control @error('slug') is-invalid @enderror">
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea wire:model.defer="description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-check mb-3">
                                <input wire:model.defer="is_active" class="form-check-input" type="checkbox" id="isActive">
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image (optional)</label>
                                <input wire:model="imageFile" type="file" class="form-control @error('imageFile') is-invalid @enderror"
                                       wire:loading.attr="disabled" wire:target="imageFile">
                                @error('imageFile') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                <div class="mt-2">
                                    <div wire:loading wire:target="imageFile" class="small text-muted">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        &nbsp;Uploading image...
                                    </div>

                                    @if ($imageFile)
                                        <div class="mt-2">
                                            <img src="{{ $imageFile->temporaryUrl() }}" alt="Preview" style="max-height:150px;">
                                        </div>
                                    @elseif ($category_image)
                                        <div class="mt-2">
                                            @if(\Illuminate\Support\Str::startsWith($category_image, ['http://', 'https://']))
                                                <img src="{{ $category_image }}" alt="Current" style="max-height:150px;">
                                            @else
                                                <img src="{{ asset('storage/' . $category_image) }}" alt="Current" style="max-height:150px;">
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link link-secondary" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">Save</span>
                                <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    &nbsp;Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        
        @if($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
            <div class="modal-dialog" role="document" style="z-index:1060; margin-top:20vh;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="cancelDelete"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this category? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" wire:click="cancelDelete">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
            </div> 
    
  

</div>