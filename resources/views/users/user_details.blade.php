@extends('adminlte::page')

@section('title', 'Users | M-Safiri Turyde')

@section('content_header')
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>User Details</b></h3>
            </div>
            <div class="box-body">
                    <div class="panel-body inf-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <img alt="" style="width:200px;" title="" class="img-circle img-thumbnail isTooltip" src="https://bootdey.com/img/Content/user-453533-fdadfd.png" data-original-title="Usuario">

                                </div>
                                <div class="col-md-6">
                                    <strong>Information</strong><br>
                                    <div class="table-responsive">
                                    <table class="table table-condensed table-responsive table-user-information">
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-user  text-primary"></span>
                                                        Name
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                        {{$users->full_name}}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-bookmark text-primary"></span>
                                                        Username
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                        {{$users->username}}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-eye-open text-primary"></span>
                                                        Role
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                    User
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-envelope text-primary"></span>
                                                        Email
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                        {{$users->user_email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-calendar text-primary"></span>
                                                        created
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                        {{$users->created_at}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        <span class="glyphicon glyphicon-calendar text-primary"></span>
                                                        Modified
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                        {{$users->updated_at}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

        </div>

    </div>
</div>

<div class="box box-primary ">
    <div class="box-header with-border">
        <h3 class="box-title">Trip History</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <div class="table-responsive">
            <table id="records" class="table table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>Trip_id</th>
                        <th>Driver Name</th>
                        <th>Vehicle No.</th>
                        <th>Pickup Station</th>
                        <th>Destnation</th>
                        <th>Travel Time</th>
                        <th>Payment Mode</th>
                        <th>Payment</th>
                        <th>Ratting</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tr>
                    <td>RIDE004</td>
                    <td>John Doe</td>
                    <td>#KAP123K</td>
                    <td>Westlands</td>
                    <td>Lavington</td>
                    <td>2019-10-09 10:00AM</td>
                    <td>Mpesa</td>
                    <td>250</td>
                    <td>2.5</td>
                    <td>Active</td>

                </tr>
            </table>
        </div>
    </div>
</div>

@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
@stop
