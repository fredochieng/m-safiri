@extends('adminlte::page')

@section('title', 'Companies | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Companies</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_company" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Company </a>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Zipcode</th>
                        <th>Contact Name</th>
                        <th>Contact Number</th>
                        <th>Contact Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @foreach ($companies as $item)
                <tr>
                    <td>{{ $item->company_name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->zipcode }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->contact_number }}</td>
                    <td>{{ $item->email }}</td>

                    @if ($item->status == 'active')

                    <td><span class="badge bg-green">{{ $item->status}}</span>
                    </td>
                    @else
                    <td><span class="badge bg-yellow">{{ $item->status}}</span>
                    </td>
                    @endif
                    <td>{{ $item->company_created_at }}</td>
                    <td> <a href="/company/manage/&id={{$item->company_id}}" class="btn btn-flat btn-info btn-sm"><i
                                class="fa fa-eye"></i></a>

                        <a class="btn btn-danger btn-sm" title="Delete Driver" href="#" data-toggle="modal"
                            data-target="#modal_delete_company_{{$item->company_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
                @include('companies.modals.modal_delete_company')
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@include('companies.modals.modal_add_company')
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