@extends('adminlte::page')

@section('title', 'Trip Price | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Trip Prises</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_price" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Location Price </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>

                        <th>Price Type</th>
                        <th>Location From</th>
                        <th>Location To</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @foreach ($tripPrices as $item)
                <tr>

                    <td>{{ $item->price_type }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->dest_address }}</td>
                    <td>{{ $item->price }}</td>


                    <td>
                        <a class="btn btn-info btn-sm" title="Edit Price" href="#" data-toggle="modal"
                            data-target="#modal_edit_price_{{$item->price_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-eye"></i></a>

                        <a class="btn btn-danger btn-sm" title="Delete Price" href="#" data-toggle="modal"
                            data-target="#modal_delete_price_{{$item->price_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
                @include('tripPrices.modals.modal_edit_price')
                @include('tripPrices.modals.modal_delete_price')
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@include('tripPrices.modals.modal_add_price')

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