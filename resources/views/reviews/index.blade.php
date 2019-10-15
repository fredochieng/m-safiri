@extends('adminlte::page')

@section('title', 'Reviews | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Reviews</h3>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>

                        <th>Ride ID</th>
                        <th>Driver Name</th>
                        <th>Rider Name</th>
                        <th>Rate</th>
                        <th>Date</th>
                        <th>Comment</th>
                    </tr>
                </thead>

                @foreach ($reviews as $item)
                <tr>

                    <td>{{ $item->ride_id }}</td>
                    <td>{{ $item->driver_name }}</td>
                    <td>{{ $item->rider_name }}</td>
                    <td>{{ $item->rate }}</td>
                    <td>{{ $item->Date }}</td>
                    <td>{{$item->comment}}</td>

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
@stop
@section('js')
<script src="/js/dataTable.js"></script>

@stop
