@extends('admin.layouts.glance')
@section('title')
    Xóa nhãn hàng
@endsection
@section('content')

    <h1> Xóa nhãn hàng  {{ $brands-> id . ' : ' .$brands->name  }} </h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form class="form-horizontal" name="page" action="{{ url('admin/shop/brand/' .$brands->id.'/delete') }}" method="post">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
