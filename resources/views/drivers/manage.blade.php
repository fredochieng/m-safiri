@extends('adminlte::page')

@section('title', 'Manage Driver | M-Safiri Turyde')

@section('content_header')
<h1><strong>DRIVER - {{$drivers->fullname}}</strong>
    <p class="pull-right">
        <a href="#" data-toggle="modal" data-target="#modal_edit_driver_{{ $drivers->driver_id }}"
            class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            EDIT DRIVER</a>
    </p>
</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <table class="table table-no-margin">
            <tbody style="font-size:12px">
                <tr>
                    <td style=""><strong>DRIVER NAME: </strong> {{$drivers->fullname}}</td>
                    <td style=""><strong>EMAIL ADDRESS: </strong> {{$drivers->email}}</td>
                    <td style=""><strong>PHONE NUMBER: </strong> {{$drivers->mobile_number}}</td>
                    <td style=""><strong>GENDER: </strong> {{$drivers->gender}}</td>
                    <td style=""><strong>DATE OF BIRTH: </strong> {{$drivers->dob}}</td>
                </tr>
                <tr>
                    <td style=""><strong>DRIVER COUNTRY: </strong> {{ $drivers->country }}</td>
                    <td style=""><strong>DRIVER CITY: </strong> {{$drivers->city}}</td>
                    @if ($drivers->online_status == 'Inactive')
                    <td><strong>ONLINE STATUS: <span
                                class="badge bg-yellow">{{ $drivers->online_status }}</span></strong></td>
                    @else
                    <td><strong>ONLINE STATUS: <span
                                class="badge bg-green">{{ $drivers->online_status }}</span></strong></td>
                    @endif
                    <td style=""><strong>APPROVED: </strong> {{$drivers->approved}}</td>
                    {{-- @if ($drivers->vehicle_number !='')
                    <td style=""><strong>DRIVER VEHICLE: </strong> {{ $drivers->vehicle_number }}</td>
                    @else
                    <td style=""><strong>DRIVER VEHICLE: </strong> No Vehicle</td>
                    @endif --}}
                </tr>
                <tr>
                    <td style=""><strong>DRIVER IMAGE: </strong> <a href="/{{ $drivers->driver_image }}"
                            target="_blank">
                            <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td>
                    {{-- <td style=""><strong>DRIVER LICENSE: </strong> <a href="/{{ $drivers->licence_file }}"
                    target="_blank">
                    <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td>
                    <td style=""><strong>DRIVER ADDRESS PROOF: </strong> <a href="/{{ $drivers->address_file }}"
                            target="_blank">
                            <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td> --}}

                    <td style=""><strong>POSTAL CODE: </strong> {{$drivers->postal_code}}</td>
                    @if ($drivers->status == 'Inactive')
                    <td><strong>DRIVER STATUS: <span class="badge bg-yellow">{{ $drivers->status }}</span></strong></td>
                    @else
                    <td><strong>DRIVER STATUS: <span class="badge bg-green">{{ $drivers->status }}</span></strong></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Trip History</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <div class="table-responsive">
            <table id="records" class="table table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>Trip ID</th>
                        <th>Vehicle Number</th>
                        <th>Vehicle Name</th>
                        <th>Pickup Location</th>
                        <th>Destination</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Trip Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop
@include('drivers.modals.modal_edit_driver')
@section('css')
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/css/bootstrap-timepicker.min.css">
@stop
@section('js')
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/bootstrap-timepicker.min.js"></script>
<script src="/js/dataTable.js"></script>
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