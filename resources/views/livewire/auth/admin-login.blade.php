
<div class="auth-page">
    <div class="container d-flex align-items-center justify-content-center" style="min-height:90vh">
        <div class="card shadow-lg border-0" style="max-width:400px; width:100%; border-radius:18px; background:rgba(255,255,255,0.98);">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="" alt="Logo" style="height:56px; margin-bottom:10px;" onerror="this.style.display='none'">
                    <h3 class="fw-bold mb-1" style="letter-spacing:1px;">Admin Login</h3>
                    <p class="text-muted mb-0 small">Sign in to your admin panel</p>
                </div>

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input wire:model.defer="email" type="email" class="form-control rounded-pill px-3 py-2 @error('email') is-invalid @enderror" placeholder="you@example.com" autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input wire:model.defer="password" type="password" class="form-control rounded-pill px-3 py-2 @error('password') is-invalid @enderror" placeholder="Your password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input wire:model="remember" class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="small text-primary">Forgot password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm" style="font-weight:600; letter-spacing:1px;">Sign in</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center small text-muted" style="background:transparent; border:0;">© {{ date('Y') }} Your Company</div>
        </div>
    </div>

    <style>
        body{ background: linear-gradient(180deg,#f8fafc,#eef2ff); }
        .auth-page{ min-height:100vh; }
        .card{ border:0; }
        .btn-primary{ background-image: linear-gradient(90deg,#4f46e5,#06b6d4); border:0; color:#fff; box-shadow:0 2px 8px rgba(79,70,229,0.08); }
        .form-control:focus{ box-shadow:0 0 0 2px #4f46e522; border-color:#4f46e5; }
        .form-control{ background:rgba(245,247,255,0.95); border-radius:18px; border:1px solid #e0e7ff; }
        .card-footer{ font-size:13px; }
    </style>
</div>
