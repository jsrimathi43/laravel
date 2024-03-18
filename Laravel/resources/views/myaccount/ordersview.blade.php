@extends('layouts.app')

@section('content')
    <section class="orderView account-detail-section">
        <div class="container">
            <div class="row account-containers">
                @include('myaccount.sidemenu')
                <div class = "details-container-section">
                    <div class="col-lg-8 " id="content-ordersview">
                        <div class="table-responsive">
                            @if (Auth::check())
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ORDER</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th>TOTAL</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($orders))
                                            @forelse ($orders as $item)
                                                @if (strtolower($item->status_name) != 'cancelled')
                                                    <tr>
                                                        <td>{{ $item->order_number }}</td>
                                                        <td> {{ date($item->created_at) }} </td>
                                                        <td>{{ $item->status_name }}</td>
														<td>{{ $item->grand_total }}</td>
                                                        <td class="text-right">

                                                            <form method="POST"
                                                                action=" {{ route('myaccount.ordersview.update', ['id' => $item->id]) }} ">
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('myaccount.ordersview.edit', ['id' => $item->id]) }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                @csrf
                                                                @method('PUT')
                                                                <button
                                                                    onclick="return confirm('Are you sure you want to cancel this order?')"
                                                                    type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-solid fa-ban"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">{{ "No order has been placed yet" }}</td>
                                        </tr>
                                    @endforelse
                                        @else
                                            <p> No order found</p>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $orders->links() }}
                            @else
                                <p>No orders yet or please login</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
