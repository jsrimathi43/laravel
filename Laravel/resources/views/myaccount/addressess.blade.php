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
    <section class=" account-detail-section">
    <section class="container">
        <div class="row account-containers">
			            {{-- {{ $orderAddress }} --}}
             @include("myaccount.sidemenu")
		<div class="details-container-section content-orderaddress">
            <div class=" col-sm-4 orderaddress" id="content-orderaddress">
                <h2>Billing address</h2>
                <div class="card">
                    <div class="card-body">
                        @if (!empty($orderAddress[0]))
                        <p class="card-text">{{ $orderAddress[0]->billing_first_name }}
                            <span>{{ $orderAddress[0]->billing_last_name }}</span>
                        </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_street }} </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_city_name }} </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_state_name }} </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_county_name }} </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_zip_code }} </p>
                        <p class="card-text">{{ $orderAddress[0]->billing_phone_number }} </p>
                        <div>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('orderAddress.edit', ['orderAddress' => $orderAddress[0]->id]) }}">
                                <i class="fa fa-edit"> Edit </i>
                            </a>
                        </div>
                        @else
                        <p class="card-text"> You have not yet created an address of this type</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class=" col-sm-4 orderaddress">
                <h2>Shipping address</h2>
                <div class="card">
                    <div class="card-body">
                        @if (!empty($orderAddress[0]))
                        <p class="card-text">
                            @if ($orderAddress[0]->shipping_first_name != null)
                                {{ $orderAddress[0]->shipping_first_name }}
                                <span>{{ $orderAddress[0]->shipping_last_name }}</span>
                            @else
                                {{ $orderAddress[0]->billing_first_name }}
                                <span>{{ $orderAddress[0]->billing_last_name }}</span>
                            @endif
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_street ? $orderAddress[0]->shipping_street : $orderAddress[0]->billing_street }}
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_city_name ? $orderAddress[0]->shipping_city_name : $orderAddress[0]->billing_city_name }}
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_state_name ? $orderAddress[0]->shipping_state_name : $orderAddress[0]->billing_state_name }}
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_county_name ? $orderAddress[0]->shipping_county_name : $orderAddress[0]->billing_county_name }}
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_zip_code ? $orderAddress[0]->shipping_zip_code : $orderAddress[0]->billing_zip_code }}
                        </p>
                        <p class="card-text">
                            {{ $orderAddress[0]->shipping_phone_number ? $orderAddress[0]->shipping_phone_number : $orderAddress[0]->billing_phone_number }}
                        </p>
                        <div>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('myaccount.orderShippingAddress.edit', ['id' => $orderAddress[0]->id]) }}">
                                <i class="fa fa-edit"> Edit </i>
                            </a>
                        </div>
                        @else
                        <p class="card-text">You have not yet created an address of this type</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mb-3">
            <h2>New address</h2>
            @foreach ($addresses as $item)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                @if ($item->first_name != null)
                                    {{ $item->first_name }}
                                    <span>{{ $item->last_name }}</span>
                                @endif
                            </p>
                            <p class="card-text">
                                {{ $item->street }}
                            </p>
                            <p class="card-text">
                                {{ $city[0]->name }}
                            </p>
                            <p class="card-text">
                                {{ $state[0]->name }}
                            </p>
                            <p class="card-text">
                                {{ $country[0]->name }}
                            </p>
                            <p class="card-text">
                                {{ $item->post_code }}
                            </p>
                            <p class="card-text">
                                {{ $item->phone_number }}
                            </p>
                            {{ $item }}
                            <div>
                                <form method="post" action=" {{ route('myaccount.orderShippingAddupdate.update', ['id' => $item->id]) }} ">
                                    @csrf
                                    @method("post")
                                    <a class="btn btn-primary btn-sm" href="{{ route('myaccount.orderShippingAddupdate.update', ['id' => $item->id])}}"> 
                                        <input type="hidden" name="is_shipping" value="1">
                                        Set as shipping address
                                    </a><br/>
                                    <a class="btn btn-primary btn-sm" href="{{ route('myaccount.orderShippingAddupdate.update', ['id' => $item->id])}}"> 
                                        <input type="hidden" name="is_billing" value="1">
                                        Set as billing address
                                    </a>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach</div>

            <div>
                <a class="btn btn-primary" type="button" href="{{ route('orderAddress.create') }}"> <i class="fa fa-plus">Add new address </i> </a>
            </div>
        </div> --}}
    </section>
        </section>
    @include('layouts.footer')
@endsection
