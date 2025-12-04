<div>
    @section('meta_tags')
    <title>Taxi & Rent a Car — TeerthYatraHoliday</title>
    <meta name="description" content="Taxi and rent-a-car services — comfortable cars for city and outstation travel">
    @endsection

    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('asset/image/demo-travel-agency-home-bg-02.png')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Best Services</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Taxi & Rent a Car</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-very-light-gray position-relative">
        <style>
            /* Responsive tweaks for taxi page */
            .taxi-hero-img { width:100%; height:220px; object-fit:cover; display:block; }
            .card-hover { transition: transform .18s; }
            .card-hover:hover { transform: translateY(-6px); }
            .feature-card .fs-28 { font-size:28px; }
            @media (max-width: 991.98px) {
                .taxi-hero-img { height:180px; }
            }
            @media (max-width: 575.98px) {
                .taxi-hero-img { height:140px; }
                .feature-card .fs-28 { font-size:22px; }
            }
        </style>
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h3 class="h4 mb-0">Available Cars</h3>
                    <div>
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary">Contact Us</a>
                    </div>
                </div>
            </div>

            <!-- Intro description + highlights -->
            <div class="row mb-4">
                <div class="col-lg-10 mx-auto text-center mb-3">
                    <h4 class="alt-font fw-600 mb-2" style="color:var(--base-color);">Reliable taxis, wherever you go</h4>
                    <p class="mb-0 text-muted">Choose from a curated fleet of clean, insured vehicles with experienced drivers — available for city transfers, airport pickups and longer trips. We prioritize punctuality, vehicle hygiene and driver professionalism. Whether you need a quick city drop, an airport transfer or a vehicle for a multi-day itinerary, our fleet is ready with transparent service and local route knowledge.</p>
                </div>

                <div class="col-12 mt-3">
                    <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center">
                        <div class="col text-center">
                                    <div class="bg-white p-3 border-radius-6px box-shadow-small h-100 feature-card">
                                        <div class="fs-28" style="color:var(--base-color);"><i class="feather icon-settings"></i></div>
                                <h6 class="alt-font fw-600 mt-2 mb-1">Well-maintained Vehicles</h6>
                                <p class="small text-muted mb-0">Regularly serviced and sanitized cars for your safety.</p>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="bg-white p-3 border-radius-6px box-shadow-small h-100 feature-card">
                                <div class="fs-28" style="color:var(--base-color);"><i class="feather icon-user-check"></i></div>
                                <h6 class="alt-font fw-600 mt-2 mb-1">Professional Drivers</h6>
                                <p class="small text-muted mb-0">Experienced and courteous drivers who know the routes.</p>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="bg-white p-3 border-radius-6px box-shadow-small h-100 feature-card">
                                <div class="fs-28" style="color:var(--base-color);"><i class="feather icon-calendar"></i></div>
                                <h6 class="alt-font fw-600 mt-2 mb-1">Flexible Booking</h6>
                                <p class="small text-muted mb-0">Book instantly or schedule in advance — travel on your terms.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($cars as $car)
                    <div class="col-lg-4 col-md-6">
                        <div class="bg-white border-radius-8px box-shadow-extra-large overflow-hidden h-100" style="transition:transform .18s;">
                                <div class="position-relative" style="overflow:hidden;">
                                <img src="{{ $car['image'] ?? 'https://placehold.co/800x450' }}" alt="{{ $car['title'] ?? 'Car' }}" class="taxi-hero-img" />
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge" style="background:var(--base-color);color:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.08);">{{ $car['seats'] ?? '-' }} seats</span>
                                </div>
                               
                            </div>

                            <div class="p-3">
                                <h5 class="alt-font fw-600 mb-1" style="color:var(--base-color);">{{ $car['title'] ?? 'Car' }}</h5>
                                <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($car['description'] ?? '', 110) }}</p>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="small text-muted">
                                        <i class="feather icon-users"></i> {{ $car['seats'] ?? '-' }} &nbsp; • &nbsp; {{ $car['transmission'] ?? '-' }} &nbsp; • &nbsp; Luggage: {{ $car['luggage'] ?? '-' }}
                                    </div>
                                    <div>
                                        <button wire:click.prevent="openBooking('{{ $car['title'] }}')" class="btn btn-primary d-block d-md-inline-block" style="background:var(--base-color);border-color:var(--base-color);color:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.08);min-width:120px;text-align:center;">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="bg-very-light-gray p-4 border-radius-6px text-center">No cars available at the moment.</div>
                    </div>
                @endforelse
            </div>

            {{-- Booking Modal (simple overlay) --}}
            @if($showBookingModal)
                <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background:rgba(0,0,0,0.5); z-index:2100;">
                    <div class="bg-white border-radius-8px p-4" style="width:95%; max-width:680px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Book: {{ $booking['car_model'] ?? '' }}</h5>
                            <button wire:click="closeBooking" class="btn btn-sm btn-light">Close</button>
                        </div>

                        <form wire:submit.prevent="submitBooking">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="small">Name *</label>
                                    <input type="text" wire:model.defer="booking.name" class="form-control form-control-sm" />
                                    @error('booking.name') <div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small">Phone *</label>
                                    <input type="text" wire:model.defer="booking.phone" class="form-control form-control-sm" />
                                    @error('booking.phone') <div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small">Email</label>
                                    <input type="email" wire:model.defer="booking.email" class="form-control form-control-sm" />
                                    @error('booking.email') <div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small">Pickup date *</label>
                                    <input type="date" wire:model.defer="booking.pickup_date" class="form-control form-control-sm" />
                                    @error('booking.pickup_date') <div class="text-danger small">{{ $message }}</div>@enderror
                                </div>

                                
                                <div class="col-md-6">
                                    <label class="small">Pickup location *</label>
                                    <input type="text" wire:model.defer="booking.pickup_location" class="form-control form-control-sm" />
                                    @error('booking.pickup_location') <div class="text-danger small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="small">Drop location</label>
                                    <input type="text" wire:model.defer="booking.drop_location" class="form-control form-control-sm" />
                                </div>

                                <div class="col-12">
                                    <label class="small">Message</label>
                                    <textarea wire:model.defer="booking.message" class="form-control form-control-sm" rows="3"></textarea>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-2">
                                    <button type="button" wire:click="closeBooking" class="btn btn-light btn-sm me-2">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-sm" style="background:var(--base-color);border-color:var(--base-color);">Send booking</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            {{-- Thank you modal --}}
            @if($showThankYou)
                <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background:rgba(0,0,0,0.5); z-index:2200;">
                    <div class="bg-white border-radius-8px p-4 text-center" style="width:90%; max-width:480px;">
                        <h4 class="mb-2" style="color:var(--base-color);">Thank you</h4>
                        <p class="small text-muted">Your booking request has been received. We will contact you shortly to confirm the details.</p>
                        <div class="mt-3">
                            <button wire:click="closeThankYou" class="btn btn-primary" style="background:var(--base-color);border-color:var(--base-color);">Close</button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Why choose us + FAQ -->
            <div class="row mt-5">
                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 border-radius-8px box-shadow-small h-100">
                        <h5 class="alt-font fw-600 mb-3" style="color:var(--base-color);">Why choose our taxi service?</h5>
                        <p class="text-muted mb-3">We combine comfort, safety and transparency. Our vehicles are regularly inspected and cleaned, drivers are verified, and we provide flexible pickup/drop options. We strive to make your journey smooth with reliable timings and friendly support.</p>

                        <ul class="list-unstyled small text-muted mb-0">
                            <li class="mb-2"><strong>✔</strong> All vehicles insured and sanitized</li>
                            <li class="mb-2"><strong>✔</strong> Verified & trained drivers</li>
                            <li class="mb-2"><strong>✔</strong> Easy booking and quick confirmations</li>
                            <li class="mb-2"><strong>✔</strong> 24/7 customer support for urgent needs</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="bg-white p-4 border-radius-8px box-shadow-small h-100">
                        <h5 class="alt-font fw-600 mb-3" style="color:var(--base-color);">Frequently asked questions</h5>
                        <div class="accordion" id="taxiFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqOne">
                                    <button class="accordion-button collapsed small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Can I book in advance?</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="faqOne" data-bs-parent="#taxiFaq">
                                    <div class="accordion-body small text-muted">Yes — you can book instantly or schedule pickups for future dates. We support advance reservations for trips and group transfers.</div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqTwo">
                                    <button class="accordion-button collapsed small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Are the drivers verified?</button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#taxiFaq">
                                    <div class="accordion-body small text-muted">All drivers pass identity and background checks and are trained for customer service and safe driving practices.</div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqThree">
                                    <button class="accordion-button collapsed small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">What if I need help during the trip?</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#taxiFaq">
                                    <div class="accordion-body small text-muted">Contact our 24/7 support line or use the contact form — we'll assist with route, driver, or vehicle issues immediately.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('contact') }}" class="btn btn-lg" style="background:var(--base-color);color:#fff;box-shadow:0 8px 30px rgba(0,0,0,0.08);">Contact us for custom trips</a>
                </div>
            </div>

        </div>
    </section>

</div>

</div>
