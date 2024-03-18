@extends('admin.layouts.app-master')
@section('content')

    <div class="row clearfix page_header">
        <div class="col-md-6">
            <h2> {{ $headline }} </h2>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('admin/orders') }}"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a>
            <a class="btn btn-primary" target= "_blank" href="{{ route('admin.orders.view_invoice', ['id' => $orders[0]->id]) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View Invoice </a>
            <a class="btn btn-primary" href="{{ route('admin.orders.download_invoice', ['id' => $orders[0]->id]) }}"> <i class="fa fa-download" aria-hidden="true"></i> Download Invoice </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Order Details </h6>
        </div>

        <div class="card-body">
            <div class="row clearfix justify-content-md-center">
                <div class="col-md-8">
                    <table class="table table-borderless table-striped">
                        <tr>
                            <th class="text-right">OrderNumber:</th>
                            <td> {{ $orders[0]->order_number }} </td>
                        </tr>
                        <tr>
                            <th class="text-right">Customer Name : </th>
                            <td> {{ $orders[0]->customer_first_name }}  {{ $orders[0]->customer_last_name }} </td>
                        </tr>
                        <tr>
                            <th class="text-right">delivery Partner Name : </th>
                            <td> {{ $orders[0]->delivery_partner_name }} </td>
                        </tr>
                        <tr>
                            <th class="text-right">Payment Mehod : </th>
                            <td> Cash on delivery </td>
                        </tr>
                        <tr>
                            <th class="text-right">Address : </th>
                            <td> {{ $orders[0]->billing_street }} {{ $orders[0]->city_name }} {{ $orders[0]->state_name }} {{ $orders[0]->country_name }} {{ $orders[0]->billing_zip_code }} </td>
                        </tr>
                        <tr>
                            <th class="text-right">Order Created Date : </th>
                            <td> {{ $orders[0]->created_at }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($orderItems))
        <div class="row clearfix page_header">
            <div class="col-md-6">
                <h2> Order Items </h2>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td> {{ $item->title }} </td>
                                    <td> {{ $item->quantity }} </td>
                                    <td> {{ $item->price }} </td>
                                    <td> {{ $item->created_at }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    @stop
