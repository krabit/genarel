@extends('admin.layouts.glance')
@section('title')
    Quản trị banners
@endsection
@section('content')
    <h1> Quản trị banners</h1>

    <div style="margin: 20px 0">
        <a href="{{ url('admin/banners/create') }}" class="btn btn-success">Thêm banner</a>
    </div>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng số</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <th scope="row">{{ $banner->id }}</th>
                        <td>{{ $banner->name }}</td>
                        <td>{{ $banner->link }}</td>
                        <td>
                            <?php
                            $images = isset($banner->image) ? json_decode($banner->image) : array();
                            ?>
                            @if(!empty($images))
                                    <img  src="{{asset( $images) }}" style="margin-top:15px;max-height:100px;">
                            @endif</td>

                        <td>
                            <a href="{{ url('admin/banners/'.$banner->id.'/edit') }}" class="btn btn-warning">Sửa</a>
                            <a href="{{ url('admin/banners/'.$banner->id.'/delete ') }}" class="btn btn-danger">Xóa</a>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
            {{ $banners->links()}}
        </div>
    </div>
@endsection

