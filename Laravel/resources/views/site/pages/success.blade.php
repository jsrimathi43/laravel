@extends('layouts.app')
<style>
    .order-address-details {
        background-color: #F7F7F7;
        border-color: #F7F7F7;
        /* border:none; */
    }

    .order_address .card {
        border: none;
    }
</style>
@section('content')
    
    <section class="about-us-page-section">
              <div class="about-page-banner-text">
                <h2 class="">Thank you for your order</h2>
            </div>
    </section>
                    
    <section class="container order-checkout-page-section">
		<h5 class=" text-center thankyou-content " >We thank you. Your order has been received.</h5>
        <div class = "row sucess-order-details">
            <section class = "text-center sucess-order-details-container">
                <h5>order Number</h5>
                <p> {{ $order[0]->order_number }}
                <p>
            </section>
            <section class = "text-center sucess-order-details-container">
                <h5>Date Of Order</h5>
                <p> {{ $order[0]->created_at }}
                <p>
            </section>
            <section class = "text-center sucess-order-details-container">
                <h5>Order Email</h5>
                <p> {{ $order[0]->email_id }}
                <p>
            </section>
            <section class = "text-center sucess-order-details-container">
                <h5>Payment Method</h5>
                <p> {{ $order[0]->payment_method }}
                <p>
            </section>
        </div>

        <div class="container  order-details-container">
			        <h5 class="py-3 text-center order-details-heading">Order Details</h5>
            <form class="checkout-page-form" action="{{ route('checkout.place.order') }}" method="POST" role="form">
                @csrf
                <div class="row checkout-page-sec">
                    <div class="col-12 col-lg-20 checkout-your-order">
                        <div class="card your-order-card">
                            <div class="card-body your-order-body">
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
                                        @foreach ($cart_products as $product)
                                            @php $total += $product['price'] * $product['quantity'] @endphp
                                            @php $quantity = $quantity + $product['quantity'] @endphp
                                            <tr class="your-order-row">
                                                <td scope="row" class="text-center">
                                                    {{ $product['title'] }}*{{ $product['quantity'] }}</td>
                                                <td class="text-center">€{{ $product['price'] }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="your-order-row2 order-details">
                                            <td scope="row" class="text-center">Sub Total</td>
                                            <td class="text-center">€{{ $total }}</td>

                                        </tr>
                                        <tr class="your-order-row2 order-details">
                                            <td scope="row" class="text-center">Shipping</td>
                                            <td class="text-center">€0.00</td>
                                        </tr>
                                        <tr class="your-order-row2 order-details">
                                            <td scope="row" class="text-center">Total Amount</td>
                                            <td class="text-center">€{{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-------------------------------- End Checkout page section --------------------------------------->

    @include('layouts.footer');
    <script type="text/javascript" src="{{ asset('js/country.js') }}"></script>
@stop
