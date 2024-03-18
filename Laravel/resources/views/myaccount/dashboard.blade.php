@extends('layouts.app')
<style>
    #content-dashboard > a{
        color: #dd5903;
        text-decoration: none;
    }
</style>
  
@section('content')
    
    <section class="section account-detail-section" id="dashboard">
        <div class="container">
            <div class="row account-containers">
				@include("myaccount.sidemenu")
<div class="details-container-section">
                <div class="col-lg-8" id="content-dashboard">
                    @if (Auth::check())
                                Hello, {{Auth::user()->first_name}} {{ Auth::user()->last_name }}(not {{Auth::user()->first_name}} {{  Auth::user()->last_name }} 
                                <a href="{{ route('myaccount.logout') }}">Logout</a> )
                    @else
                        Login or register your account.
                    @endif
                    {{-- Hello {{Auth::user()->first_name}} {{  Auth::user()->last_name }} . --}}
                    <div class="sub-content" id="content-dashboard">
                        In your account overview, you can view your <a href="{{ url('myaccount/ordersview') }}">recent orders</a> , manage your.
                    </div>
                </div>
</div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
