@extends('admin.layouts.glance')
@section('title')
    Xóa trang
@endsection
@section('content')

    <h1> Xóa trang  {{ $page-> id . ' : ' .$page->name  }} </h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form class="form-horizontal" name="page" action="{{ url('admin/content/page/' .$page->id.'/delete') }}" method="post">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
