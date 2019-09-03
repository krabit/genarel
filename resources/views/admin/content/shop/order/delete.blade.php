@extends('admin.layouts.glance')
@section('title')
    Xóa đơn hàng
@endsection
@section('content')

    <h1> Xóa đơn hàng  {{ $order-> id . ' : ' .$order->name  }} </h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form class="form-horizontal" name="page" action="{{ url('admin/content/page/' .$order->id.'/delete') }}" method="post">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
