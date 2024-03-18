@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            <h4>Additional Address</h4>
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    {!! Form::open([ 'route' => 'orderAddress.store', 'method' => 'post', "enctype" => "multipart/form-data" ]) !!} 
                    <div class="form-group row">
                            
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        {{-- <input type="hidden" name="addressable_id" value="{{ Auth::id() }}"> --}}
                        <input type="hidden" name="orderAddressesType" value="create">
                        <label for="first_name" class="col-sm-3 col-form-label">First name <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('first_name', NULL, [ 'class'=>'form-control', 'id' => 'first_name', 'placeholder' => 'Enter your billing first name' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">Last name <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('last_name', NULL, [ 'class'=>'form-control', 'id' => 'last_name', 'placeholder' => 'Enter your billing last name' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street" class="col-sm-3 col-form-label">Street <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('street', NULL, [ 'class'=>'form-control', 'id' => 'street', 'placeholder' => 'street' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street_extra" class="col-sm-3 col-form-label">Additional address <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('street_extra', NULL, [ 'class'=>'form-control', 'id' => 'street_extra', 'placeholder' => 'Additional address' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-sm-3 col-form-label">City <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <select type="text" name="city" id="city" class="form-control">
                                <option value="">None</option>
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}" {{'selected="selected"'}}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-sm-3 col-form-label">State <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <select type="text" name="state" id="state" class="form-control">
                                <option value="">None</option>
                                @foreach ($states as $state)
                                <option value="{{$state->id}}" {{'selected="selected"'}}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country_id" class="col-sm-3 col-form-label">Country <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <select type="text" name="country_id" id="country_id" class="form-control">
                                <option value="">None</option>
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}" {{'selected="selected"'}}>
                                    {{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_code" class="col-sm-3 col-form-label">Post Code <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('post_code', NULL, [ 'class'=>'form-control', 'id' => 'post_code', 'placeholder' => 'Postal code' ]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-3 col-form-label">PhoneNumber <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            {{ Form::text('phone_number', NULL, [ 'class'=>'form-control', 'id' => 'phone_number', 'placeholder' => 'phone number' ]) }}
                        </div>
                    </div>
                    
                    <div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection