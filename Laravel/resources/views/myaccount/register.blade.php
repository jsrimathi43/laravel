@extends('layouts.app')
  
@section('content')

<div class="container">
    @if (Session::has('success'))
            <div class="alert alert-success" style = "top:30px">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger" style = "top:30px">
                {{ Session::get('fail') }}
            </div>
        @endif
        @if ($errors->any())
        <div class = "alert alert-danger" style = "top:30px">
        @error('email')
           <span>{{ $message }}</span><br>
        @enderror
        @error('password')
        <span>{{ $message }}</span><br>
        @enderror
        @error('first_name')
        <span>{{ $message }}</span><br>
        @enderror
        @error('last_name')
        <span>{{ $message }}</span>
        @enderror
        </div>
        @endif
    <div class=" account-forms">
        <div class="col-lg-4  forms-area">
			   <h2 class="form-title">Login Here</h2>
            <div class="signup-content login-content">

                <form id="signup-form" class="signup-form" method="POST" action="{{ url('myaccount/login') }}">
                    @csrf
                    <!--    <img src="images/logo.svg" alt="">-->
                 
                    {{-- <div class="form-group">
                        <input type="email" class="form-input" value="{{ old('email') }}" name="email"
                            id="email" placeholder="Your Email" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password"
                            placeholder="Password" />
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div> --}}
                    <div class="col-12 col-lg-10 ship-inform mt-0">
                        <label for="email" class="form-label py-2">Email Address<span style="color:red;">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value = "{{ old('email') }}" placeholder="Email Address">
                    </div>
                    <div class="col-12 col-lg-10 ship-inform mt-0">
                        <label for="password" class="form-label py-2">Password<span style="color:red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    {{-- @error('email')
                        <div style="color: red">{{ $message }}</div>
                    @enderror
    
                    @error('password')
                        <div style="color: red">{{ $message }}</div>
                    @enderror --}}
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('user.password.request') }}">
                    {{ __('Forgot your password?') }}
                    </a>
                    <div class="fcol-12 col-lg-6 ship-inform mt-0 pt-2">
                        <input type="submit" name="submit" id="submit" class="btn btn-dark fw-bold form-submit" style="background-color: #dd5902;border: none;" value="Sign in" />
                    </div>
                </form>
                {{-- <p class="loginhere">
                    New User? <a href="{{route("myaccount.register")}}" class="loginhere-link">Register here</a>
                </p> --}}
            </div>
        </div>
        <div class="col-lg-8 forms-area">
            @include('myaccount.registreform')
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
