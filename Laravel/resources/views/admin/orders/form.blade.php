@extends('admin.layouts.app-master')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row clearfix page_header">
        <div class="col-md-6">
            <h2> {{ $headline }} </h2>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('admin/orders') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">{{ $headline }} ({{$order->order_number}})</h6> --}}
            <h6 class="m-0 font-weight-bold text-primary">{{ $headline }}</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    @if ($mode == 'edit')
                        {!! Form::model($order, [
                            'route' => ['orders.update', $order[0]->id],
                            'method' => 'put',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                    @else
                        {!! Form::open(['route' => 'orders.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label for="delivery_time" class="col-sm-3 col-form-label">Select delivery time <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="delivery_time" aria-label="Default select example" required>
                                <option selected>Select delivery time</option>
                                @foreach ($delivery_time as $key => $data)
                                <option value="{{ $data }}"
                                    @if (!empty($order)) @if ($order[0]->delivery_time == $key)
                                    {{ 'selected="selected"' }} @endif
                                    @endif
                                    >
                                    {{ $data }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin-country-dropdown" class="col-sm-3 col-form-label">Country <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <select name="billing_country_id" id="admin-country-dropdown" class="form-control">
                                <option value="">-- Select Country --</option>
                                @foreach ($countries as $data)
                                    <option value="{{ $data->id }}"
                                        @if (!empty($order)) @if ($order[0]->billing_country_id == $data->id)
                                        {{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin-state-dropdown" class="col-sm-3 col-form-label">State</label>
                        <div class="col-sm-9">
                            <select name="billing_state_id" id="admin-state-dropdown" class="form-control">
                                <option value="">-- Select State --</option>
                                @foreach ($states as $data)
                                    <option value="{{ $data->id }}"
                                        @if (!empty($order)) @if ($order[0]->billing_state_id == $data->id)
                                        {{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin-city-dropdown" class="col-sm-3 col-form-label">City </label>
                        <div class="col-sm-9">
                            <select name="billing_city_id" id="admin-city-dropdown" class="form-control">
                                <option value="">-- Select City --</option>
                                @foreach ($cities as $data)
                                    <option value="{{ $data->id }}"
                                        @if (!empty($order)) @if ($order[0]->billing_city_id == $data->id)
                                        {{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="billing_street" class="col-sm-3 col-form-label">Street <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="billing_street" name="billing_street"
                                placeholder="Street name and house number"
                                value=@if (!empty($order)) {{ $order[0]->billing_street }} @endif>
                             </div>
                    </div>
                    <div class="form-group row">
                        <label for="post_code" class="col-sm-3 col-form-label">Postal Code <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="post_code" name="billing_zip_code" placeholder="" required
                                value=@if (!empty($order)) {{ $order[0]->billing_zip_code }} @endif>
                             </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-3 col-form-label">Telephone <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="phone_number" name="billing_phone_number"
                                placeholder="Telephone"
                                value=@if (!empty($order)) {{ $order[0]->billing_phone_number }} @endif
                                required>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email Address <span
                                style="color:red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email_id" name="email_id"
                                placeholder="Email Address" required
                                value=@if (!empty($order)) {{ $order[0]->email_id }} @endif>
                        </div>
                    </div>
                    <div class="row checkout-page-check form-group">
                        <label class="col-sm-3 col-form-labe" for="exampleCheck1">Shipping to a different
                            address?</label>
                        <div class="col-sm-9">
                            <input type="checkbox" class="form-check-input shipping_detail"
                                name = "shipping_detail_checkbox" value ="shipping_detail" id="exampleCheck1">
                        </div>
                    </div>
                    <div class = "shipping_detail_div" id = "shipping_details" style = "display:none;">
                        <p><b> Shipping Details</b></p>
                        <div class="form-group row">
                            <label for="shipping_first-name" class="col-sm-3 col-form-label">First Name<span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shipping_first-name"
                                    name="shipping_first_name" placeholder="First name"
                                    value=@if (!empty($order)) {{ $order[0]->shipping_first_name }} @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_last-name" class="col-sm-3 col-form-label">Last Name<span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shipping_last-name"
                                    name="shipping_last_name" placeholder="Last name"
                                    value=@if (!empty($order)) {{ $order[0]->shipping_last_name }} @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin-shipping-country-dropdown" class="col-sm-3 col-form-label">Country <span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <select name="shipping_country_id" id="admin-shipping-country-dropdown"
                                    class="form-control">
                                    <option value="">-- Select Country --</option>
                                    @foreach ($countries as $data)
                                        <option value="{{ $data->id }}"
                                            @if (!empty($order)) @if ($order[0]->shipping_country_id == $data->id)
                                            {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin-shipping-state-dropdown" class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                                <select name="shipping_state_id" id="admin-shipping-state-dropdown" class="form-control">
                                    <option value="">-- Select State --</option>
                                    @foreach ($states as $data)
                                        <option value="{{ $data->id }}"
                                            @if (!empty($order)) @if ($order[0]->shipping_state_id == $data->id)
                                        {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin-shipping-city-dropdown" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                                <select name="shipping_city_id" id="admin-shipping-city-dropdown" class="form-control">
                                    <option value="">-- Select city --</option>
                                    @foreach ($cities as $data)
                                        <option value="{{ $data->id }}"
                                            @if (!empty($order)) @if ($order[0]->shipping_city_id == $data->id)
                                        {{ 'selected="selected"' }} @endif
                                            @endif
                                            >
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_address" class="col-sm-3 col-form-label">Street <span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shipping_address" name="shipping_street"
                                    placeholder="Street name and house number"
                                    value=@if (!empty($order)) {{ $order[0]->shipping_street }} @endif>
                                 </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_post_code" class="col-sm-3 col-form-label">Postal Code <span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shipping_post_code"
                                    name="shipping_zip_code" placeholder=""
                                    value=@if (!empty($order)) {{ $order[0]->shipping_zip_code }} @endif>
                                 </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_phone_number" class="col-sm-3 col-form-label">Telephone <span
                                    style="color:red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="shipping_phone_number"
                                    name="shipping_phone_number" placeholder="Telephone"
                                    value=@if (!empty($order)) {{ $order[0]->shipping_phone_number }} @endif>
                                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select type="text" name="status" id="status" class="form-control">
                                <option value="">None</option>
                                @foreach ($orderstatus as $status)
                                    <option value="{{ $status->id }}"
                                        @if (!empty($order)) @if ($order[0]->status == $status->id)
								{{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-3 col-form-label">notes</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="notes" name="notes"
                                placeholder="Enter Comments"
                                value=@if (!empty($order)) {{ $order[0]->notes }} @endif>
                             </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-3 col-form-label">Select Customer <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <select type="text" name="user_id" id="user_id" class="form-control">
                                <option value="">None</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if (!empty($order)) @if ($order[0]->user_id == $user->id)
								{{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $user->first_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="delivery_partner_id" class="col-sm-3 col-form-label">Select Delivery Partner <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <select type="text" name="delivery_partner_id" id="delivery_partner_id"
                                class="form-control">
                                <option value="">None</option>
                                @foreach ($deliverypartners as $deliverypartner)
                                    <option value="{{ $deliverypartner->id }}"
                                        @if (!empty($order)) @if ($order[0]->delivery_partner_id == $deliverypartner->id)
								{{ 'selected="selected"' }} @endif
                                        @endif
                                        >
                                        {{ $deliverypartner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-right"><button type="submit" class="btn btn-primary">Submit</button></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @if (!empty($orderItems))
        <div class="row clearfix page_header">
            <div class="col-md-6">
                <h2> Order Items </h2>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal"><i
                        class="fa fa-plus"></i> New Order Item</button>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ProductName</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td> {{ $item->title }} </td>
                                    <td> {{ $item->quantity }} </td>
                                    <td> {{ $item->price }} </td>
                                    <td> {{ $item->created_at }} </td>
                                    <td class="text-center">
                                        <form method="POST"
                                            action=" {{ route('admin.orders.orderitem.destroy', ['orderitemid' => $item->id]) }} ">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="w-px-500 p-3 p-md-3 needs-validation"
                        action="{{ route('admin.orders.orderitem.create') }}" method="post" role="form" novalidate>
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Order Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Product</label>
                                    <select class="form-control product" style="width: 70%;" name="product">
                                        <option value=""></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="quantity"
                                            placeholder="quantity" required>
                                        <input type="hidden" class="form-control" name="order_id"
                                            value="{{ $order[0]->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/admincountry.js') }}"></script>
@stop
