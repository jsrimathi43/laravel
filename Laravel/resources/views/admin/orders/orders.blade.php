@extends('admin.layouts.app-master')

@section('content')

    <div class="row clearfix page_header">
        <div class="col-md-6">
            <h2> Orders </h2>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-info" href="{{ route('orders.create') }}"> <i class="fa fa-plus"></i> New Orders </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>OrderNumber</th>
                            <th>Customer Name</th>
                            <th>Billing Address</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Delivery_partner</th>
                            <th>Order Date</th>
                            <th class="text-right" style = "width:10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td> {{ $order->order_number }} </td>
                                <td> {{ $order->billing_last_name }}  {{ $order->billing_first_name }} </td>
                                <td> {{ $order->billing_street }},{{ $order->billing_city_name }},{{ $order->billing_state_name }},{{ $order->billing_county_name }},{{ $order->billing_zip_code }}
                                </td>
                                <td> {{ $order->grand_total }} </td>
                                <td> {{ $order->status_name }} </td>
                                <td> {{ $order->delivery_partner_name }} </td>
                                <td> {{ $order->order_date }} </td>
                                <td class="text-right">
                                    <form method="POST"
                                        action=" {{ route('orders.destroy', ['order' => $order->ord_id]) }} ">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('orders.show', ['order' => $order->ord_id]) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('orders.edit', ['order' => $order->ord_id]) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
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
@stop
