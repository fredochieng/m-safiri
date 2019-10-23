@extends('adminlte::page')

@section('title', 'Routes | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Routes</h3>
        <div class="pull-right">
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/routes/create") }}'">
                <i class="fa fa-plus"></i>
                Add Route
            </button>
        </div>
    </div>


    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>PickUp Location</th>
                        <th>Pickup Time</th>
                        <th>Destination Location</th>
                        <th>Destination Time</th>
                        <th>Driver Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $item)
                    <tr>

                        <td>{{$item->location}}</td>
                        <td>{{$item->pickup_time}}</td>
                        <td>{{$item->dest_address}}</td>
                        <td>{{$item->destination_time}}</td>
                        <td>{{$item->driver_name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" title="Edit Route" href="#" data-toggle="modal"
                                data-target="#modal_edit_route_{{$item->route_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="Delete Route" href="#" data-toggle="modal"
                                data-target="#modal_delete_route_{{$item->route_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    @include('routes.modals.modal_delete_route')
                    @include('routes.modals.modal_edit_route')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
@stop