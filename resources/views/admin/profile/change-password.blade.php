@extends('layouts.admin')
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Change Password</a></li>
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
                <div class="card-header">{{ __('CHANGE PASSWORD') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('manage.profile.update-password', ['admin' => auth()->id()])}}" id="quickForm">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="current_password">Current Password <span class="red">*</span></label>
                                        <input type="text" name="current_password" class="form-control"
                                            id="current_password" placeholder="Enter Current Password"
                                            value="{{old('current_password')}}" style="width: 100%;" />
                                        @error('current_password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">New Password <span class="red">*</span></label>
                                        <input type="text" name="password" class="form-control"
                                            id="password" placeholder="Enter Password"
                                            value="{{old('password')}}" style="width: 100%;" />
                                        </select>
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password <span class="red">*</span></label>
                                        <input type="text" name="password_confirmation" class="form-control"
                                            id="password_confirmation" placeholder="Enter Confirm Password"
                                            value="{{old('password_confirmation')}}" style="width: 100%;" />
                                        </select>
                                        @error('password_confirmation')
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
                            <a href="{{route('manage.home')}}" class="btn btn-info">Profile</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection