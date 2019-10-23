@extends('adminlte::page')

@section('title', 'Manage Vehicle | Wananchi Group HR Recruitment')

@section('content_header')
<h1><strong>#{{$vehicles->vehicle_name}} - {{ $vehicles->vehicle_number }}</strong>
    <p class="pull-right">
        <a href="#" data-toggle="modal" data-target="#modal_edit_vehicle_{{ $vehicles->vehicle_id }}"
            class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            EDIT VEHICLE</a>
        @if ($vehicles->driver_id == '' && $vehicles->status == 'approved')
        <a href="#" data-toggle="modal" data-target="#modal_assign_driver_{{ $vehicles->vehicle_id }}"
            class="btn btn-info btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            ASSIGN DRIVER</a>
        @else

        @endif
    </p>
</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Vehicle Details</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="ticketDetailsTable" class="table table-no-margin" style="font-size:12px">
                    <tbody>
                        <tr>
                            <td><b>Vehicle Name #</b></td>
                            <td><span style="font-weight:bold">{{ $vehicles->vehicle_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Number</b></td>
                            <td><span style="font-weight:bold">{{ $vehicles->vehicle_number}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Status</b></td>
                            <td><span class="badge bg-yellow">{{ $vehicles->status }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td><b>Vehicle Type</b></td>
                            <td><span style="font-weight:bold">{{ $vehicles->vehicle_type}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Number of Seats</b></td>
                            <td><span style="font-weight:bold">{{ $vehicles->seats}} Seats</span></td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Image</b></td>
                            <td style=""> <a href="/{{ $vehicles->vehicle_picture }}" target="_blank">
                                    <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Document</b></td>
                            <td style=""> <a href="/{{ $vehicles->vehicle_document }}" target="_blank">
                                    <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td>
                        </tr>

                        <tr>
                            <td><b>Driver</b></td>
                            @if ($vehicles->fullname != '')
                            <td><span style="font-weight:bold">{{ $vehicles->fullname}}</span></td>
                            @else
                            <td><span style="font-weight:bold">Unassigned</span></td>
                            @endif
                        </tr>
                        <tr>
                            <td><b>Created At</b></td>
                            <td><span style="font-weight:bold">{{ $vehicles->vehicle_created_at}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Vehicle Image</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <img class="img-responsive pad" style="height:307px" src="/{{ $vehicles->vehicle_picture }}"
                    alt="Photo">
            </div>
        </div>
    </div>
</div>

@stop
@include('vehicles.modals.modal_edit_vehicle')
@include('vehicles.modals.modal_assign_driver')
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')

@stop