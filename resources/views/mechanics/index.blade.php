@extends('adminlte::page')

@section('title', 'Mechanic | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Mechanics</h3>
        {{-- <div class="pull-right">
            <button type="button" onclick="window.location='{{ url("users/index") }}'">Add Mechanic</button>
        </div> --}}
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>

                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @foreach ($mechanics as $mechanic)
                <tr>

                    <td>{{ $mechanic->full_name }}</td>
                    <td>{{ $mechanic->email_id }}</td>
                    <td>{{ $mechanic->street }}</td>
                    <td>{{ $mechanic->city }}</td>
                    <td>{{ $mechanic->date_time }}</td>
                    <td>{{ $mechanic->status }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" title="Edit Price" href="#" data-toggle="modal"
                        data-target="#modal_edit_price_{{$mechanic->mechanic_id}}" data-backdrop="static"
                        data-keyboard="false"><i class="fa fa-eye"></i></a>

                        <a class="btn btn-danger btn-sm" title="Delete Price" href="#" data-toggle="modal"
                            data-target="#modal_delete_price_{{$mechanic->mechanic_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
                {{-- @include('tripPrices.modals.modal_delete_price') --}}
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
{{-- @include('tripPrices.modals.modal_add_price')
@include('tripPrices.modals.modal_edit_price') --}}
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
