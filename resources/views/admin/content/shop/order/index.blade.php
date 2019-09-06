@extends('admin.layouts.glance')
@section('title')
    Quản trị đơn hàng
@endsection
@section('content')
    <h1> Quản trị đơn hàng</h1>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng số</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->customer_address.'-'.$order->customer_city }}</td>
                        <td><?php $status = $order->status; ?>
                            @switch($status)
                                @case(0)
                                Chưa thanh toán và đang chờ vận chuyển
                                @break

                                @case(1)
                                Đã thanh toán và đang chờ vận chuyển
                                @break

                                @case(2)
                                Đang vận chuyển
                                @break

                                @case(3)
                                Đã giao hàng
                                @break

                                @case(4)
                                Hủy đơn
                                @break

                            @endswitch
                        </td>
                        <td>VND{{number_format($order->total_price)}}</td>
                        <td>
                            <a href="{{ url('admin/shop/order/'.$order->id.'/edit') }}" class="btn btn-warning">Sửa</a>
                            <a href="{{ url('admin/shop/order/'.$order->id.'/delete ') }}" class="btn btn-danger">Xóa</a>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection