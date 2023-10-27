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
                    <li class="breadcrumb-item active">{{ __('User') }}</li>
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
                <div class="card-header">{{ __('ADD USER') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('manage.users.store')}}" id="frmPrivilege">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Privilege Name <span class="red">*</span></label>
                                        <select name="role_id" id="role_id" class="form-control" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">First Name <span class="red">*</span></label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{old('first_name')}}" style="width: 100%;" />
                                        @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span class="red">*</span></label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}" style="width: 100%;" />
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number <span class="red">*</span></label>
                                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile Number" value="{{old('mobile')}}" style="width: 100%;" />
                                        @error('mobile')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Designation <span class="red">*</span></label>
                                        <input type="text" name="designation" class="form-control" id="designation" placeholder="Enter Designation" value="{{old('designation')}}" style="width: 100%;" />
                                        @error('designation')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name <span class="red">*</span></label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{old('last_name')}}" style="width: 100%;" />
                                        @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="designation">Username <span class="red">*</span></label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="{{old('username')}}" style="width: 100%;" />
                                        @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{var_dump(auth()->user()->hasPermissionTo('Give Store User Page'))}}
                            @if(auth()->user()->can('Give Store User Page'))
                            here
                            @endif
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
@endpush