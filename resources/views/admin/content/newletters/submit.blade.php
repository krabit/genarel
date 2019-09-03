@extends('admin.layouts.glance')
@section('title')
    Thêm newletters
@endsection
@section('content')
    <h1> Thêm newletters</h1>
    <div class="row">
        <div class="form-three widget-shadow">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal" name="page" action="{{ url('admin/newletters') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Email </label>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>

                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
