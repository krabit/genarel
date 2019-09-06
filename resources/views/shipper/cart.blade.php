@extends('frontend.layouts.fashion')

@section('content')

    <h1>Đơn hàng vận chuyển của tôi</h1>

    <style type="text/css">
        #custom-cart .banner-bottom, .team, .checkout, .additional_info, .team-bottom, .single, .mail, .special-deals, .about, .faq, .typo, .new-products, .banner-bottom1, .top-brands, .dresses, .w3l_related_products {
            padding: 5em 0;
        }

        #custom-cart .checkout h3 {
            font-size: 1em !important;
            color: #212121;
            text-transform: uppercase;
            margin: 0 0 3em;
        }

        #custom-cart  .checkout h3 span {
            color: #ff9b05;
        }

        #custom-cart table{
            border-color: grey;
        }

        #custom-cart table.timetable_sub {
            width: 100%;
            margin: 0 auto;
        }

        #custom-cart .timetable_sub thead {
            background: #F2F2F2;
        }

        #custom-cart .timetable_sub th:nth-child(1) {
            border-left: 1px solid #C5C5C5;
        }

        #custom-cart .timetable_sub th, .timetable_sub td {
            text-align: center;
            padding: 7px;
            font-size: 14px;
            color: #212121;
        }

        #custom-cart.timetable_sub th {
            background: none;
            color: #212121 !important;
            text-transform: capitalize;
            font-size: 13px;
            border-right: 1px solid #C5C5C5;
            border-top: 1px solid #C5C5C5;
        }

        #custom-cart tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        #custom-cart .close1, .close2, .close3 {

            cursor: pointer;
            position: static !important;
            -webkit-transition: color 0.2s ease-in-out;
            -moz-transition: color 0.2s ease-in-out;
            -o-transition: color 0.2s ease-in-out;
            transition: color 0.2s ease-in-out;
        }

        #custom-cart .timetable_sub td {
            border: 1px solid #CDCDCD;
        }

        #custom-cart .checkout-left {
            margin: 2em 0 0;
        }

        #custom-cart .checkout-left-basket {
            float: left;
            width: 25%;
        }

        #custom-cart .checkout-left-basket h4 {
            padding: 1em;
            background: #ff9b05;
            font-size: 1.1em;
            color: #fff;
            text-transform: uppercase;
            text-align: center;
            margin: 0 0 1em;
        }

        #custom-cart .checkout-left-basket ul li {
            list-style-type: none;
            margin-bottom: 1em;
            font-size: 14px;
            color: #999;
        }

        #custom-cart .checkout-left-basket ul li span {
            float: right;
        }

        #custom-cart .checkout-left-basket ul li:last-child {
            font-size: 1em;
            color: #212121;
            font-weight: 600;
            padding: 1em 0;
            border-top: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
            margin: 2em 0 0;
        }

        #custom-cart .checkout-right-basket {
            float: right;
            margin: 8em 0 0 0em;
        }

        #custom-cart .checkout-right-basket a {
            padding: 10px 30px;
            color: #fff;
            font-size: 1em;
            background: #212121;
            text-decoration: none;
        }

    </style>
    <div id="custom-cart">
        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                <tr><th scope="row">#</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Chú ý </th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td scope="row">{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->customer_address .'-'.$order->customer_city }}</td>
                        <td>{{ $order->customer_note }}</td>
                        <?php $status = (isset($order->status) && $order->status==2) ? 'Đang vận chuyển':''?>
                        <td>{{$status}}</td>
                        <td>VND{{ number_format($order->total_price) }}</td>
                        <td>


                            <a href="{{ /*route('shipper/success/'.$order->id.'/finish')*/}}" class="btn btn-danger">Đã giao hàng</a>
                                <form id="logout-form" {{--action="{{ route('shipper/success/'.$order->id.'/finish')}}"--}} method="post" style="display: none;">
                                    @csrf
                                </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection
