<div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-primary text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v10a2 2 0 0 0 2 2h14"></path><path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Hotels</div>
                        <div class="h4 m-0">{{ $counts['hotels'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-success text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10l-6 6-4-4-6 6"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Tours</div>
                        <div class="h4 m-0">{{ $counts['tours'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-warning text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a8 8 0 1 0-14.8 0"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Destinations</div>
                        <div class="h4 m-0">{{ $counts['destinations'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-info text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12v.01"></path><path d="M21 12a9 9 0 1 0-18 0 9 9 0 0 0 18 0z"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Users</div>
                        <div class="h4 m-0">{{ $counts['users'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-danger text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><path d="M7 10l5-5 5 5"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Hotel Contacts</div>
                        <div class="h4 m-0">{{ $counts['hotel_contacts'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-2">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-secondary text-white rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3z"></path></svg>
                        </span>
                    </div>
                    <div>
                        <div class="text-muted small">Tour Contacts</div>
                        <div class="h4 m-0">{{ $counts['tour_contacts'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Hotel Contacts</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentHotelContacts as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email ?? '-' }}</td>
                                    <td>{{ $c->phone ?? '-' }}</td>
                                    <td class="text-muted">{{ $c->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted small">No recent hotel contacts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Tour Contacts</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTourContacts as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email ?? '-' }}</td>
                                    <td>{{ $c->phone ?? '-' }}</td>
                                    <td class="text-muted">{{ $c->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted small">No recent tour contacts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
