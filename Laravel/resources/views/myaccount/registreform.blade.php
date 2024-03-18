 <h2 class="form-title">Register Here</h2>
<section class="signup">

    <div class="container">
        <div class="signup-content register-content">

            <form id="signup-form" class="signup-form" method="POST" action="{{ route('myaccount.register') }}">
                @csrf
                <div class="row">
                   
                    {{-- <div class="form-group">
                        <input type="text" class="form-input" value="{{ old('first_name') }}" name="first_name" id="name"
                            placeholder="Your Name" />
                    </div> --}}
                    <div class="col-12 col-lg-6 ship-inform mt-0">
                        <label for="first-name" class="form-label py-2">First Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="first-name" name="first_name" placeholder="First Name">
                        {{-- @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div class="col-12 col-lg-6 ship-inform mt-0">
                        <label for="last-name" class="form-label py-2">Last Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Last Name">
                        {{-- @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    {{-- <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="country" class="form-label py-2">Country <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  --}}
                    {{-- <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="address" class="form-label py-2">Street <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Street name and house number"> --}}
                        {{-- <input type="text" class="form-control mt-3" id="apartment" name="apartment" placeholder="Apartment, suite, room ect.(optional)"> --}}
                        {{-- @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="post_code" class="form-label py-2">Postal Code <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="post_code" name="post_code" placeholder="">
                        @error('post_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="city" class="form-label py-2">Location / City <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="">
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="phone_number" class="form-label py-2">Telephone <span style="color:red;">*</span></label>
                        <input type="tel" class="form-control" id="phone_number" name="phone" placeholder="Telephone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="email" class="form-label py-2">Email Address <span style="color:red;">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                        {{-- @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div class="fcol-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="Password" class="form-label py-2">Password<span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="Password" placeholder="Password">
                        {{-- @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    {{-- <div class="fcol-12 col-lg-6 ship-inform mt-0 pt-2">
                        <label for="confirm_password" class="form-label py-2">Confirm Password<span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="fcol-12 col-lg-6 ship-inform mt-0 pt-2">
                        <input type="submit" name="submit" id="submit" class="btn btn-dark fw-bold" style="background-color: #dd5902;border: none;" value="Register" />
                    </div>
                </div>
            </form>
            {{-- <p class="loginhere">
                Already have an account? <a href="{{ route('myaccount.login') }}" class="loginhere-link">Login here</a>
            </p> --}}
        </div>
    </div>
</section>
