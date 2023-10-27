@extends('layouts.admin')
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Database Route') }}</li>
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
                <div class="card-header">{{ __('EDIT DATABASE ROUTE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form method="POST" action="{{route('manage.databaseroutes.update', ['databaseroute' => $databaseroute->id])}}" id="quickForm">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="controller_name">Controller Name <span class="red">*</span></label>
                                        <input type="text" name="controller_name" class="form-control"
                                            id="controller_name" placeholder="Enter Controller Name"
                                            value="{{old('controller_name', $databaseroute->controller_name)}}" style="width: 100%;" />
                                        @error('controller_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="route">Route <span class="red">*</span></label>
                                        <input type="text" name="route" class="form-control"
                                            id="route" placeholder="Enter Route"
                                            value="{{old('route', $databaseroute->route)}}" style="width: 100%;" />
                                        @error('route')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="method">Method <span class="red">*</span></label>
                                        <select name="method" class="form-control">
                                            <option value="get" @if (old('method', $databaseroute->method) === 'get') selected @endif>get</option>
                                            <option value="post" @if (old('method', $databaseroute->method) === 'post') selected @endif>post</option>
                                            <option value="put" @if (old('method', $databaseroute->method) === 'put') selected @endif>put</option>
                                            <option value="patch" @if (old('method', $databaseroute->method) === 'patch') selected @endif>patch</option>
                                            <option value="delete" @if (old('method', $databaseroute->method) === 'delete') selected @endif>delete</option>
                                        </select>
                                        @error('method')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resides_at">Controller Resides at <span class="red">*</span></label>
                                        <select name="resides_at" class="form-control">
                                            <option value="manage" @if (old('resides_at', $databaseroute->resides_at) === "manage") selected @endif>Manage</option>
                                            <option value="user" @if (old('resides_at', $databaseroute->resides_at) === "user") selected @endif>User</option>
                                            <option value="" @if (old('resides_at', $databaseroute->resides_at) === "") selected @endif>Root</option>
                                        </select>
                                        @error('resides_at')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="named_route">Named Route <span class="red">*</span></label>
                                        <input type="text" name="named_route" class="form-control"
                                            id="named_route" placeholder="Enter Route"
                                            value="{{old("named_route", $databaseroute->named_route)}}" style="width: 100%;" />
                                        @error("named_route")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="function_name">Function Name <span class="red">*</span></label>
                                        <input type="text" name="function_name" class="form-control"
                                            id="function_name" placeholder="Enter Route"
                                            value="{{old("function_name", $databaseroute->function_name)}}" style="width: 100%;" />
                                        @error("function_name")
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
                            <a href="{{route('manage.databaseroutes.index')}}" class="btn btn-info">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection