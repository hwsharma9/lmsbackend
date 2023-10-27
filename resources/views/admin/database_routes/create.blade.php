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
                <div class="card-header">{{ __('ADD DATABASE ROUTE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('manage.databaseroutes.store')}}" id="quickForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="controller_name">Controller Name <span class="red">*</span></label>
                                        <input type="text" name="controller_name" class="form-control"
                                            id="controller_name" placeholder="Enter Controller Name"
                                            value="{{old('controller_name')}}" style="width: 100%;" />
                                        @error('controller_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resides_at">Controller Resides at <span class="red">*</span></label>
                                        <select name="resides_at" class="form-control">
                                            <option value="manage" @if (old('resides_at') === "manage") selected @endif>Manage</option>
                                            <option value="user" @if (old('resides_at') === "user") selected @endif>User</option>
                                            <option value="" @if (old('resides_at') === "") selected @endif>Root</option>
                                        </select>
                                        @error('resides_at')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="html_detail">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="route[]" value=""
                                            placeholder="Route">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="named_route[]" value=""
                                            placeholder="Named Route">
                                    </div>
                                    <div class="col-2">
                                        <select name="method[]" class="form-control">
                                            <option value="get">get</option>
                                            <option value="post">post</option>
                                            <option value="put">put</option>
                                            <option value="patch">patch</option>
                                            <option value="delete">delete</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="function_name[]" value=""
                                            placeholder="Function Name">
                                    </div>
                                    <div class="col-1">
                                        <button type="button"
                                            class="btn btn-primary btn-icon-anim btn-square add_html"><i
                                                class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
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
@push('scripts')
<script>
    $(".add_html").on("click", function () {
        var html = $(this).closest(".row").clone();
        html.find("input,textarea").val("");
        html.find(".add_html").removeClass("add_html btn-primary").addClass("remove_html btn-danger");
        html.find(".fa-plus").removeClass("fa-plus").addClass("fa-trash").closest(".row");
        $(this).closest(".html_detail").append(html);
    });
    $("body").on("click", ".remove_html", function () {
        $(this).closest(".row").remove();
    });

</script>
@endpush