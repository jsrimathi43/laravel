@extends('layouts.app')
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .star-rating-complete {
        color: #c59b08;
    }

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }

    .rated {
        float: left;
        height: 46px;
        /* padding: 0 10px; */
    }

    .rated:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffc700;
    }

    .rated:not(:checked)>label:before {
        content: '★ ';
    }

    .rated>input:checked~label {
        color: #ffc700;
    }

    .rated:not(:checked)>label:hover,
    .rated:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rated>input:checked+label:hover,
    .rated>input:checked+label:hover~label,
    .rated>input:checked~label:hover,
    .rated>input:checked~label:hover~label,
    .rated>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
@section('content')
    <section class="orderEdit account-detail-section">
        <div class="container">
            <div class="row account-containers">
                @include("myaccount.sidemenu")
                <div class="details-container-section"> 
                <div class="col-lg-8 order-details" id="content-ordersedit">
                    <p>An order #<b>{{ $order->order_number }} </b> from the <b>{{ $order->created_at }}</b> is actual <b> {{ $ord_deldet[0]->status_name }} </b>.</p>
                    <h2>Order details</h2>
                    <div class="table-responsive">
                      <div class="table-container">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th>Product</th>
                                  <th>Total</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>{{ $order->order_number }}</td>
                                  <td> {{ $order->grand_total }}</td>
                              </tr>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>Subtotal:</th>
                                  <th>{{ $order->grand_total }}</th>
                              </tr>
                              <tr>
                                  <th>Payment method: </th>
                                  <th>{{ $order->payment_method }}</th>
                              </tr>
                              <tr>
                                  <th>In total:</th>
                                  <th>{{ $order->grand_total }}</th>
                              </tr>
                          </tfoot>
                      </table>
                      </div>
                    </div>
                </div>
              </div>
            </div>

        </div>
    </section>
    @include('layouts.footer')
@endsection
