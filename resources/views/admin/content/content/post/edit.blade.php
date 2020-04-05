@extends('admin.layouts.glance')
@section('title')
    Sửa bài viết
@endsection
@section('content')
    <h1> Sửa bài viết  {{ $post-> id . ' : ' .$post->name  }} </h1>
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
            <form class="form-horizontal" name="category" action="{{ url('admin/content/post/' .$post->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên bài viết</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $post->name }}" placeholder="Default Input">
                    </div>

                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Danh mục</label>
                    <div class="col-sm-8">
                        <select name="cat_id">
                            <option value="0">Không có danh mục</option>
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}" <?php echo ($post->cat_id == $post->id) ? 'selected' : '' ?> >{{ $post->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-8">
                        <input type="text" name="slug" class="form-control1" id="focusedinput" value="{{ $post->slug }}" placeholder="Default Input">
                    </div>

                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Images</label>
                    <div class="col-sm-8">
                        <span class="input-group-btn">
                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="lfm-btn btn btn-primary">
                               <i class="fa fa-picture-o"></i> Choose
                             </a>
                       </span>
                        <input id="thumbnail" class="form-control" type="text" name="images" value="{{ $post->images }}" placeholder="Default Input">
                        <img id="holder"  src="{{ asset($post->images) }}" style="margin-top:15px;max-height:100px;">

                    </div>
                </div>


                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả ngắn</label>
                    <div class="col-sm-8">
                        <textarea name="intro" id="txtarea1"  cols="50" rows="4" class="form-control1 mytinymce">{{ $post->intro }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-8">
                        <textarea name="desc" id="txtarea1"  cols="50" rows="4" class="form-control1 mytinymce">{{ $post->desc }}</textarea>
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