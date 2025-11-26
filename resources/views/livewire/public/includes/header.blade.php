   <header>
       <!-- start navigation -->
       <nav class="navbar navbar-expand-lg header-light bg-transparent disable-fixed border-radius-6px md-border-radius-0px">
           <div class="container-fluid">
               <div class="col-auto col-lg-2 me-lg-0 me-auto">
                   <a class="navbar-brand" href="demo-clothing-store.html">
                       <img src="images/demo-clothing-store-logo-black.png" data-at2x="images/demo-clothing-store-logo-black@2x.png" alt="" class="default-logo">
                       <img src="images/demo-clothing-store-logo-black.png" data-at2x="images/demo-clothing-store-logo-black@2x.png" alt="" class="alt-logo">
                       <img src="images/demo-clothing-store-logo-black.png" data-at2x="images/demo-clothing-store-logo-black@2x.png" alt="" class="mobile-logo">
                   </a>
               </div>
               <div class="col-auto col-xxl-6 col-lg-8 menu-order">
                   <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                   </button>
                   <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                       <ul class="navbar-nav navbar-left justify-content-end">
                           <li class="nav-item">
                               <a href="{{ route('home') }}" class="nav-link" style="color:white">Home</a>
                           </li>
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link" style="color:white">Destination</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($destinations->chunk(8) as $chunk)
                                               @foreach($chunk as $dest)
                                               <div class="col">
                                                   <a href="{{ route('tour') }}?slug={{ $dest->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                       <div class="d-flex align-items-center justify-content-between">
                                                           <div>
                                                               <strong class="fs-14" style="font-size:14px;">{{ $dest->name }}</strong>
                                                               <div class="text-muted small" style="font-size:12px;">View packages</div>
                                                           </div>
                                                           <i class="fa-solid fa-angle-right text-muted small"></i>
                                                       </div>
                                                   </a>
                                               </div>
                                               @endforeach
                                           @endforeach
                                       </div>
                                   
                                   </div>
                               </div>
                           </li>
                       
                           <li class="nav-item">
                               <a href="{{ route('blog') }}" class="nav-link" style="color:white">Blog</a>
                           </li>
                           <li class="nav-item">
                               <a href="{{ route('contact') }}" class="nav-link" style="color:white">Contact</a>
                           </li>
                       </ul>
                   </div>
               </div>
               <div class="col-auto text-end">
                   <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
                       <div class="header-icon">
                           <div class="header-search-icon icon">
                               <a href="#" class="search-form-icon header-search-form"><i class="feather icon-feather-search" style="color:white"></i></a>
                               <div class="search-form-wrapper">
                                   <button title="Close" type="button" class="search-close alt-font" >×</button>
                                   <form id="search-form" role="search" method="get" class="search-form text-left" action="search-result.html">
                                       <div class="search-form-box">
                                           <h2 class="text-dark-gray text-center mb-5 ls-minus-2px fw-600">What are you looking for?</h2>
                                           <input class="search-input" id="search-form-input5e219ef164995" placeholder="Enter your keywords..." name="s" value="" type="text" autocomplete="off">
                                           <button type="submit" class="search-button">
                                               <i class="feather icon-feather-search" aria-hidden="true" ></i>
                                           </button>
                                       </div>
                                   </form>
                               </div>
                           </div>
                           <div class="header-push-button icon" style>
                               <div class="push-button text-white">
                                   <span></span>
                                   <span></span>
                                   <span></span>
                                   <span></span>
                               </div>
                           </div>
                       </div>
                       <div class="push-menu push-menu-style-1 p-35px bg-white">
                           <span class="close-menu text-white bg-dark-gray"><i class="fa-solid fa-xmark"></i></span>
                           <div class="text-center push-menu-wrapper text-dark-gray" data-scroll-options='{ "theme": "dark" }'>
                               <div class="w-100">
                                   <img src="{{ asset('asset/images/demo-travel-agency-logo-black.png') }}" data-at2x="{{ asset('asset/images/demo-travel-agency-logo-black@2x.png') }}" class="mb-20" alt="" />
                                   <div class="d-inline-block align-middle bg-very-light-gray fw-600 text-dark-gray text-uppercase border-radius-22px ps-25px pe-25px fs-13 mb-15px">Explore the world</div>
                                   <h3 class="fw-600 mb-0 alt-font ls-minus-1px lh-38">World's leading travel agency</h3>
                               </div>
                               <div class="row align-items-center justify-content-center mt-20 mb-20 row-cols-3 row-cols-md-3 gutter-very-small row-cols-sm-3 instagram-follow-api position-relative">
                                   <div class="col instafeed-grid mb-10px">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                                   <div class="col instafeed-grid mb-10px">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                                   <div class="col instafeed-grid mb-10px">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                                   <div class="col instafeed-grid">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                                   <div class="col instafeed-grid">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                                   <div class="col instafeed-grid">
                                       <figure class="border-radius-0px"><a href="https://www.instagram.com" target="_blank"><img src="https://placehold.co/600x600" class="insta-image" alt=""><span class="insta-icon"><i class="fa-brands fa-instagram"></i></span></a></figure>
                                   </div>
                               </div>
                               <div class="col-12 text-center newsletter-style-02 position-relative mb-20">
                                   <span class="fs-18 w-80 mx-auto text-extra-dark-gray lh-26 d-inline-block mb-25px">Get latest update for our trusted applications</span>
                                   <form action="email-templates/subscribe-newsletter.php" method="post" class="position-relative w-100">
                                       <input class="border-radius-5px bg-white w-100 form-control required" type="email" name="email" placeholder="Enter your email">
                                       <input type="hidden" name="redirect" value="">
                                       <button class="btn submit" aria-label="submit"><i class="icon feather icon-feather-mail icon-small"></i></button>
                                       <div class="form-results border-radius-4px pt-10px pb-10px ps-15px pe-15px fs-14 w-100 text-center position-absolute lh-24 d-none"></div>
                                   </form>
                               </div>
                               <div class="col-12 text-center elements-social social-icon-style-01">
                                   <ul class="small-icon dark mb-0">
                                       <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                       <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i></a></li>
                                       <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                       <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                       <li><a class="linkedin" href="http://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </nav>
   </header>