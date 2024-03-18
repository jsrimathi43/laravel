@extends('layouts.app')

@section('content')

    <section class="daily-menu-section1">
        <div class="container">
            <div class="row daily-menu-card">
                <div class="container">
                    
                    <div class=" daily-menu-card-body">
                        <div class="col-12 col-lg-7 pt-3 menu-card-info">
                            <div class="menu-details-container">
                                @foreach ($products as $product)
                                    <div class="d-flex pt-5 flex-column menu-details">
                                        <div class="card menu-card-view mt-3">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <span class="menu-title">
                                                    {{ $product->title }}
                                                </span>
                                                <span class="menu-price">
                                                    <li class="nav-item">€{{ $product->price }}</li>
                                                    <a href="{{ route('add.to.cart', $product->id) }}"
                                                        class="btn btn-primary">+</a>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $product->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 pt-3 menu-card-price-info">
                            @if (session('cart'))
                                <div class="menu-card-price-info-cards">
                                    <div class="card price-card">
                                        <div class="card-body price-card-body p-4">
                                            <input type = "hidden" id = "deleteUrl"
                                                value = "{{ route('product.remove.from.cart') }}">
                                            <input type = "hidden" id = "updateUrl"
                                                value = "{{ route('product.update.cart') }}">
                                            <input type = "hidden" id = "csrf" value = "{{ csrf_token() }}">
                                            <table
                                                class="table table-sm table-borderless table-responsive price-card-tbl mb-0">
                                                <thead class="price-card-tbl-head">
                                                    <tr class="tbl-title">
                                                        <th scope="col"></th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Preis</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbl-body">
                                                    @php $total = 0 @endphp
                                                    @if (session('cart'))
                                                        @foreach (session('cart') as $id => $details)
                                                            {{-- @php print_r($details) @endphp --}}
                                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                                            <tr class="tbl-row">
                                                                <th scope="row" data-id="{{ $id }}">
                                                                    <button
                                                                        class="btn btn-danger btn-sm remove-from-cart"><i
                                                                            class="fa fa-trash-o"></i></button>
                                                                </th>
                                                                <td scope="row">
                                                                    {{ $details['title'] }}
                                                                </td>
                                                                <td>€{{ $details['price'] }}</td>
                                                                <td class="tbl-row-priceD" data-id="{{ $id }}">
                                                                    <input type="number" id="quantity"
                                                                        class="quantity update-cart"
                                                                        value="{{ $details['quantity'] }}" min="0" disabled>
                                                                </td>
                                                                <td>€{{ $details['price'] * $details['quantity'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card menu-card-total mt-3">
                                        <p class="card-total-heading">Cart Totals</p>
                                        <div
                                            class="card-body card-total-price-body d-flex align-items-center justify-content-between">
                                            <span class="menu-title">
                                                Total
                                            </span>
                                            <span class="menu-price">
                                                €{{ $total }}
                                            </span>
                                        </div>
                                        <div class="card-body prcd-checkout">
                                            @php $login_route = 0 @endphp
                                            @if (Auth::check())
                                                @php $login_route = 1 @endphp
                                            @endif
                                            <a href= "{{ $login_route ? route('checkout.index') : route('myaccount.register') }}"
                                                class="d-flex justify-content-center btn btn-warning">
                                                Proceed to checkout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card menu-card-total mt-3" style="border-top:5px solid #dd5903;">
                                    <p class="card-total-heading">Your shopping cart is currently empty.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-------------------------------- End Daily Menu page section --------------------------------------->
    @include('layouts.footer');
    {{-- @section('scripts') --}}
    <script type="text/javascript" src="{{ asset('js/menu.js') }}"></script>
    {{-- @endsection --}}
@endsection
