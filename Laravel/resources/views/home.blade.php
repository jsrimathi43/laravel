@extends('layouts.app')
  
@section('content')

<section class="daily-menu-section">
    <div class="container">
        <div class="row menu-section-image-block">
            <h3>Available Plans:</h3>
            @foreach( $productLimit as $productLimits )
                <div class="col-12 col-lg-3 col-md-6 image-block">
                  <!-- <div class="image-block-container">
                    <img src="/images/{{ $productLimits->image }}"  class="img-fluid" alt="DishImages">
                  </div> -->
                    <div class="caption p-3 text-center title-block">
                        <h4>{{ $productLimits->title }}</h4>
                        <p>Price: ${{ $productLimits->price }}</p>
                        <p>{{ $productLimits->description }}</p>
                        <button class=" btn btn-primary " >
                            <a href="{{ route('menu') }}" class="nav-link p-0" style="color:white" >
                                SubScribe
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
