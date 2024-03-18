@extends('layouts.app')
  
@section('content')
<section class="signup">

    <div class="container">
        <div class="signup-content">

            <form id="signup-form" class="signup-form" method="POST" action="{{ url('myaccount/login') }}">
                @csrf
                <!--    <img src="images/logo.svg" alt="">-->
                <h2 class="form-title">Login Here</h2>
                {{-- <div class="form-group">
                    <input type="email" class="form-input" value="{{ old('email') }}" name="email"
                        id="email" placeholder="Your Email" />
                </div> --}}
                <div class="col-12 col-lg-6 ship-inform mt-0">
                    <label for="email" class="form-label py-2">E-mail address<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value = "{{ old('email') }}" placeholder="Your Email">
                </div>
                <div class="col-12 col-lg-6 ship-inform mt-0">
                    <label for="password" class="form-label py-2">Password<span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                </div>
                {{-- <div class="form-group">
                    <input type="password" class="form-input" name="password" id="password"
                        placeholder="Password" />
                    <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                </div> --}}
                @error('email')
                    <div style="color: red">{{ $message }}</div>
                @enderror

                @error('password')
                    <div style="color: red">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in" />
                </div>
            </form>
            {{-- <p class="loginhere">
                New User? <a href="{{route("myaccount.register")}}" class="loginhere-link">Register here</a>
            </p> --}}
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection