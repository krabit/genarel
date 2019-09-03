@extends('admin.layouts.glance')
@section('title')
    Xóa menu
@endsection
@section('content')

    <h1> Xóa menu  {{ $menu-> id . ' : ' .$menu->name  }} </h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form class="form-horizontal" name="menu" action="{{ url('admin/menu/' .$menu->id.'/delete') }}" method="post">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
