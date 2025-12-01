<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">Contact & Social</div>
                <div class="card-body">
                    <form wire:submit.prevent="saveCommon">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input wire:model.defer="common.address" class="form-control" placeholder="Office address">
                            @error('common.address') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input wire:model.defer="common.phone" class="form-control" placeholder="+1 555 1234">
                            @error('common.phone') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location (map URL or embed)</label>
                            <input wire:model.defer="common.location" class="form-control" placeholder="Google maps link">
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input wire:model.defer="common.instagram" class="form-control" placeholder="https://instagram.com/yourprofile">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input wire:model.defer="common.facebook" class="form-control" placeholder="https://facebook.com/yourpage">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Twitter</label>
                            <input wire:model.defer="common.twitter" class="form-control" placeholder="https://twitter.com/yourprofile">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input wire:model.defer="common.linkedin" class="form-control" placeholder="https://linkedin.com/company/yourcompany">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">YouTube</label>
                            <input wire:model.defer="common.youtube" class="form-control" placeholder="https://youtube.com/yourchannel">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Contact & Social</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Custom setting (key / value)</div>
                <div class="card-body">
                    <form wire:submit.prevent="addSetting">
                        <div class="row g-2">
                            <div class="col-5">
                                <input wire:model.defer="key" class="form-control" placeholder="key (e.g. site_tagline)">
                                @error('key') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-5">
                                <input wire:model.defer="value" class="form-control" placeholder="value">
                                @error('value') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-2 d-grid">
                                <button class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <div class="mt-2">
                        <h6 class="mb-2">Existing settings</h6>
                        <div class="list-group">
                            @foreach($settings as $k => $v)
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-semibold">{{ $k }}</div>
                                        <div class="text-muted small">{{ \Illuminate\Support\Str::limit($v, 120) }}</div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button wire:click="deleteSetting('{{ $k }}')" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Preview & Quick Actions</div>
                <div class="card-body">
                    <h6>Quick preview</h6>
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <td class="text-muted">Address</td>
                            <td>{{ $settings['address'] ?? $common['address'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Phone</td>
                            <td>{{ $settings['phone'] ?? $common['phone'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Instagram</td>
                            <td>{{ $settings['instagram'] ?? $common['instagram'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Facebook</td>
                            <td>{{ $settings['facebook'] ?? $common['facebook'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Twitter</td>
                            <td>{{ $settings['twitter'] ?? $common['twitter'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">LinkedIn</td>
                            <td>{{ $settings['linkedin'] ?? $common['linkedin'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">YouTube</td>
                            <td>{{ $settings['youtube'] ?? $common['youtube'] ?? '-' }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="mt-3 d-flex gap-2">
                        <button wire:click="loadSettings" class="btn btn-outline-secondary">Refresh</button>
                        <a href="/" class="btn btn-outline-primary">Visit site</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('notify', event => {
            const { type, message } = event.detail || {};
            // Basic toast using Tabler's toast if available
            if (window.Tabler && Tabler.Toast) {
                Tabler.Toast.create({ title: type, message }).show();
            } else {
                alert(message);
            }
        });
    </script>
</div>
</div>
