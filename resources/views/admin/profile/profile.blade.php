@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{asset('webroot/plugins/jcrop/css/jquery.Jcrop.min.css')}}" type="text/css" />
@endpush
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
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
                <div class="card-header">{{ __('UPLOAD PROFILE IMAGE') }}</div>

                <div class="card-body">
                    @if (session('image_uploaded'))
                    <div class="alert alert-success" role="alert">
                        {{ session('image_uploaded') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('manage.profile.image-upload', ['admin' => $admin->id])}}" id="quickForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_file" style="width: 100%">Profile Image</label>
                                        <img src="{{$profile_image}}" alt="Profile Photo" id="preview"><br>
                                        <input type="file" name="image_file" id="image_file" class="mt-5"><br>
                                        <div id="img-error" class="text-danger">
                                            @error('image_file')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Image Attributes</label>
                                        <table class="table">
											<tr>
												<th>File size</th>
												<td><input type="text" readonly id="filesize" name="filesize" /></td>
											</tr>
											<tr>
												<th>Type</th>
												<td><input type="text" readonly id="filetype" name="filetype" /></td>
											</tr>
											<tr>
												<th>Image dimension</th>
												<td><input type="text" readonly id="filedim" name="filedim" /></td>
											</tr>
											<tr>
												<th>Width</th>
												<td><input type="text" readonly id="w" name="w" /></td>
											</tr>
											<tr>
												<th>Height</th>
												<td><input type="text" readonly id="h" name="h" /></td>
											</tr>
										</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary">Clear</button>
                            <a href="{{route('manage.home')}}" class="btn btn-info">Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">{{ __('VIEW PROFILE DETAILS') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('manage.profile.update', ['admin' => $admin->id])}}" id="quickForm">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Privilege Name <span class="red">*</span></label>
                                        <div class="form-control">{{$admin->roles[0]->name}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">First Name <span class="red">*</span></label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{old('first_name', $admin->first_name)}}" style="width: 100%;" />
                                        @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span class="red">*</span></label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email', $admin->email)}}" style="width: 100%;" />
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <x-captcha />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Designation <span class="red">*</span></label>
                                        <div class="form-control">{{$admin->designation}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name <span class="red">*</span></label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{old('last_name', $admin->last_name)}}" style="width: 100%;" />
                                        @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number <span class="red">*</span></label>
                                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile Number" value="{{old('mobile', $admin->mobile)}}" style="width: 100%;" />
                                        @error('mobile')
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
                            <a href="{{route('manage.home')}}" class="btn btn-info">Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('webroot/plugins/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('webroot/plugins/jcrop/js/jquery.Jcrop.min.js')}}"></script>
<script type="text/javascript">
	// convert bytes into friendly format

	function bytesToSize(bytes) {
		var sizes = ['Bytes', 'KB', 'MB'];
		if (bytes == 0) return 'n/a';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
	};
	// check for selected crop region
	function checkForm() {
		if (parseInt($('#w').val())) return true;
		$('#img-error').html('Please select a crop region and then press Upload').show();
		return false;
	};

	// update info by cropping (onChange and onSelect events handler)
	function updateInfo(e) {
		$('#x1').val(e.x);
		$('#y1').val(e.y);
		$('#x2').val(e.x2);
		$('#y2').val(e.y2);
		$('#w').val(e.w);
		$('#h').val(e.h);
	};

    // clear info by cropping (onRelease event handler)
	function clearInfo() {
		$('.info #w').val('');
		$('.info #h').val('');
	};

	$('#image_file').on("change", function(e) {
		fileSelectHandler();
	});	 

	// Create variables (in this scope) to hold the Jcrop API and image size
	var jcrop_api, boundx, boundy;
	function fileSelectHandler() {
		// get selected file
		var oFile = $('#image_file')[0].files[0];
		// hide all errors
		$('#img-error').hide();
		// check for image type (jpg and png are allowed)
		var rFilter = /^(image\/jpeg|image\/png)$/i;
		if (!rFilter.test(oFile.type)) {
			$('#img-error').html('Please select a valid image file (jpg and png are allowed)').show();
			return;
		}
		// check for file size
		if (oFile.size > 250 * 1024) {
			$('#img-error').html('You have selected too big file, please select a one smaller image file').show();
			return;
		}
		// preview element
		var oImage = document.getElementById('preview');
		// prepare HTML5 FileReader
		var oReader = new FileReader();
		oReader.onload = function(e) {
			// e.target.result contains the DataURL which we can use as a source of the image
			oImage.src = e.target.result;
			oImage.onload = function() { // onload event handler
				// display step 2
				$('.step2').fadeIn(500);
				// display some basic image info
				var sResultFileSize = bytesToSize(oFile.size);
				$('#filesize').val(sResultFileSize);
				$('#filetype').val(oFile.type);
				$('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);
				// destroy Jcrop if it is existed
				if (typeof jcrop_api != 'undefined') {
					jcrop_api.destroy();
					jcrop_api = null;
					$('#preview').width(oImage.naturalWidth);
					$('#preview').height(oImage.naturalHeight);
				}			
				/// setTimeout(function(){
				// initialize Jcrop
				$('#preview').Jcrop({
					//minSize: [85, 125], // min crop size
					maxSize: [236, 295],
					aspectRatio: 236 / 295, // keep aspect ratio 1:1
					bgFade: true, // use fade effect
					bgOpacity: .5, // fade opacity
					onChange: updateInfo,
					onSelect: updateInfo,
					onRelease: clearInfo
				}, function() {
					// use the Jcrop API to get the real image size
					var bounds = this.getBounds();
					boundx = bounds[0];
					boundy = bounds[1];
					// Store the Jcrop API in the jcrop_api variable
					jcrop_api = this;
				});

		
        		jcrop_api.setSelect([0, 0, 213, 267]);
				// },500);
			};
		};
		// read selected file as DataURL
		oReader.readAsDataURL(oFile);
	}
</script>
@endpush