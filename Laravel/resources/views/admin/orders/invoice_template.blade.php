<?php
$admin_email = config('app.admin_email');
$admin_mobile = config('app.admin_mobile');
$shop_address = config('app.shop_address');
?>
<link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    body {
        width: 100% !important;
        font-size: 12px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }

    * {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
    }

    .container {
        width: 700px;
    }

    .outer_border {
        border: 1px solid #999999 !important;
        padding: 4% !important;
        margin-bottom: 2% !important;
    }

    .top_box {
        width: 45%;
        padding: 0%
    }

    .table_pad {
        padding: 0% 2%;
    }

    .border {
        border: 1px solid #CCCCCC !important;
    }

    .small_text {
        font-size: 10px !important;
    }

    .bg_color1 {
        background: #3a5082;
        color: #fff;
    }

    .text_color1 {
        color: #3a5082;
    }

    td {
        padding: 3px;
    }
</style> 
<div class="container">
    <div class="outer_border">
        <div class="row">
            <div class=" pull-left top_box   p-4">
                <h2 class="text_color1" style="font-size:30px">{{ config('app.name') }}</h2> {{ $shop_address }}
                Phone : {{ $admin_mobile }}
                Email : {{ $admin_email }}
                Website : {{ config('app.url') }}
            </div>
            <div style="" class=" pull-right top_box   p-4">
                <h2 style="color:#687cbf;font-weight: bold;font-size:30px; text-align:right; padding-right: 30px;"
                    id="invoice">INVOICE</h2>
                <table width="100%" height="50" border="0" class="table_pad">
                    <tr>
                        <td> Date</td>
                        <td> <?php $invoice_date = date('jS F Y', strtotime($order[0]->created_at));
                        echo $invoice_date;
                        ?> </td>
                    </tr>
                    <tr>
                        <td width="40%">Invoice #</td>
                        <td width="40%">{{ $order[0]->order_number }}</td>
                    </tr>
                    <tr>
                        <td>Customer ID</td>
                        <td>{{ $order[0]->user_id }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="">
                <table width="100%" border="0">
                    <tr>
                        <td colspan="2">
                            <div class="bg_color1"
                                style="text-indent:10px;font-size: 14px;width: 50%;height: 26px;line-height: 24px; ">
                                BILL TO </div>
                            <table width="100%" border="0">
                                <tr>
                                    <td width="18%">Name</td>
                                    <td width="82%"> {{ $order[0]->billing_first_name }} {{ $order[0]->billing_last_name }} </td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{ $order[0]->billing_phone_number }}</td>
                                </tr>
                                <tr>
                                    <td> Address</td>
                                    <td> {{ $order[0]->billing_street }} ,
                                        {{ $order[0]->city_name }},
                                        {{ $order[0]->state_name }},
                                        {{ $order[0]->country_name }},
                                        {{ $order[0]->billing_zip_code }}, </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> </td>
                    </tr>
                </table>
            </div>
        </div>
        <dd style="clear:both;"></dd>
        <div class="row">
            <table height="82" class=" " style=" width:100%;">
                <tr class="bg_color1">
                    <td width="58%" height="12" style="padding-left: 10px;">DESCRIPTION</td>
                    <td width="13%"> </td>
                    <td style="padding-right: 10px;" width="15%" align="right">AMOUNT</td>
                </tr>
                @php $total = 0 @endphp
                @foreach ($orderItems as $order_item)
                @php $total = $order_item->price * $order_item->quantity @endphp
                    <tr class=" ">
                        <td> {{ $order_item->title }}
                            € {{ $order_item->price }} X {{ $order_item->quantity }} </td>
                        <td> </td>
                        <td align="right">€ {{$total}}</td>
                    </tr>
                @endforeach
                <tr class=" ">
                    <td> </td>
                    <td> <strong>Total</strong> </td>
                    <td align="right">€ {{ $order[0]->grand_total }}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div style="text-align:center"> If you have any question about this invoice, please contact <br />
                {{ config('app.name') }}, {{ $admin_mobile }}, {{ $admin_email }}<br /> <b>Thank You For Your
                    Business!</b> </div>
        </div>
    </div>
</div>
