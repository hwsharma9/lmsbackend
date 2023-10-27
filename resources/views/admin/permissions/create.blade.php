@extends('layouts.admin')
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Permission') }}</li>
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
                <div class="card-header">{{ __('ADD PERMISSION') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('manage.permissions.store')}}" id="quickForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Permission Name <span class="red">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Permission Name" value="{{old('name')}}" style="width: 100%;" autofocus />
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guard_name">Guard Name <span class="red">*</span></label>
                                        <select name="guard_name" id="guard_name" class="form-control">
                                            <option value="admin" {{old('guard_name') === 'admin' ? 'selected' : ''}}>admin</option>
                                            <option value="web" {{old('guard_name') === 'web' ? 'selected' : ''}}>web</option>
                                        </select>
                                        @error('guard_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="database_route_id">Route <span class="red">*</span></label>
                                        <select name="database_route_id" class="form-control">
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $route)
                                            <option value="{{$route->id}}">{{$route->controller_name.'->'.$route->function_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('database_route_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" name="action" value="{{Route::currentRouteName()}}" class="btn btn-primary">Save &amp; New</button>
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