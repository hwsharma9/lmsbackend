@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}" />
@endpush
@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('View User Privileges List') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">View</a></li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-sm-right">
                    @if (Gate::allows('check-auth', 'manage.roles.create'))
                        <a href="{{route('manage.roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    @endif
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
                <div class="card-header">
                    <h3 class="card-title m-0">
                        {{ __('VIEW USER PRIVILEGES LIST') }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Previlege Name</th>
                                <th>Description</th>
                                <th>Is Deleted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
      var table = $('#dataTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('manage.roles.index') }}",
          columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name', searchable: false},
                {data: 'description', name: 'description'},
                {data: row => (row.deleted_at ? 'Yes' : 'No'), name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            'createdRow': function( row, data, dataIndex ) {
                if (data['deleted_at'] != null) {
                    $(row).addClass( 'bg-danger' ).attr('title', 'Model has been deleted!');
                }
            }
        });
    });
</script>
@endpush