@extends('adminlte::page')

@section('title', 'Trips | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Trip History</h3>
        {{-- <div class="pull-right">
            <button type="button" onclick="window.location='{{ url("users/index") }}'">Add Mechanic</button>
        </div> --}}
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>

                        <th>Trip ID</th>
                        <th>Driver Name</th>
                        <th>P/Location</th>
                        <th>D/Location</th>
                        <th>Trip Start</th>
                        <th>Trip End</th>
                        <th>Travel Time</th>
                        <th>Payment</th>
                        <th>Action</th>

                    </tr>
                </thead>

                @foreach ($trips as $trip)
                <tr>

                    <td>{{ $trip->trip_id }}</td>
                    <td>{{ $trip->driver_name }}</td>
                    <td>{{ $trip->p_location }}</td>
                    <td>{{ $trip->d_location }}</td>
                    <td>{{ $trip->trip_start }}</td>
                    <td>{{ $trip->trip_end }}</td>
                    <td>{{ $trip->travel_time }}</td>
                    <td>{{ $trip->payment }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" title="Edit Price" href="#" data-toggle="modal"
                        data-target="#modal_edit_price_{{$trip->trip_id}}" data-backdrop="static"
                        data-keyboard="false"><i class="fa fa-eye">View Invoice</i></a>

                    </td>
                </tr>

                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

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
