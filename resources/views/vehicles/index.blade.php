@extends('adminlte::page')

@section('title', 'Vehicles | M-Safiri Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Vehicles</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_vehicle" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Vehicle </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Vehicle Image</th>
                        <th>Vehicle Name</th>
                        <th>Vehicle Type</th>
                        <th>Plate Number</th>
                        <th>Passenger Capacity</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $item)
                    <tr>
                        <td>
                            <span class="hidden-xs">
                                <img src="/{{$item->vehicle_picture}}" class="vehicle-circle" alt="User Image"></span>
                        </td>
                        <td>{{$item->vehicle_name}}</td>
                        <td>{{$item->vehicle_type}}</td>
                        <td>{{$item->vehicle_number}}</td>
                        <td>{{$item->seats}}</td>
                        <td>{{$item->vehicle_created_at}}</td>
                        <td> <a href="/vehicle/manage/&id={{$item->vehicle_id}}" class="btn btn-flat btn-info btn-sm"><i
                                    class="fa fa-eye"></i></a>

                            <a class="btn btn-danger btn-sm" title="Delete Vehicle" href="#" data-toggle="modal"
                                data-target="#modal_delete_vehicle_{{$item->vehicle_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                    @include('vehicles.modals.modal_delete_vehicle')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@include('vehicles.modals.modal_add_vehicle')

@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
@stop