@extends('admin.layouts.glance')
@section('title')
    Xóa newletters
@endsection
@section('content')

    <h1> Xóa newletters  {{ $newsletters-> id . ' : ' .$newsletters->email  }} </h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form class="form-horizontal" name="page" action="{{ url('admin/newletters/' .$newsletters->id.'/delete') }}" method="post">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
