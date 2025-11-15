<div>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Add Hotel</h4>
            <a href="{{ route('admin.hotel.list') }}" class="btn btn-outline-secondary btn-sm">Back to list</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="saveHotel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model.defer="name">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Slug (optional)</label>
                                <input type="text" class="form-control" wire:model.defer="slug">
                                @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" wire:model.defer="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Destination</label>
                                <select class="form-select" wire:model.defer="destination_id">
                                    <option value="">-- Select Destination --</option>
                                    @foreach($destinations as $dest)
                                        <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                    @endforeach
                                </select>
                                @error('destination_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" wire:model.defer="address">
                        @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <input type="number" step="0.1" min="0" max="5" class="form-control" wire:model.defer="rating">
                                @error('rating') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" wire:model="image">
                                @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                                @if($image)
                                    <div class="mt-2">
                                        Photo Preview:
                                        <img src="{{ $image->temporaryUrl() }}" alt="preview" style="max-width:150px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="status" wire:model.defer="status">
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" wire:model.defer="description"></textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.hotel.list') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Hotel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
