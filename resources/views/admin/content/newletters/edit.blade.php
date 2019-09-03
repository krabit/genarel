@extends('admin.layouts.glance')
@section('title')
    Sửa newletters
@endsection
@section('content')
    <h1> Sửa newletters {{ $newsletters-> id . ' : ' .$newsletters->name  }} </h1>
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
            <form class="form-horizontal" name="category" action="{{ url('admin/newletters/' .$newsletters->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Link</label>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="{{$newsletters->email }}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>

                </div>

                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
