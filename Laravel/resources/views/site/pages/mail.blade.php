<div class="h5" style="padding-left: 10px;">Order number : {{ $order[0]->order_number }}</div><br>
<div class="h5" style="padding-left: 10px;">As soon as your payment has been made, you will receive a separate
    notification and your order will be processed. </div><br>
<div class="h5" style="padding-left: 10px;">You may check the current status of your order with this link :<a
        href="{{$url}}/myaccount/ordersview/{{ $order[0]->ord_id }}">{{ $order[0]->order_number }}</a></div><br>
<div class="h5" style="padding-left: 10px;">You may use this link to edit your order, change the payment method or
    make additional payments.</div><br>
<div class="h5" style="padding-left: 10px;"><b>Information on your order:</b></div><br>
<div class="h5" style="padding-left: 10px;">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <th style = "text-align:left;">Product image</th>
            <th style = "text-align:left;">Product name</th>
            <th style = "text-align:left;">Quantities</th>
            <th style = "text-align:left;">Price</th>
        </tr>
        @php $total = 0 @endphp
        @php $quantity = 0 @endphp
        @foreach ($cart_products as $product)
            @php $total += $product['price'] * $product['quantity'] @endphp
            <tr>
                <td style = "padding-left: 10px;">
                    <img src="{{$url}}/images/{{ $product['image'] }}" width="50" height="50" class="img-fluid" alt="{{ $product['title'] }}">
                </td>
                <td style = "padding-left: 10px;">{{ $product['title'] }}</td>
                <td style = "padding-left: 10px;">{{ $product['quantity'] }}</td>
                <td style = "padding-left: 10px;">{{ $product['price'] * $product['quantity']}}</td>
            </tr>
        @endforeach
    </table>
</div>
</div><br>
<div class="h5" style="padding-left: 10px;">Shipping costs: 0.00</div><br>
<div class="h5" style="padding-left: 10px;">Total amount:{{ $total }}</div><br>
<div class="h5" style="padding-left: 10px;"><b>Billing address:</b></div><br>
<div class="h6" style="padding-left: 10px;">
    {{ $order[0]->billing_first_name }}<span></span>{{ $order[0]->billing_last_name }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_street }}</div>
@if(!empty($order[0]->billing_city_name))
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_city_name }}</div>
@endif
@if(!empty($order[0]->billing_state_name))
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_state_name }}</div>
@endif
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_county_name }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_zip_code }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->billing_phone_number }}</div><br>
<div class="h6" style="padding-left: 10px;"><b>Shipping address:</b></div><br>
<div class="h6" style="padding-left: 10px;">
    {{ $order[0]->shipping_first_name }}<span></span>{{ $order[0]->shipping_last_name }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_street }}</div>
@if(!empty($order[0]->shipping_city_name))
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_city_name }}</div>
@endif
@if(!empty($order[0]->shipping_state_name))
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_state_name }}</div>
@endif
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_county_name }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_zip_code }}</div>
<div class="h6" style="padding-left: 10px;">{{ $order[0]->shipping_phone_number }}</div>
<div class="h6" style="padding-left: 10px;"></div>
