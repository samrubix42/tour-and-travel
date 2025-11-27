<div>
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px"
        style="background-image: url('https://placehold.co/1920x590')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large"
                    data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">
                        The perfect trip
                    </h2>
                    <h1
                        class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">
                        Contact us
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-very-light-gray position-relative">
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px"
            style="background-image:url('asset/images/demo-travel-agency-home-bg-02.png')"></div>

        <div class="container">
            <div class="row align-items-center mt-2">

                <!-- Left Panel -->
                <div class="col-lg-3 d-md-flex d-lg-inline-block md-mb-50px"
                    data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>

                    <div class="mb-60px text-center text-sm-start">
                        <span class="d-block alt-font fs-22 fw-500 text-dark-gray mb-5px">Call us directly</span>
                        <a href="tel:1800222000">1-800-222-000</a><br>
                        <a href="tel:1800222002">1-800-222-002</a>
                    </div>

                    <div class="mb-60px text-center text-sm-start">
                        <span class="d-block alt-font fs-22 fw-500 text-dark-gray mb-5px">Keep in touch</span>
                        <p>401 Broadway, 24th Floor,<br>Orchard View, London</p>
                        <a href="#" target="_blank" class="btn btn-link-gradient">Location map</a>
                    </div>

                    <div class="text-center text-sm-start">
                        <span class="d-block alt-font fs-22 fw-500 text-dark-gray mb-5px">Need live support</span>
                        <a href="mailto:info@yourdomain.com">info@yourdomain.com</a><br>
                        <a href="mailto:hr@yourdomain.com">hr@yourdomain.com</a>
                    </div>
                </div>

                <!-- Right Panel (Livewire Form) -->
                <div class="col-lg-9">
                    <div class="row row-cols-1 row-cols-md-2 border-radius-6px box-shadow-double-large m-0">

                        <!-- Side Image -->
                        <div class="col cover-background sm-h-550px xs-h-450px"
                            style="background-image: url('https://placehold.co/410x745')">
                        </div>

                        <!-- Form -->
                        <div class="col contact-form-style-03 bg-white p-70px lg-p-35px">
                            <h3 class="fw-600 alt-font text-dark-gray mb-25px">Let's get in touch.</h3>

                            @if ($success)
                                <div class="alert alert-success" id="successMsg">
                                    ✔ Message sent successfully!
                                </div>

                                <script>
                                    setTimeout(() => {
                                        const msg = document.getElementById('successMsg');
                                        if (msg) msg.style.display = 'none';
                                    }, 3000);
                                </script>
                            @endif

                            <form wire:submit.prevent="submit">

                                <div class="position-relative form-group mb-10px">
                                    <span class="form-icon"><i class="bi bi-emoji-smile"></i></span>
                                    <input wire:model="name"
                                        class="ps-0 border-radius-0px form-control"
                                        type="text" placeholder="What's your good name?*" />
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="position-relative form-group mb-10px">
                                    <span class="form-icon"><i class="bi bi-envelope"></i></span>
                                    <input wire:model="email"
                                        class="ps-0 border-radius-0px form-control"
                                        type="email" placeholder="Enter your email address*" />
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="position-relative form-group mb-10px">
                                    <span class="form-icon"><i class="bi bi-telephone"></i></span>
                                    <input wire:model="phone"
                                        class="ps-0 border-radius-0px form-control"
                                        type="tel" placeholder="Enter your phone number" />
                                    @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="position-relative form-group form-textarea mt-15px">
                                    <textarea wire:model="message"
                                        class="ps-0 border-radius-0px form-control"
                                        rows="3" placeholder="Describe about your tour"></textarea>
                                    <span class="form-icon"><i class="bi bi-chat-square-dots"></i></span>
                                    @error('message') <span class="text-danger small">{{ $message }}</span> @enderror

                                    <button class="btn btn-dark-gray btn-round-edge mt-30px"
                                        type="submit">
                                        Send message
                                    </button>

                                    <p class="fs-14 lh-22 mt-20px mb-0">
                                        We are committed to protecting your privacy. We will never collect information about you.
                                    </p>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- End Right Panel -->
            </div>
        </div>
    </section>

    <section class="bg-very-light-gray pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-6">
                <div class="col-12 col-md-auto text-center text-md-end">
                    <h4 class="text-dark-gray alt-font fw-500 mb-0">
                        Connect with social media
                    </h4>
                </div>

                <div class="col-12 col-md-auto elements-social social-icon-style-04 text-center text-md-start">
                    <ul class="large-icon dark">
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
