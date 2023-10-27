@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{asset('plugins/nestable/nestable.css')}}">
@endpush

@section('page_title')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('Create Menu') }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">View</a></li>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <h1 class="m-0">{{ __('Create Menu') }}</h1>
                    </h3>
                </div>
                <input type="hidden" id="nestable-output">
                <form action="{{route('manage.menus.store')}}" method="POST" id="frmMenu">
                    <input type="hidden" id="id" name="id" value="" />
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Menu Name</label>
                                    <input type="text" name="menu_name" id="menu_name" class="form-control" id="name" placeholder="Enter Menu Name" style="width: 100%;" value="{{old('menu_name')}}" />
                                    @error('menu_name') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Permissions Name</label>
                                    <select name="permission_id" id="permission_id" class="form-control" id="name" placeholder="Enter Icon class Name" style="width: 100%;">
                                        <option value="">Select Permission</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('permission_id') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Icon class Name</label>
                                    <input type="text" name="icon_class" id="icon_class" class="form-control" id="name" placeholder="Enter Icon class Name" style="width: 100%;" value="{{old('icon_class')}}" />
                                    @error('icon_class') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        <button type="button" id="reset" class="btn btn-secondary" data-action="{{route('manage.menus.store')}}">New</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <menu id="nestable-menu">
                                <button class="btn btn-danger" type="button" data-action="expand-all"><i class="fa fa-plus-circle"></i> Expand All</button>
                                <button class="btn btn-warning" type="button" data-action="collapse-all"><i class="fa fa-minus-circle"></i> Collapse All</button>
                            </menu>
                        </div><!--End column-->
                    </div><!--End row-->
                    <div class="cf nestable-items">
                        <div class="dd" id="nestable">
                            <x-admin-menu-tree :menus="$menus" class="dd-list" />
                        </div>
                    </div>
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
    jQuery(function() {
        jQuery.validator.addMethod("alphanumspace", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s]*$/.test(value);
        }, "Please enter character, number and space only.");

        jQuery.validator.addMethod("alphasymbol", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\/\#]*$/.test(value);
        }, "Please enter character,forword slash(/) and hash (#) symbol only.");

        jQuery.validator.addMethod("alphasymbol2", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\/]*$/.test(value);
        }, "Please enter character,forword slash(/) and number only.");

        jQuery.validator.addMethod("alphanumspacedash", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\-\s]*$/.test(value);
        }, "Please enter character, number, space and (-) symbol only.");

        jQuery("#frmMenu").validate({
            rules: {
                menu_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 40
                },
                icon_class: {
                    required: true,
                    alphanumspacedash: true,
                    minlength: 2,
                    maxlength: 40
                },
            },
            message: {
                menu_name: {
                    required: "Menu name is requird field !"
                },
                icon_class: {
                    required: "Icon name is requird field !"
                },
            }
        });
    });
</script>
<script src="{{asset('plugins/nestable/jquery.nestable.js')}}"></script>
<script>
    $(document).ready(function() {

        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        // activate Nestable for list 1
        $('#nestable').nestable({
                group: 1
            })
            .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $("#submit").click(function(e) {
            e.preventDefault();
            if (jQuery("#frmMenu").valid() == true) {
                $('#ajaxloading').modal('show');
                var id = parseInt($("#id").val());
                id = (isNaN(id)) ? 0 : id;

                var dataString = {
                    'menu_name': $("#menu_name").val(),
                    'icon_class': $("#icon_class").val(),
                    'permission_id': $("#permission_id").val(),
                    'id': id
                };
                $.ajax({
                    type: (id == 0 ? "POST" : "PATCH"),
                    url: jQuery("#frmMenu").attr('action'),
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (!data.hasOwnProperty('errors')) {
                            console.log('update',JSON.stringify(data.data));
                            $("#label_show-"+data.data.id).text(data.data.menu_name);
                            $("#menu-"+data.data.id).attr('data-menu', JSON.stringify(data.data));
                            // location.reload();
                            // $("#nestable").html(data.html);
                            
                            $('#menu_name').val('');
                            $('#id').val('');
                            $("#icon_class").val('');
                            $("#parent_id").val('');
                            $("#permission_id").val('');
                            $("#submit").text('Submit');

                            // $('.custom-msgBox .modal-title').html('Success Message');
                            // $('#custom-msg').html('<b>' + data.message + '</b>');
                            // $('.custom-msgBox').modal('show');

                            for (const property in data.errors) {
                                $(`#${property}`).closest('.form-group').find("span.text-danger").remove();
                            }
                        } else {
                            // $('.custom-msgBox .modal-title').html('Error Message');
                            // $('#custom-msg').html('<b>' + data.message + '</b>');
                            // $('.custom-msgBox').modal('show');

                            for (const property in data.errors) {
                                console.log(data.errors[property]);
                                $(`#${property}`).closest('.form-group').find("span.text-danger").remove();
                                $(`#${property}`).closest('.form-group').append(`<span class="text-danger">${data.errors[property][0]}</span>`);
                            }
                        }

                        // $('#ajaxloading').modal('hide');

                    },
                    error: function(errors) {
                        // error = JSON.parse(error);
                        console.log('-----');
                        console.log(errors);
                        console.log('-----');
                        for (const property in errors) {
                            $(`#${property}`).closest('.form-group').find("span.text-danger").remove();
                            $(`#${property}`).closest('.form-group').append(`<span class="text-danger">${errors[property][0]}</span>`);
                        }
                        // $('#ajaxloading').modal('hide');
                    }
                });
                // console.log(dataString);
            }
        });

        $(document).on("click", ".del-button", function() {
            var x = confirm('Delete this menu?');
            var id = $(this).attr('id');
            if (x) {
                $('#ajaxloading').modal('show');
                $.ajax({
                    type: "DELETE",
                    url: 'menus/' + id,
                    dataType: "json",
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#ajaxloading').modal('hide');
                        if (data.status == true) {
                            $("li[data-id='" + id + "']").remove();

                            $('.custom-msgBox .modal-title').html('Success Message');
                            $('#custom-msg').html('<b> Data Successfully deleted !</b>');
                            $('.custom-msgBox').modal('show');
                        } else {
                            $('.custom-msgBox .modal-title').html('Error Message');
                            $('#custom-msg').html('<b>' + data.message + '</b>');
                            $('.custom-msgBox').modal('show');

                        }

                    },
                    error: function(xhr, status, error) {
                        $('#ajaxloading').modal('hide');
                        console.log(error);
                    }
                });
            }
        });

        $('.dd').on('change', function() {
            $('#ajaxloading').modal('show');
     
            var dataString = { 
              data : $("#nestable-output").val(),
            };
            console.log(dataString);

            $.ajax({
                type: "PATCH",
                url: '{{route("manage.menus.update-all")}}',
                data: dataString,
                cache : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    console.log('update-all',data);
                    // $('#ajaxloading').modal('hide');
                    // $('.custom-msgBox .modal-title').html('Success Message');
                    // $('#custom-msg').html('<b> Data has been saved</b>');
                    // $('.custom-msgBox').modal('show');          
                },
                error: function(xhr, status, error) {
                    // console.log(error);
                    // $('#ajaxloading').modal('hide');              
                }
            });
        });

        $(document).on("click", ".edit-button", function() {
            var menu = JSON.parse($(this).attr('data-menu'));
            $("#id").val(menu.id);
            $("#menu_name").val(menu.menu_name);
            $("#icon_class").val(menu.icon_class);
            $("#permission_id").val(menu.permission_id);
            $("#submit").text('Update');
            
            jQuery("#frmMenu").attr('action', $(this).attr('data-action'));
        });
        
        $(document).on("click", "#reset", function() {
            $('#id').val('');
            $('#menu_name').val('');
            $("#icon_class").val('');
            $("#permission_id").val('');
            $("#submit").text('Submit');
            jQuery("#frmMenu").attr('action', $(this).attr('data-action'));
        });
    });
</script>
@endpush