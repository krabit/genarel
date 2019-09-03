@extends('admin.layouts.glance')
@section('title')
    Quản trị menu items
@endsection
@section('content')
    <h1> Quản trị menu items</h1>
    <div style="margin: 20px 0">
        <a href="{{ url('admin/menuitems/create') }}" class="btn btn-success">Thêm menu items</a>
    </div>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng số</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Menu</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($menuitems as $menuitem)
                    <tr>
                        <th scope="row">{{ $menuitem["id"] }}</th>
                        <td>{{str_repeat('-', $menuitem['level'] - 1). ' ' .$menuitem["name"] }}</td>
                        <td>{{ $menuitem["parent_id"] }}</td>
                        <td>{{ $menuitem["menu_id"] }}</td>
                        <td>
                            <a href="{{ url('admin/menuitems/'.$menuitem["id"].'/edit') }}" class="btn btn-warning">Sửa</a>
                            <a href="{{ url('admin/menuitems/'.$menuitem["id"].'/delete ') }}" class="btn btn-danger">Xóa</a>
                        </td>

                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
