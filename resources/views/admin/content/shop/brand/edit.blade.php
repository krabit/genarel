@extends('admin.layouts.glance')
@section('title')
    Sửa banner
@endsection
@section('content')
    <h1> Sửa banner {{ $brands-> id . ' : ' .$brands->name  }} </h1>
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
            <form class="form-horizontal" name="category" action="{{ url('admin/shop/brand/' .$brands->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên </label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $brands->name }}" placeholder="Default Input">
                    </div>

                </div>


                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Link</label>
                    <div class="col-sm-8">
                        <input type="text" name="link" value="{{$brands->link }}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>

                </div>


                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-8">
                        <span class="input-group-btn">
                             <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="lfm-btn btn btn-primary">
                               <i class="fa fa-picture-o"></i> Choose
                             </a>
                       </span>
                        <input id="thumbnail1" class="form-control" type="text" name="image" value="{{$brands->image}}" placeholder="Default Input">
                        @if(isset($brands->image)&& $brands->image)
                            <img id="holder1"  src="{{asset($brands->image)}}"  style="margin-top:15px;max-height:100px;">
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả ngắn</label>
                    <div class="col-sm-8">
                        <textarea name="intro" id="txtarea1"  cols="50" rows="4" class="form-control1 mytinymce">{{ $brands->intro }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-8">
                        <textarea name="desc" id="txtarea1"  cols="50" rows="4" class="form-control1 mytinymce">{{ $brands->desc }}</textarea>
                    </div>
                </div>


                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            var domain = "http://localhost/project_1/authen/public/laravel-filemanager";
            $('.lfm-btn').filemanager('image', {prefix: domain});

        });
    </script>
@endsection
