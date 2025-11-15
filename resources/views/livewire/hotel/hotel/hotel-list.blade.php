<div>
    <div class="container mt-3">
        <div class="hotel-panel mx-auto" style="max-width:1100px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Hotels</h4>
                <div>
                    <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary btn-sm">Add Hotel</a>
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">🔍</span>
                        <input wire:model.debounce.300ms="search" class="form-control" placeholder="Search hotels...">
                    </div>

                    <!-- Delete Confirmation Modal (Tabler style) -->
                    <div wire:ignore.self class="modal modal-blur fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center py-4">
                                    <h3 class="mb-1">Confirm Delete</h3>
                                    <p class="text-muted">Are you sure you want to delete this hotel?</p>
                                    <div class="mt-3">
                                        <button type="button" wire:click="$dispatch('closeDeleteModal')" class="btn btn-link link-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" wire:click="deleteHotel" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var deleteModalEl = document.getElementById('confirmDeleteModal');
                            if (!deleteModalEl) return;
                            var deleteModal = new bootstrap.Modal(deleteModalEl);

                            Livewire.on('openDeleteModal', function () {
                                deleteModal.show();
                            });

                            Livewire.on('closeDeleteModal', function () {
                                deleteModal.hide();
                            });
                        });
                    </script>

                    </div>
                <div class="col-md-6 text-end">
                    <select wire:model="perPage" class="form-select d-inline-block" style="width:110px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Destination</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->category?->name }}</td>
                                    <td>{{ $hotel->destination?->name }}</td>
                                    <td class="text-center">{{ $hotel->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-end">
                                        <button wire:click="openHotel({{ $hotel->id }})" class="btn btn-sm btn-outline-primary">View</button>
                                        <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-outline-secondary ms-1">Edit</a>
                                        <button wire:click="confirmDelete({{ $hotel->id }})" class="btn btn-sm btn-outline-danger ms-1">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No hotels found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <div class="ms-auto">{{ $hotels->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
