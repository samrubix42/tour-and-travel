<div>
    <div class="container mt-3">
        <div class="destination-panel mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="h1 mb-0">Destinations</h3>
                    <p class="text-muted mb-0 small">Manage destinations — add, edit, upload images and toggle status.</p>
                </div>
                <div class="text-end">
                    <button wire:click="create" class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        &nbsp;New Destination
                    </button>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-6 d-flex">
                    <div class="d-flex col-8 gap-1">
                        <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search destinations...">
                        <select wire:model="perPage" class="form-select" style="width:70px;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th style="width:70px">Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center" style="width:120px">Status</th>
                                <th class="text-end" style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($destinations as $d)
                                <tr>
                                    <td>
                                        @if($d->image)
                                            <img src="{{ asset('storage/' . $d->image) }}" class="thumb" alt="thumb">
                                        @else
                                            <div class="thumb placeholder bg-secondary"></div>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $d->name }}</td>
                                    <td class="align-middle">{{ $d->slug }}</td>
                                    <td class="text-center align-middle">
                                        <label class="form-check form-switch d-inline-block" for="statusSwitch{{ $d->id }}">
                                            <input class="form-check-input" type="checkbox" id="statusSwitch{{ $d->id }}"
                                                   wire:click="toggleStatus({{ $d->id }})"
                                                   @if($d->status) checked @endif
                                                   wire:loading.attr="disabled">
                                            <span class="form-check-label"></span>
                                        </label>
                                    </td>
                                    <td class="text-end align-middle">
                                        <button wire:click="edit({{ $d->id }})" class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                        <button wire:click="confirmDelete({{ $d->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No destinations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing {{ $destinations->firstItem() ?? 0 }} to {{ $destinations->lastItem() ?? 0 }} of {{ $destinations->total() }} entries</p>
                    <div class="ms-auto">{{ $destinations->links() }}</div>
                </div>
            </div>

            {{-- Modal for create/edit --}}
            @if($showModal)
                <div wire:ignore.self class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
                    <div class="modal-dialog modal-lg" role="document" style="z-index:1060; margin-top:5vh;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $destinationId ? 'Edit Destination' : 'New Destination' }}</h5>
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
                                        <textarea wire:model.defer="description" class="form-control" rows="4"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Categories <span class="text-danger">*</span></label>
                                        <div class="@error('categoryIds') is-invalid @enderror">
                                            <div class="row g-2">
                                                @foreach($categories as $cat)
                                                    <div class="col-6 col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="cat{{ $cat->id }}" value="{{ $cat->id }}" wire:model.defer="categoryIds">
                                                            <label class="form-check-label" for="cat{{ $cat->id }}">{{ $cat->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @error('categoryIds') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image (optional)</label>
                                        <input wire:model="imageFile" type="file" class="form-control @error('imageFile') is-invalid @enderror">
                                        @error('imageFile') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                        @if ($imageFile)
                                            <div class="mt-2">
                                                <img src="{{ $imageFile->temporaryUrl() }}" alt="Preview" style="max-height:150px;">
                                            </div>
                                        @elseif ($image)
                                            <div class="mt-2">
                                                @php
                                                    $img = $image;
                                                @endphp
                                                <img src="{{ (\Illuminate\Support\Str::startsWith($img, ['http', '//']) ? $img : asset('storage/' . $img)) }}" alt="Current" style="max-height:150px;">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-check mb-3">
                                        <input wire:model.defer="status" class="form-check-input" type="checkbox" id="statusCheckbox">
                                        <label class="form-check-label" for="statusCheckbox">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link link-secondary" wire:click="closeModal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Delete confirmation --}}
            @if($showDeleteModal)
                <div wire:ignore.self class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
                    <div class="modal-dialog" role="document" style="z-index:1060; margin-top:20vh;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Deletion</h5>
                                <button type="button" class="btn-close" aria-label="Close" wire:click="cancelDelete"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this destination? This action cannot be undone.</p>
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


</div>
