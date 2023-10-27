@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{asset('webroot/plugins/dropzone/css/dropzone.css')}}">
@endpush
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Media') }}</li>
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
                <div class="card-header">{{ __('DROP YOUR IMAGE HERE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="note note-info">
                                <p>Max File Size is 10 Mb and accepted File extension is ".pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx,.mp4"</p>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{route('manage.medias.store')}}" id="frmuploadpicture" name="frmuploadpicture" enctype="multipart/form-data" class="dropzone">
                        @csrf
                        <!-- /.card-body -->
                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" name="action" value="{{Route::currentRouteName()}}" class="btn btn-primary">Save &amp; New</button>
                            <button type="button" class="btn btn-secondary">Clear</button>
                            <a href="{{route('manage.roles.index')}}" class="btn btn-info">Back</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    // Dropzone.autoDiscover = false;
	$(document).ready(function(){
        //File Upload response from the server
        var accept = ".pdf,.doc,.docx,.jpeg,.jpg,.JPG,.JPEG,.png,.pdf,.xls,.xlsx,.mp4";
        
        Dropzone.options.dropzoneForm = {
            maxFiles: 5,
            maxFilesize: 10, //MB
            acceptedFiles: accept,
            init: function () {
                this.on("complete", function (data) {
                    var res = eval('(' + data.xhr.responseText + ')');
                });
                
            }
        };
    });

</script>
<script src="{{asset('webroot/plugins/dropzone/dropzone.min.js')}}"></script>
@endpush