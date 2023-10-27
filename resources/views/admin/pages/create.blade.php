@extends('layouts.admin')

@push('styles')
@endpush
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Page') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Add</a></li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-sm-right">
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">{{ __('ADD PAGE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('manage.pages.store')}}" id="frmPrivilege">
                        @csrf
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug <span class="red">*</span></label>
                                        <input name="slug" value="{{old('slug')}}" id="slug" class="form-control" style="width: 100%;" readonly />
                                        @error('slug')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_hi">Title Hindi<span class="red">*</span></label>
                                        <input name="title_hi" value="{{old('title_hi')}}" id="title_hi" class="form-control" style="width: 100%;" />                                            
                                        @error('title_hi')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_hi">Description Hindi <span class="red">*</span></label>
                                        <textarea name="description_hi" id="description_hi" value="{{old('description_hi')}}">{{old('description_hi', "Testing")}}</textarea>
                                        @error('description_hi')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en">Title English<span class="red">*</span></label>
                                        <input name="title_en" value="{{old('title_en')}}" id="title_en" class="form-control" style="width: 100%;" />
                                        @error('title_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_en">Description English <span class="red">*</span></label>
                                        <textarea name="description_en" id="description_en" value="{{old('description_en')}}">{{old('description_en', "Testing")}}</textarea>
                                        @error('description_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">status <span class="red">*</span></label>
                                        <select name="status" id="status" class="form-control" style="width: 100%;">
                                            <option value="1">Publish</option>
                                            <option value="0">Pending</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">SEO Title</label>
                                        <input type="text" name="meta_title" value="{{old('text')}}" class="form-control" id="meta_title" placeholder="Enter Meta Title" style="width: 100%;" />
                                        @error('meta_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_keyword">SEO Keyword (Ex:- MAX 12 KEYWORD)</label>
                                        <input type="text" name="meta_keyword" value="{{old('meta_keyword')}}" id="meta_keyword" class="form-control" style="width: 100%;" />
                                        @error('meta_keyword')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta_description">SEO Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control">{{old('meta_description')}}</textarea>
                                        @error('meta_description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary">Clear</button>
                            <a href="{{route('manage.roles.index')}}" class="btn btn-info">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('webroot/validation/dist/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('webroot/validation/dist/additional-methods.js')}}"></script>
<script type="text/javascript">
	jQuery(function(){
        jQuery.validator.addMethod("alphaspace", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
        }, "Please enter character and space only.");

        jQuery( "#frmPrivilege" ).validate({
            rules: { 
                username: {
                    required: true,
                    maxlength:50
                },
                first_name: {
                    required: true,
                    maxlength:50
                },
                last_name: {
                    required: true,
                    maxlength:50
                },
                email:{
                    required: true,
                    email: true
                },
                mobile:{
                    required: true,
                },
                designation:{
                    required: true,
                    maxlength:350
                },
                password:{
                    required: true,
                    maxlength:10
                },
            }
		});	
	});
</script>
<script type="text/javascript" src="{{asset('webroot/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">//<![CDATA[
CKEDITOR.replace('description_hi', {"toolbar":"Full","language":"en","width":"100%","height":"280px","filebrowserBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html","filebrowserImageBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html?type=Images","filebrowserFlashBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html?type=Flash","filebrowserUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files","filebrowserImageUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images","filebrowserFlashUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash"});
CKEDITOR.replace('description_en', {"toolbar":"Full","language":"en","width":"100%","height":"280px","filebrowserBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html","filebrowserImageBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html?type=Images","filebrowserFlashBrowseUrl":"\/wqc_for_live\/webroot\/ckfinder\/ckfinder.html?type=Flash","filebrowserUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files","filebrowserImageUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images","filebrowserFlashUploadUrl":"\/wqc_for_live\/webroot\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash"});
//]]></script>
<script type="text/javascript">

    $("#title_hi").on("keyup", function(e) {
        console.log(e.target.value);
    })
</script>
@endpush