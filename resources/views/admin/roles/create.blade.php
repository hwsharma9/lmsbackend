@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{asset('webroot/plugins/jqtree/jquery.tree.min.css')}}" type="text/css">
@endpush
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('User Privileges') }}</li>
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
                <div class="card-header">{{ __('ADD USER PRIVILEGE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('manage.roles.store')}}" id="quickForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">User Privilege Name <span class="red">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Privileg Name" value="{{old('name')}}" style="width: 100%;" />
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Privilege Description <span class="red">*</span></label>
                                <textarea name="description" cols="10" rows="4" style="width: 100%;">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="previleg">Privilege <span class="red">*</span></label>
                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-default">
                                    Choose Menu Privileg
                                  </button>
                                @error('previleg')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="previleg">Role Used For <span class="red">*</span></label>
                                <select name="used_for" id="used_for" class="form-control">
                                    <option value="frontend" selected>Backend</option>
                                    <option value="backend">Frontend</option>
                                </select>
                                @error('used_for')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" name="action" value="save_and_new">Save &amp; New</button>
                            <button type="button" class="btn btn-secondary">Clear</button>
                            <a href="{{route('manage.roles.index')}}" class="btn btn-info">Back</a>
                        </div>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                            <div class="modal-content bg-default">
                                <div class="modal-header">
                                <h4 class="modal-title">Previlege Menu Tree</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-5 justify-content-between">
                                        <button type="button" class="btn btn-success active" id="example-5-checkAll">Check all nodes</button>
                                        <button type="button" class="btn btn-danger" id="example-5-uncheckAll">Uncheck all nodes</button>
                                    </div>
                                    <div id="tree">
                                        <x-admin-menu-tree-checkbox :menus="$menus" :role="[]" />
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('webroot/plugins/jqtree/jquery.tree.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tree').tree({
            /* specify here your options */
        });
        
        $('#example-5-checkAll').click(function(){
                    $('#tree').tree('checkAll');
        });
        
        $('#example-5-uncheckAll').click(function(){
                    $('#tree').tree('uncheckAll');
        });
        
        $('#CustLink').click(function(e){
        	e.preventDefault();
        });
        
    });
</script>
@endpush