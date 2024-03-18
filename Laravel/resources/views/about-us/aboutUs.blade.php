@extends('layouts.app')
  
@section('content')
<section>
</section>

<section class="about-us-page-section">
    <div class="container-fluid">
        <div class="row about-page-banner">
            <div class="col-12 col-lg-12 px-0 about-page-banner-img">
                <img src="{{ asset("img/restaurant-about-bg1.png") }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="about-page-banner-text">
        <h2 class="">About Us</h2>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row about">
            <div class="col-12 col-lg-4 col-md-6 order-1 order-md-2 about-img">
                <img src="{{ asset("img/restaurant-1.webp") }}" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-lg-5 py-5 order-md-1 about-content d-flex flex-column justify-content-evenly">
                <div class="col-12 col-lg-12 d-flex justify-content-center about-title">
                    <img src="{{ asset("img/title-shape.png") }}" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-lg-12 py-3 about-content-sec">
                    <h3>Lorem ipsum dolor sit <br /> <span> amet, consectetur</span></h3>
                </div>
                <div class="col-12 col-lg-12 col-md-12 about-content-para">
                    <p class="text-center">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6 order-md-3 justify-content-md-between about-menu-list d-flex flex-column justify-content-center">
                @foreach($categories as $category)
                    {{-- {{ $categoryCount = count((array)$category->id) }} --}}
                    
                    @if($category->parent_id != NULL)
                    <div class="d-flex flex-wrap pb-3 align-items-center flex-lg-row flex-md-row-reverse menu-list-section">
                        <div class="col-12 col-lg-2 col-md-2 menu-list-section-img">
                            <img src="/images/{{ $category->image }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-12 col-lg-10 col-md-10 menu-list-section-content px-3">
                            <h4><a href="{{ route('menu') }}" class="nav-link p-0"> {{$category->title}}</a></h4>
                            {{-- <p>
                                <span>$22.00</span>
                            </p> --}}
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="about-spinner-image-section">
    <div class="container">
        <div class="row about-spinner-image-body">
            <div class="col-12 col-lg-12 spinner-image-bg">
                <img src="{{ asset("img/about-thumb-1024x476.png") }}" class="img-fluid" alt="">                
            </div>
            <div class="col-12 col-lg-12 spinner-image">               
                <img src="{{ asset("img/round.png") }}" class="img-fluid round-img-ani" alt="">
            </div>
        </div>
    </div>
</section>
<section class="about-our-services-section">
    <div class="container">
        <div class="row about-our-services-body">
            <div class="col-12 col-lg-12 d-flex justify-content-center about-our-services-title-img">
                <img src="{{ asset("img/title-shape.png") }}" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-lg-12 about-our-services-title py-3 mb-3">
                <h3>Our services</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,<br /> luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            </div>
           <div class="about-our-services-content-container">
            <div class=" about-our-services-content">
                <div class="card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path class="elementor-shape-fill card-shape-clr" d="M1000,4.3V0H0v4.3C0.9,23.1,126.7,99.2,500,100S1000,22.7,1000,4.3z"></path>
                    </svg>
                    <div class="about-our-services-content-details">
                        <span class="cooking">
                            <img src="{{ asset("img/icons/cooking-food.png") }}" class="img-fluid" alt="" >
                        </span> 
                        <div class="card-body py-5 text-center">                                               
                            <h5 class="card-title">Lorem ipsum dolor</h5>                      
                            <p class="card-text mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                            <a href="#" class="card-link">Read more 
                                <span>
                                    <img src="{{ asset("img/icons/arrow-right.png") }}" class="img-fluid" alt="" >
                                </span>
                            </a>                        
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class=" about-our-services-content">
                <div class="card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path class="elementor-shape-fill card-shape-clr" d="M1000,4.3V0H0v4.3C0.9,23.1,126.7,99.2,500,100S1000,22.7,1000,4.3z"></path>
                    </svg>
                    <div class="about-our-services-content-details">
                        <span class="cooking">
                            <img src="{{ asset("img/icons/mobile-order.png") }}" class="img-fluid" alt="" >
                        </span> 
                           <div class="card-body py-5 text-center">                                               
                            <h5 class="card-title">Consectetur adipiscing</h5>                      
                            <p class="card-text mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                            <a href="#" class="card-link">Read more 
                                <span>
                                    <img src="{{ asset("img/icons/arrow-right.png") }}" class="img-fluid" alt="" >
                                </span>
                            </a>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class=" about-our-services-content">
                <div class="card">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path class="elementor-shape-fill card-shape-clr" d="M1000,4.3V0H0v4.3C0.9,23.1,126.7,99.2,500,100S1000,22.7,1000,4.3z"></path>
                    </svg>
                    <div class="about-our-services-content-details">
                        <span class="cooking">
                            <img src="{{ asset("img/icons/delivery.png") }}" class="img-fluid" alt="" >
                        </span> 
                           <div class="card-body py-5 text-center">                                               
                            <h5 class="card-title">Ullamcorper mattis</h5>                      
                            <p class="card-text mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                            <a href="#" class="card-link">Read more 
                                <span>
                                    <img src="{{ asset("img/icons/arrow-right.png") }}" class="img-fluid" alt="" >
                                </span>
                            </a>                        
                        </div>
                    </div>
                </div>
            </div>    
           </div>        
            
        </div>
    </div>
</section>
<section class="book-now-section" style="background-color: #dd5902;">
    <div class="container">
        <div class="row book-now-body">
            <div class="d-flex justify-content-between book-now-content">
                <h3>
                    Book your table today. <span>Book Now!</span>
                </h3>
                <a href="{{ url('/#reservation')}}" class="d-flex align-items-center nav-link bg-white text-dark">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                            <path d="M0 18.125C0 19.1602 0.839844 20 1.875 20H15.625C16.6602 20 17.5 19.1602 17.5 18.125V7.5H0V18.125ZM12.5 10.4688C12.5 10.2109 12.7109 10 12.9688 10H14.5312C14.7891 10 15 10.2109 15 10.4688V12.0312C15 12.2891 14.7891 12.5 14.5312 12.5H12.9688C12.7109 12.5 12.5 12.2891 12.5 12.0312V10.4688ZM12.5 15.4688C12.5 15.2109 12.7109 15 12.9688 15H14.5312C14.7891 15 15 15.2109 15 15.4688V17.0312C15 17.2891 14.7891 17.5 14.5312 17.5H12.9688C12.7109 17.5 12.5 17.2891 12.5 17.0312V15.4688ZM7.5 10.4688C7.5 10.2109 7.71094 10 7.96875 10H9.53125C9.78906 10 10 10.2109 10 10.4688V12.0312C10 12.2891 9.78906 12.5 9.53125 12.5H7.96875C7.71094 12.5 7.5 12.2891 7.5 12.0312V10.4688ZM7.5 15.4688C7.5 15.2109 7.71094 15 7.96875 15H9.53125C9.78906 15 10 15.2109 10 15.4688V17.0312C10 17.2891 9.78906 17.5 9.53125 17.5H7.96875C7.71094 17.5 7.5 17.2891 7.5 17.0312V15.4688ZM2.5 10.4688C2.5 10.2109 2.71094 10 2.96875 10H4.53125C4.78906 10 5 10.2109 5 10.4688V12.0312C5 12.2891 4.78906 12.5 4.53125 12.5H2.96875C2.71094 12.5 2.5 12.2891 2.5 12.0312V10.4688ZM2.5 15.4688C2.5 15.2109 2.71094 15 2.96875 15H4.53125C4.78906 15 5 15.2109 5 15.4688V17.0312C5 17.2891 4.78906 17.5 4.53125 17.5H2.96875C2.71094 17.5 2.5 17.2891 2.5 17.0312V15.4688ZM15.625 2.5H13.75V0.625C13.75 0.28125 13.4688 0 13.125 0H11.875C11.5312 0 11.25 0.28125 11.25 0.625V2.5H6.25V0.625C6.25 0.28125 5.96875 0 5.625 0H4.375C4.03125 0 3.75 0.28125 3.75 0.625V2.5H1.875C0.839844 2.5 0 3.33984 0 4.375V6.25H17.5V4.375C17.5 3.33984 16.6602 2.5 15.625 2.5Z" fill="#1F1F1F" fill-opacity="0.945098"/>
                        </svg>
                    </span>
                    Reserve a table
                </a>
            </div>
            
        </div>
    </div>
</section>
@include('layouts.footer')
@endsection
