   <header style="width: 100%;">
       <!-- start navigation -->
       <nav class="navbar navbar-expand-lg bg-white  border-radius-6px md-border-radius-0px">
           <div class="container-fluid">
               <div class="col-auto col-lg-2 me-lg-0 me-auto">
                   <a href="{{ route('home') }}">
                      <img src="{{setting('logo')}}" alt="" class="brand-logo">

                       <style>
                           .brand-logo {
                               height: 70px;
                               max-height: 120px;
                               width: auto;
                               display: block;
                               padding-top: 3px;
                               padding-bottom: 3px;
                           }
                           @media (max-width: 992px) {
                               .brand-logo {
                                   height: 70px;
                                   max-height: 100px;
                                   padding-top: 3px;
                                   padding-bottom: 3px;
                               }
                           }
                           @media (max-width: 768px) {
                               .brand-logo {
                                   height: 50px;
                                   max-height: 80px;
                                   padding-top: 3px;
                                   padding-bottom: 3px;
                               }
                               .teerth-title {
                                   color: black !important;
                                   font-size: 12px;
                               }
                           }

                           /* Header text color: gray */
                           .navbar .nav-link {
                               color: #35393c !important;
                           }
                           .navbar .nav-link:hover,
                           .navbar .nav-link:focus {
                               color: #2c3034 !important;
                           }
                           .navbar .header-icon i,
                           .navbar .header-icon a {
                               color: #373c41 !important;
                           }
                       </style>
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
                       <ul class="navbar-nav navbar-left justify-content-end" style="display:flex; flex-wrap:nowrap; white-space:nowrap;">

                           {{-- <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link">Destination</a>
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
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('experience') }}" class="nav-link">Experiences</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLinkExp" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLinkExp">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($experiences->chunk(8) as $chunk)
                                           @foreach($chunk as $exp)
                                           <div class="col">
                                               <a href="{{ route('tour') }}?experience={{ $exp->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $exp->name }}</strong>
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
                           </li>--}}
                           <li class="nav-item">
                               <a href="{{ route('home') }}" class="nav-link">Home</a>
                           </li>
                           {{-- $religPackages provided by Livewire Header component --}}

                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('tour') }}" class="nav-link">Teerth Yatra</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownTeerth" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownTeerth">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($religPackages->chunk(8) as $chunk)
                                           @foreach($chunk as $pkg)
                                           <div class="col">
                                               <a href="{{ route('tour') }}?package={{ $pkg->slug ?? $pkg->id }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $pkg->title }}</strong>
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
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link">Tours In India</a>
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
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('tour')}}" class="nav-link">International Tours</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownIntl" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownIntl">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($internationalPackages->chunk(8) as $chunk)
                                           @foreach($chunk as $pkg)
                                           <div class="col">
                                               <a href="{{ route('tour.view', ['slug' => $pkg->slug]) }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $pkg->title }}</strong>
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
                           <li class="nav-item dropdown submenu">
                               <a href="{{ (\Illuminate\Support\Facades\Route::has('hotels') ? route('hotels') : url('/hotels')) }}" class="nav-link">Hotels</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownHotels" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownHotels">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($hotelFeaturedDestinations->chunk(8) as $chunk)
                                           @foreach($chunk as $dest)
                                           <div class="col">
                                               <a href="{{ (\Illuminate\Support\Facades\Route::has('hotels') ? route('hotels') : url('/hotels')) }}?destination={{ $dest->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $dest->name }}</strong>
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
                               <a href="{{ route('taxi') }}" class="nav-link">Taxi</a>
                           </li>
                           {{--<li class="nav-item dropdown simple-dropdown">
                               <a href="javascript:void(0);" class="nav-link">Pages</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink3" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                                   <li><a href="{{ route('about') }}">About Us</a></li>
                           <li><a href="{{ route('blog') }}">Blog</a></li>
                       </ul>
                       </li>--}}

                       <li class="nav-item">
                           <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                       </li>

                       </ul>
                   </div>
               </div>
               <div class="col-auto text-end col-lg-2">
                   <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
                       <div class="header-icon">
                           <div class="header-search-icon icon">
                               <a href="tel:{{ setting('phone','') }}">
                                   <i class="feather icon-feather-phone"></i>
                               </a>
                           </div>

                       </div>

                   </div>
               </div>
           </div>
       </nav>
   </header>