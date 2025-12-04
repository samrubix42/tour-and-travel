<div>
    <style>
        .enquiry-row:hover { background: rgba(18, 26, 33, 0.02); }
        .avatar-circle { width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:50%; background:#f1f3f5; color:#222; font-weight:700; }
        .small-muted { font-size:0.85rem; color:#6c757d; }
        .action-dropdown .dropdown-menu { min-width:160px; }
        .destination-badge { background: rgba(13,110,253,0.1); color:#0d6efd; padding:4px 8px; border-radius:12px; font-weight:600; font-size:12px; }
    </style>

    <div class="d-flex mb-3 align-items-center">
        <h3 class="me-auto">Taxi Enquiries</h3>
        <div class="ms-3 me-3">
            <div class="input-icon">
                <input type="text" class="form-control" placeholder="Search name, email, phone, car or location" wire:model.debounce.live.500ms="search">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                </span>
            </div>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <select wire:model.live="statusFilter" class="form-select form-select-sm">
                <option value="all">All statuses</option>
                <option value="new">New</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
            </select>
            <select wire:model.live="perPage" class="form-select form-select-sm">
                <option value="5">5 / page</option>
                <option value="10">10 / page</option>
                <option value="25">25 / page</option>
                <option value="50">50 / page</option>
            </select>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Pickup</th>
                        <th>Contact</th>
                        <th>Car</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquires as $e)
                        <tr class="enquiry-row">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">{{ strtoupper(substr($e->name,0,1)) }}</div>
                                    <div>
                                        <div class="fw-600">{{ $e->name }}</div>
                                        <div class="small-muted">{{ $e->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small-muted">{{ $e->pickup_location ?? '-' }}</div>
                                <div class="small-muted">{{ $e->pickup_date ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="fw-600">{{ $e->phone ?? '-' }}</div>
                                <div class="small-muted">{{ $e->email ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="destination-badge">{{ $e->car_model ?? '-' }}</div>
                            </td>
                            <td>
                                @if($e->status === 'new' || $e->status === null)
                                    <span class="badge bg-yellow-lt">New</span>
                                @elseif($e->status === 'processing')
                                    <span class="badge bg-primary-lt">Processing</span>
                                @elseif($e->status === 'completed')
                                    <span class="badge bg-green-lt">Completed</span>
                                @else
                                    <span class="badge bg-secondary-lt">{{ $e->status }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown action-dropdown d-inline-block">
                                    <button class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#" wire:click.prevent="viewEnquiry({{ $e->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M15 12a3 3 0 10-6 0 3 3 0 006 0z"></path><path d="M2.05 12A9.95 9.95 0 0112 2.05 9.95 9.95 0 0121.95 12"></path></svg>View
                                        </a>
                                        <a class="dropdown-item" href="#" wire:click.prevent="deleteEnquiry({{ $e->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M8 6v14a2 2 0 002 2h4a2 2 0 002-2V6"></path><path d="M10 11v6"></path><path d="M14 11v6"></path><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"></path></svg>Delete
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" wire:click.prevent="setStatus({{ $e->id }}, 'processing')">Mark processing</a>
                                        <a class="dropdown-item" href="#" wire:click.prevent="setStatus({{ $e->id }}, 'completed')">Mark completed</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No enquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex align-items-center">
            <div class="me-auto text-muted">Showing {{ $enquires->firstItem() ?? 0 }} to {{ $enquires->lastItem() ?? 0 }} of {{ $enquires->total() ?? 0 }} entries</div>
            <div>
                {{ $enquires->links() }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    @if($showViewModal && $selected)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block" tabindex="-1" role="dialog" style="display:block; z-index:200000;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title">Enquiry from {{ $selected->name }}</h5>
                            <div class="small-muted">{{ $selected->email ?? '-' }} · {{ $selected->phone ?? '-' }}</div>
                        </div>
                        <div class="ms-3">
                            @if($selected->status === 'new' || $selected->status === null)
                                <span class="badge bg-yellow-lt ms-2">New</span>
                            @elseif($selected->status === 'processing')
                                <span class="badge bg-primary-lt ms-2">Processing</span>
                            @elseif($selected->status === 'completed')
                                <span class="badge bg-green-lt ms-2">Completed</span>
                            @else
                                <span class="badge bg-secondary-lt ms-2">{{ $selected->status }}</span>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="closeView"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Pickup</strong>
                                <div class="small-muted">{{ $selected->pickup_location ?? '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Car model</strong>
                                <div class="small-muted">{{ $selected->car_model ?? '-' }}</div>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <strong>Message</strong>
                            <p class="small-muted mt-2">{!! nl2br(e($selected->message ?? '-')) !!}</p>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <strong>IP</strong>
                                <div class="small-muted">{{ $selected->ip ?? '-' }}</div>
                            </div>
                            <div class="col-md-6 text-end">
                                <strong>Received</strong>
                                <div class="small-muted">{{ $selected->created_at->toDayDateTimeString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" wire:click="closeView">Close</button>
                        <button class="btn btn-success" wire:click.prevent="setStatus({{ $selected->id }}, 'processing')">Mark processing</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
