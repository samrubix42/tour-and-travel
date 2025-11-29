<div>
    <div class="d-flex mb-3 align-items-center">
        <h3 class="me-auto">Hotel Enquiries</h3>
        <div class="input-icon w-25">
            <input type="text" class="form-control" placeholder="Search name, email or phone" wire:model.debounce.500ms="search">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
            </span>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Guests</th>
                        <th>When</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->email ?? '-' }}</td>
                            <td>{{ $c->phone ?? '-' }}</td>
                            <td class="text-muted">{{ $c->no_of_persons ?? '-' }}</td>
                            <td class="text-muted">{{ $c->created_at->diffForHumans() }}</td>
                            <td>
                                @if(is_null($c->status) || $c->status === '' || $c->status === 'pending' || $c->status == 0)
                                    <span class="badge bg-yellow">Pending</span>
                                @elseif($c->status === 'handled' || $c->status == 1)
                                    <span class="badge bg-green">Handled</span>
                                @else
                                    <span class="badge bg-secondary">{{ $c->status }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-primary me-1" wire:click.prevent="viewContact({{ $c->id }})">View</button>
                                <button class="btn btn-sm btn-outline-success me-1" wire:click.prevent="toggleStatus({{ $c->id }})">Toggle Status</button>
                                <button class="btn btn-sm btn-outline-danger" wire:click.prevent="confirmDelete({{ $c->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No enquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex align-items-center">
            <div class="me-auto text-muted">Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() ?? 0 }} entries</div>
            <div>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    @if($showModal && $selectedContact)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block" tabindex="-1" role="dialog" style="display:block; z-index:200000;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enquiry from {{ $selectedContact->name }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $selectedContact->name }}</dd>

                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">{{ $selectedContact->email ?? '-' }}</dd>

                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9">{{ $selectedContact->phone ?? '-' }}</dd>

                            <dt class="col-sm-3">Guests</dt>
                            <dd class="col-sm-9">{{ $selectedContact->no_of_persons ?? '-' }}</dd>

                            <dt class="col-sm-3">Check In / Out</dt>
                            <dd class="col-sm-9">{{ $selectedContact->check_in ?? '-' }} &nbsp; / &nbsp; {{ $selectedContact->check_out ?? '-' }}</dd>

                            <dt class="col-sm-3">Message</dt>
                            <dd class="col-sm-9">{!! nl2br(e($selectedContact->message ?? '-')) !!}</dd>

                            <dt class="col-sm-3">IP</dt>
                            <dd class="col-sm-9">{{ $selectedContact->ip ?? '-' }}</dd>

                            <dt class="col-sm-3">Received</dt>
                            <dd class="col-sm-9">{{ $selectedContact->created_at->toDayDateTimeString() }}</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" wire:click="closeModal">Close</button>
                        <button class="btn btn-success" wire:click.prevent="toggleStatus({{ $selectedContact->id }})">Toggle Status</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirm -->
    @if($showDeleteConfirm && $confirmDeleteId)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block" tabindex="-1" role="dialog" style="display:block; z-index:200001;">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-4">
                        <h5>Delete enquiry?</h5>
                        <p class="text-muted">This action cannot be undone.</p>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-outline-secondary me-2" wire:click.prevent="$set('showDeleteConfirm', false)">Cancel</button>
                            <button class="btn btn-danger" wire:click.prevent="deleteConfirmed">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
