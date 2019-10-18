@extends('adminlte::page')

@section('title', 'Drivers | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Drivers</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_driver" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Driver </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Driver Image</th>
                        <th>Driver Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @foreach ($drivers as $item)
                <tr>
                    <td>
                        <span class="hidden-xs">
                            <img src="/{{$item->driver_image}}" class="vehicle-circle" alt="Driver Image"></span>
                    </td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mobile_number }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->dob }}</td>
                    <td>{{ $item->country }}</td>
                    <td>{{ $item->postal_code }}</td>
                    <td> <a href="/driver/manage/&id={{$item->driver_id}}" class="btn btn-flat btn-info btn-sm"><i
                                class="fa fa-eye"></i></a>

                        <a class="btn btn-danger btn-sm" title="Delete Driver" href="#" data-toggle="modal"
                            data-target="#modal_delete_driver_{{$item->driver_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
                @include('drivers.modals.modal_delete_driver')
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@include('drivers.modals.modal_add_driver')
@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('.date_selector').datepicker( {
            format: 'yyyy-mm-dd',
        orientation: "bottom",
        autoclose: true,
            showDropdowns: true,
            todayHighlight: true,
            toggleActive: true,
            clearBtn: true,
        })
    });
</script>
@stop