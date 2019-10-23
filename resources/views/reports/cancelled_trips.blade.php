@extends('adminlte::page')

@section('title', 'Cancelled Trips | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Trip History</h3>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Trip Date</th>
                        <th>Driver Name</th>
                        <th>P/Location</th>
                        <th>D/Location</th>
                        <th>Cancel Reason</th>
                    </tr>
                </thead>

                @foreach ($cancelled_trips as $trip)
                <tr>
                    <td>{{ $trip->datetime }}</td>
                    <td>{{ $trip->fullname }}</td>
                    <td>{{ $trip->from_title }}</td>
                    <td>{{ $trip->to_title }}</td>
                    <td>{{ $trip->cancel_reason }}</td>
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