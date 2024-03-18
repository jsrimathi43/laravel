@extends('layouts.app')
@section('content')


    <section class="checkout-page-section">
        <div class="container">
            <form class="checkout-page-form" action="{{ route('checkout.place.order') }}" method="POST" role="form">
                @csrf
                <div class="row checkout-page-sec">
                    <div class="col-12 col-lg-7 checkout-page-body">
                        <div class="card your-order-card">
                            <div class="card-body p-4 your-order-body">
                                <div class="row g-3 checkout-page-cnt">
                                    <p>Billing Details</p>
                                    <div class="col-12 col-lg-6 ship-inform mt-0">
                                        <label for="first-name" class="form-label py-2">First Name<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="first-name" name="billing_first_name"
                                            placeholder="First name" onkeypress="return event.charCode != 32" required>
                                    </div>
                                    <div class="col-12 col-lg-6 ship-inform mt-0">
                                        <label for="last-name" class="form-label py-2">Last Name<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="last-name" name="billing_last_name"
                                            placeholder="Last name" onkeypress="return event.charCode != 32" required>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="country-dropdown" class="form-label py-2">Country <span
                                                style="color:red;">*</span></label>
                                        <select name="billing_country_id" id="country-dropdown" class="form-select" required>
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="state-dropdown" class="form-label py-2">State</label>
                                        <select name="billing_state_id" id="state-dropdown" class="form-select">
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="city-dropdown" class="form-label py-2">City</label>
                                        <select name="billing_city_id" id="city-dropdown" class="form-select">
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="address" class="form-label py-2">Street <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="address" name="billing_street"
                                            placeholder="Street name and house number" onkeypress="return event.charCode != 32" required>
                                  </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="post_code" class="form-label py-2">Postal Code <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="post_code"
                                            name="billing_zip_code" placeholder="" onkeypress="return event.charCode != 32" required>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="phone_number" class="form-label py-2">Telephone <span
                                                style="color:red;">*</span></label>
                                        <input type="tel" class="form-control" id="phone_number"
                                            name="billing_phone_number" placeholder="Telephone" onkeypress="return event.charCode != 32" required>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="email" class="form-label py-2">Email Address <span
                                                style="color:red;">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email_id"
                                            placeholder="Email Address" onkeypress="return event.charCode != 32" required>
                                    </div>
                                </div>
                                <div class="row checkout-page-check" style = "padding:35px;">
                                    <div class="form-check">
                                        <label class="form-check-label" for="exampleCheck1">Shipping to a different
                                            address?</label>
                                        <input type="checkbox" class="form-check-input shipping_detail"
                                            name = "shipping_detail_checkbox" value ="shipping_detail"
                                            id="exampleCheck1">
                                    </div>
                                </div>
                                <div class = "shipping_detail_div" id = "shipping_details" style = "display:none;">
                                    <p>Shipping Details</p>
                                    <div class="col-12 col-lg-6 ship-inform mt-0">
                                        <label for="shipping_first-name" class="form-label py-2">First Name<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="shipping_first-name"
                                            name="shipping_first_name" placeholder="First name" onkeypress="return event.charCode != 32">
                                    </div>
                                    <div class="col-12 col-lg-6 ship-inform mt-0">
                                        <label for="shipping_last-name" class="form-label py-2">Last Name<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="shipping_last-name"
                                            name="shipping_last_name" placeholder="Last name" onkeypress="return event.charCode != 32">
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping-country-dropdown" class="form-label py-2">Country <span
                                                style="color:red;">*</span></label>
                                        <select name="shipping_country_id" id="shipping-country-dropdown"
                                            class="form-select">
                                            <option value="">-- Select Country --</option>
                                            @foreach ($countries as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping-state-dropdown" class="form-label py-2">State</label>
                                        <select name="shipping_state_id" id="shipping-state-dropdown"
                                            class="form-select">
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping-city-dropdown" class="form-label py-2">City</label>
                                        <select name="shipping_city_id" id="shipping-city-dropdown" class="form-select">
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping_address" class="form-label py-2">Street <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="shipping_address"
                                            name="shipping_street" placeholder="Street name and house number" onkeypress="return event.charCode != 32">
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping_post_code" class="form-label py-2">Postal Code <span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="shipping_post_code"
                                            name="shipping_zip_code" placeholder="" onkeypress="return event.charCode != 32">
                                    </div>
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="shipping_phone_number" class="form-label py-2">Telephone <span
                                                style="color:red;">*</span></label>
                                        <input type="tel" class="form-control" id="shipping_phone_number"
                                            name="shipping_phone_number" placeholder="Telephone" onkeypress="return event.charCode != 32">
                                    </div>
                                </div>
                                <div class="row checkout-page-cnt">
                                    <div class="col-12 col-lg-12 ship-inform mt-0 pt-2">
                                        <label for="order" class="form-label py-2">Order comments (optional)</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="5" placeholder="Enter your message here"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 checkout-your-order">
                        <div class="checkout-your-order-container">
                            <div class="card your-order-card">
                                <div class="card-body p-4 your-order-body">
                                    <h5 class="py-3 text-center">Your Order</h5>
                                    <table class="table table-sm table-borderless table-responsive mb-0 your-order-table">
                                        <thead>
                                            <tr class="tbl-title">
                                                <th scope="col" class="text-center">Product</th>
                                                <th scope="col" class="text-center">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="your-order-tbody">
                                            @php $total = 0 @endphp
                                            @php $quantity = 0 @endphp
                                            @if (session('cart'))
                                                @foreach (session('cart') as $id => $details)
                                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                                    @php $quantity = $quantity + $details['quantity'] @endphp
                                                    <tr class="your-order-row">
                                                        <td scope="row" class="text-center">
                                                            {{ $details['title'] }}*{{ $details['quantity'] }}</td>
                                                        <td class="text-center">€{{ $details['price'] * $details['quantity'] }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr class="your-order-row2">
                                                    <td scope="row" class="text-center">Sub Total</td>
                                                    <td class="text-center">€{{ $total }}</td>
                                                    <input type = "hidden" id = "sub_total" name = "sub_total"
                                                        value={{ $total }}>
                                                    <input type = "hidden" id = "quantity" name = "quantity"
                                                        value={{ $quantity }}>
                                                </tr>
                                                <tr class="your-order-row2">
                                                    <td scope="row" class="text-center">Shipping</td>
                                                    <td class="text-center">€0.00</td>
                                                </tr>
                                                <tr class="your-order-row2">
                                                    <td scope="row" class="text-center">Total Amount</td>
                                                    <td class="text-center">€{{ $total }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card cash-on mt-4">
                                <div class="card-body cash-on-body">
                                    {{-- <form class="cash-on-form"> --}}
                                    <div class="row cash-on-content">
                                        <div class="col-12 col-lg-12 mt-0 pt-2 cash-on-delivery">
                                            <div class="form-check cash-deli" href="#cashDelivery">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    value="cash_on_delivery" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Cash on delivery
                                                </label>
                                            </div>
                                            <div class="form-control" id="cashDelivery">
                                                <div class="card card-body">
                                                    Pay with cash upon delivery.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12 mt-0 pt-2 cash-on-delivery">
                                            <div class="form-check">
                                                <input type='hidden' name='stripeToken' id='flexRadioDefault1'> 
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    value = "stripe" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Stripe
                                                </label>                             
                                                <br>
                                                <div id="card-element" class="form-control" ></div>
                                            </div>
                                        </div>
                                            <p class="privacy-body py-3">
                                                Your personal information will be used to process your order, support your
                                                experience on this website and for other
                                                purposes described in our <span class="privacy-cnt">privacy policy.</span>
                                            </p>
                                            <button type="submit"
                                                class="order-btn btn btn-success btn-lg btn-block" id="pay-btn">Place
                                                Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    @include('layouts.footer');
    <script type="text/javascript" src="{{ asset('js/country.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    
@stop
