@extends('admin.layouts.glance')
@section('title')
    Quản trị newletters
@endsection
@section('content')
    <h1> Quản trị newletters</h1>
    <div style="margin: 20px 0">
        <a href="{{ url('admin/newletters/create') }}" class="btn btn-success">Thêm newsletter</a>
    </div>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng số</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Action</th>

                </tr>
                </thead>

                <tbody>
                @foreach($newsletters as $newsletter)
                    <tr>
                        <th scope="row">{{ $newsletter->id }}</th>
                        <td>{{ $newsletter->email }}</td>
                        <td>
                            <a href="{{ url('admin/newletters/'.$newsletter->id.'/edit') }}" class="btn btn-warning">Sửa</a>
                            <a href="{{ url('admin/newletters/'.$newsletter->id.'/delete ') }}" class="btn btn-danger">Xóa</a>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
            {{ $newsletters->links()}}
        </div>
    </div>

@endsection
