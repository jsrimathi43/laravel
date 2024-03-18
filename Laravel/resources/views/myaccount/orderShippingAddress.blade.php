@extends('layouts.app')

@section('content')
<section class="about-us-page-section">
    <div class="container-fluid">
        <div class="row about-page-banner">
            <div class="col-12 col-lg-12 px-0 about-page-banner-img">
                <img src="{{ asset("img/restaurant-about-bg1.png") }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="about-page-banner-text">
        <h2 class="">My Account</h2>
    </div>
</section>
<section class="account-detail-section">
    <section class="container">
        <div class="row account-containers">       
					@include("myaccount.sidemenu")
                    <div class="col-md-8 ordershippingaddress" id="content-ordershippingaddress">
						            <h4>Order Shipping Address</h4>
                        @if ($mode == 'edit')
                            {!! Form::model($orderAddressEdit, [
                                'route' => ['orderAddress.update', $orderAddressEdit[0]->id],
                                'method' => 'put',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                        {{-- @else
                            {!! Form::open(['route' => 'orderAddress.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!} --}}
                        @endif
                        <div class="form-group row">
                            <input type="hidden" name="id" value="{{ $orderAddressEdit[0]->order_addressesID }}">
                            <input type="hidden" name="orderAddressesType" value="shipping">
                            <label for="shipping_first_name" class="col-sm-3 col-form-label">First name <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                {{ Form::text('shipping_first_name', old('shipping_first_name', ($orderAddressEdit[0]->shipping_first_name ? $orderAddressEdit[0]->shipping_first_name : $orderAddressEdit[0]->billing_first_name)), ['class' => 'form-control', 'id' => 'shipping_first_name', 'placeholder' => 'Enter your first name']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_last_name" class="col-sm-3 col-form-label">Last name <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                {{ Form::text('shipping_last_name', old('shipping_last_name', ($orderAddressEdit[0]->shipping_last_name ? $orderAddressEdit[0]->shipping_last_name : $orderAddressEdit[0]->billing_last_name)), ['class' => 'form-control', 'id' => 'shipping_last_name', 'placeholder' => 'Enter your last name']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_street" class="col-sm-3 col-form-label">Street <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                {{ Form::text('shipping_street', old('shipping_street', ($orderAddressEdit[0]->shipping_street ? $orderAddressEdit[0]->shipping_street : $orderAddressEdit[0]->billing_street)), ['class' => 'form-control', 'id' => 'shipping_street', 'placeholder' => 'shipping_street']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shipping_city_id" class="col-sm-3 col-form-label">City <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <select type="text" name="shipping_city_id" id="shipping_city_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if (!empty($orderAddressEdit)) @if ($orderAddressEdit[0]->shipping_city_id == $city->id)
                                            {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_state_id" class="col-sm-3 col-form-label">State <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <select type="text" name="shipping_state_id" id="shipping_state_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            @if (!empty($orderAddressEdit)) @if ($orderAddressEdit[0]->shipping_state_id == $state->id)
                                    {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_country_id" class="col-sm-3 col-form-label">Country <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                <select type="text" name="shipping_country_id" id="shipping_country_id"
                                    class="form-control">
                                    <option value="">None</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            @if (!empty($orderAddressEdit)) @if ($orderAddressEdit[0]->shipping_county_id == $country->id)
                                    {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_zip_code" class="col-sm-3 col-form-label">Post Code <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                {{ Form::text('shipping_zip_code', old('shipping_zip_code', ($orderAddressEdit[0]->shipping_zip_code ? $orderAddressEdit[0]->shipping_zip_code : $orderAddressEdit[0]->billing_zip_code)), ['class' => 'form-control', 'id' => 'shipping_zip_code', 'placeholder' => 'Postal code']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_phone_number" class="col-sm-3 col-form-label">PhoneNumber <span
                                    class="text-danger">*</span> </label>
                            <div class="col-sm-9">
                                {{ Form::text('shipping_phone_number', old('shipping_phone_number', ($orderAddressEdit[0]->shipping_phone_number ? $orderAddressEdit[0]->shipping_phone_number : $orderAddressEdit[0]->billing_phone_number)), ['class' => 'form-control', 'id' => 'shipping_phone_number', 'placeholder' => 'phone number']) }}
                            </div>
                        </div>

                        <div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
                        {!! Form::close() !!}
                    </div>
        </div>
    </section>
  </section>
    @include('layouts.footer')
@endsection
