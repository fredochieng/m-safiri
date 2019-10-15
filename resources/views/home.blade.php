@extends('adminlte::page')

@section('title', 'Dashboard | M-Safiri Turyde')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    @if (auth()->user()->isAdmin())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $total_drivers }}</h3>

                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $total_drivers }}</h3>

                <p>Total Drivers</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- ./col -->
    @if (auth()->user()->isCompany())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $total_vehicles }}</h3>

                <p>Total Vehicles</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    @if (auth()->user()->isCompany())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $assigned_drivers }}</h3>

                <p>Assigned Drivers</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    @if (auth()->user()->isCompany())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $unassigned_drivers }}</h3>

                <p>Unassigned Drivers</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    <!-- ./col -->

    @if (auth()->user()->isAdmin())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $total_companies }}</h3>
                <p>Total Companies</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    @if (auth()->user()->isAdmin())
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $total_companies }}</h3>
                <p>Total Mechanics</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    @endif
    <!-- ./col -->
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Drivers</h3>
        <div class="pull-right">
            <a href="/drivers">
                View All Drivers
            </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Driver Image</th>
                        <th>Driver Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($latest_drivers as $item)
                <tr>
                    <td>
                        <span class="hidden-xs">
                            <img src="/{{$item->driver_image}}" class="vehicle-circle" alt="Driver Image"></span>
                    </td>
                    <td>{{ $item->fullname }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mobile_number }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->dob }}</td>
                    <td>{{ $item->country }}</td>
                    <td>{{ $item->postal_code }}</td>
                    <td> <a href="/driver/manage/&id={{$item->driver_id}}" class="btn btn-flat btn-info btn-sm"><i
                                class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Vehicles</h3>
        <div class="pull-right">
            <a href="/vehicles/all">
                View All Vehicles
            </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Vehicle Image</th>
                        <th>Vehicle Name</th>
                        <th>Vehicle Type</th>
                        <th>Plate Number</th>
                        <th>Passenger Capacity</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latest_vehicles as $item)
                    <tr>
                        <td>
                            <span class="hidden-xs">
                                <img src="/{{$item->vehicle_picture}}" class="vehicle-circle" alt="User Image"></span>
                        </td>
                        <td>{{$item->vehicle_name}}</td>
                        <td>{{$item->vehicle_type}}</td>
                        <td>{{$item->vehicle_number}}</td>
                        <td>{{$item->seats}}</td>
                        <td>{{$item->vehicle_created_at}}</td>
                        <td> <a href="/vehicle/manage/&id={{$item->vehicle_id}}" class="btn btn-flat btn-info btn-sm"><i
                                    class="fa fa-eye"></i></a>

                        </td>
                    </tr>
                    @include('vehicles.modals.modal_delete_vehicle')
                    @endforeach
                </tbody>
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