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
                    <li class="breadcrumb-item active">{{ __('Menu Module') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">View</a></li>
                </ol>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{route('manage.pages.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
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
                        {{ __('MENU MODULE LIST') }}
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
                                <th>Title Hi</th>
                                <th>Title En</th>
                                <th>Last Updated Date</th>
                                <th>Status</th>
                                <th>Is Default</th>
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
<script>
    jQuery(function() {
        jQuery('#dataTable').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('manage.pages.get-pages')}}",
            "columnDefs": [
                {
                    "targets": 0,
                    "data": 'id'
                },
                {
                    "targets": 1,
                    "data": 'title_hi'
                },
                {
                    "targets": 2,
                    "data": 'title_en'
                },
                {
                    "targets": 3,
                    "data": row => row.updated_at ? row.updated_at.split("T")[0] : '',
                    'orderable': false
                },
                {
                    "targets": 4,
                    "data": row => row.status ? "{!!PublishStatus(1)!!}" : "{!!PublishStatus(0)!!}",
                    'orderable': false
                },
                {
                    "targets": 5,
                    "data": row => row.is_default ? "{!!DefaultStatus(1)!!}" : "{!!DefaultStatus(0)!!}",
                    'orderable': false
                },
                {
                    "targets": 6,
                    "data": (row) => {
                        return `<a class="btn btn-primary" href="${location.origin}/manage/pages/${row.id}/edit"><i class="fas fa-edit"></i></a>`
                    }
                },
            ]
        });
    });
</script>
@endpush