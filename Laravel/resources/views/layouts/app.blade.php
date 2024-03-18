<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
<body>
    <div id="app" class="main-container-section">
       
        <section id="menu-container" class="menu-container-section">
            <div class="container">
                <div class="row navi-sec">
                    <nav class=" navbar-expand-lg navbar-dark px-0 py-3 navi-body">
                        <div class="navbar container-xl navi-cont">
                            
                            <div class="col-12 col-lg-3 order-1 d-lg-flex d-none d-md-none d-sm-none navi-menu">                                                     
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>                    
                                <div class="collapse navbar-collapse header-navigation" id="navbarCollapse">                       
                                    <div class="navbar-nav navigation-menu">
                                        @foreach ($categories as $navbarItem)
                                            @if($navbarItem->parent_id == NULL )
                                                <a class="nav-item nav-link {{ request()->is($navbarItem->route) ? 'active' : '' }}" href="{{ url($navbarItem->route) }}">{{ $navbarItem->title }}</a>
                                            @endif
                                        @endforeach
                                    </div>  
                                </div> 
                            </div> 
                            <div class="col-12 col-lg-3 order-3 d-flex justify-content-lg-end justify-content-sm-center justify-content-center align-items-center reservation-cnt">           
                                                     
                                <div class="d-flex align-items-lg-center mt-3 mt-lg-0 mt-sm-0 user-acnt dropdown">
                                    <a href="#" class="btn btn-sm w-full w-lg-auto ms-3" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 20 23" fill="none">
                                            <path d="M10 11.4286C13.1563 11.4286 15.7143 8.87054 15.7143 5.71429C15.7143 2.55804 13.1563 0 10 0C6.84375 0 4.28571 2.55804 4.28571 5.71429C4.28571 8.87054 6.84375 11.4286 10 11.4286ZM14 12.8571H13.2545C12.2634 13.3125 11.1607 13.5714 10 13.5714C8.83929 13.5714 7.74107 13.3125 6.74554 12.8571H6C2.6875 12.8571 0 15.5446 0 18.8571V20.7143C0 21.8973 0.959821 22.8571 2.14286 22.8571H17.8571C19.0402 22.8571 20 21.8973 20 20.7143V18.8571C20 15.5446 17.3125 12.8571 14 12.8571Z" fill="#1F1F1F"/>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if ( Auth::check() )
                                        <li><a class="dropdown-item" href="{{ url('myaccount/logout') }}">Logout</a></li>
                                        @else
                                        <li><a class="dropdown-item" href="{{ url('myaccount/login') }}">Login</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ url('myaccount/login') }}">Register</a></li>
                                        @if ( Auth::check() )
                                        <li><a class="dropdown-item" href="{{ url('myaccount/dashboard') }}">View Dashboard</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="navbar-nav ms-lg-2 off-toggler-sec">
                                    <a href="#" class="btn btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#rightOffcanvas" aria-controls="rightOffcanvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20" fill="none">
                                            <path d="M0 2.5C0 3.88071 1.11929 5 2.5 5C3.88071 5 5 3.88071 5 2.5C5 1.11929 3.88071 0 2.5 0C1.11929 0 0 1.11929 0 2.5Z" fill="#1F1F1F"/>
                                            <path d="M7.5 2.5C7.5 3.88071 8.61929 5 10 5C11.3807 5 12.5 3.88071 12.5 2.5C12.5 1.11929 11.3807 0 10 0C8.61929 0 7.5 1.11929 7.5 2.5Z" fill="#1F1F1F"/>
                                            <path d="M15 2.5C15 3.88071 16.1193 5 17.5 5C18.8807 5 20 3.88071 20 2.5C20 1.11929 18.8807 0 17.5 0C16.1193 0 15 1.11929 15 2.5Z" fill="#1F1F1F"/>
                                            <path d="M0 10C0 11.3807 1.11929 12.5 2.5 12.5C3.88071 12.5 5 11.3807 5 10C5 8.61929 3.88071 7.5 2.5 7.5C1.11929 7.5 0 8.61929 0 10Z" fill="#1F1F1F"/>
                                            <path d="M7.5 10C7.5 11.3807 8.61929 12.5 10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10Z" fill="#1F1F1F"/>
                                            <path d="M15 10C15 11.3807 16.1193 12.5 17.5 12.5C18.8807 12.5 20 11.3807 20 10C20 8.61929 18.8807 7.5 17.5 7.5C16.1193 7.5 15 8.61929 15 10Z" fill="#1F1F1F"/>
                                            <path d="M0 17.5C0 18.8807 1.11929 20 2.5 20C3.88071 20 5 18.8807 5 17.5C5 16.1193 3.88071 15 2.5 15C1.11929 15 0 16.1193 0 17.5Z" fill="#1F1F1F"/>
                                            <path d="M7.5 17.5C7.5 18.8807 8.61929 20 10 20C11.3807 20 12.5 18.8807 12.5 17.5C12.5 16.1193 11.3807 15 10 15C8.61929 15 7.5 16.1193 7.5 17.5Z" fill="#1F1F1F"/>
                                            <path d="M15 17.5C15 18.8807 16.1193 20 17.5 20C18.8807 20 20 18.8807 20 17.5C20 16.1193 18.8807 15 17.5 15C16.1193 15 15 16.1193 15 17.5Z" fill="#1F1F1F"/>
                                        </svg>
                                    </a>

                                    <!------------------- Mobile ------------------------------->

                                    <div class="offcanvas offcanvas-end offcanvas-block-sec" tabindex="-1" id="rightOffcanvas" aria-labelledby="rightOffcanvasLabel">
                                        <div class="offcanvas-header">
                                            <span class="close-btn-body">                                        
                                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </span>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="navbar-nav d-xl-none d-md-flex flex-column align-items-center mt-3 navigation-menu2">
                                                @foreach ($categories as $navbarItem)
                                                    @if($navbarItem->parent_id == NULL )
                                                        <a class="nav-item nav-link {{ request()->is($navbarItem->route) ? 'active' : '' }}" href="{{ url($navbarItem->route) }}">{{ $navbarItem->title }}</a>
                                                    @endif
                                                @endforeach
                                            </div>  
                                            <div class="col-12 col-lg-12 offcanvas-body-content">
                                                <p class="text-center text-white mt-5">
                                                    Ufnau Strasse 92 Memmingen, Freistaat Bayern(BY), 87687
                                                </p>
                                                <p class="my-0">
                                                    <a href="#" class="nav-link text-center">test@gmail.com</a>
                                                </p>
                                                <p>
                                                    <a href="#" class="nav-link text-center">+49 30 727392606</a>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-12 opening">
                                                <p class="text-center text-white mt-5">
                                                    Monday to Sunday <br />
                                                    Lunchtime 11:30 - 14:30 <br />
                                                    Evening 17:00 - 23:00
                                                </p>
                                                <p class="my-0">
                                                    <a href="#" class="nav-link text-center">test@gmail.com</a>
                                                </p>
                                                <p>
                                                    <a href="#" class="nav-link text-center">+49 30 727392606</a>
                                                </p>
                                            </div>  
                                            <div class="col-12 col-lg-12 offcanvas-social">
                                                <ul class="nav navbar-nav">
                                                    <li class="nav-item">
                                                        <a href="#">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#">
                                                            <i class="fa fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>                                          
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
  
        <main class="py-0">
            @yield('content')
        </main>
    </div>
</body>

</html>

