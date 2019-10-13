@extends('adminlte::page')

@section('title', 'Manage Company | Turyde')

@section('content_header')
<h1><strong>#{{$companies->company_name}}</strong>
    <p class="pull-right">
        <a href="#" data-toggle="modal" data-target="#modal_edit_company_{{ $companies->company_id }}"
            class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            EDIT COMPANY</a>
    </p>
</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Company Details</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="ticketDetailsTable" class="table table-no-margin" style="font-size:12px">
                    <tbody>
                        <tr>
                            <td><b>Company Name</b></td>
                            <td><span style="font-weight:bold">{{ $companies->company_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Zipcode</b></td>
                            <td><span style="font-weight:bold">{{ $companies->zipcode}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Company Status</b></td>
                            @if ($companies->status == 'active')

                            <td><span class="badge bg-green">{{ $companies->status}}</span>
                            </td>
                            @else
                            <td><span class="badge bg-yellow">{{ $companies->status}}</span>
                            </td>
                            @endif
                        </tr>

                        <tr>
                            <td><b>Address</b></td>
                            <td><span style="font-weight:bold">{{ $companies->address}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Contact Email</b></td>
                            <td><span style="font-weight:bold">{{ $companies->email}} </span></td>
                        </tr>
                        <tr>
                            <td><b>Contact Phone</b></td>
                            <td><span style="font-weight:bold">{{ $companies->contact_number}} </span></td>
                        </tr>
                        <tr>
                            <td><b>Created At</b></td>
                            <td><span style="font-weight:bold">{{ $companies->company_created_at}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Vehicle Image</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">

            </div>
        </div>
    </div> --}}
</div>

@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')

@stop