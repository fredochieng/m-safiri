@extends('adminlte::page')

@section('title', 'Manage Route | Wananchi Group HR Recruitment')

@section('content_header')
<h1><strong>Add New Route</strong>
    <p class="pull-right">
        <a href="#" data-toggle="modal" data-target="#"
            class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-chevron-left"></i>
            Back
        </a>
    </p>
</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Enter Route Details</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(['url' => action('RoutesController@store'), 'method' => 'post' , 'enctype' =>
                'multipart/form-data'])
                !!}
                <div class="modal-body">
                    <div class="col-md-12">
                        {{Form::label('Add Pickup Location ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="pickup_id" required style="width: 100%;"
                                tabindex="-1" aria-hidden="true">
                                <option value="">Select Pickup Location</option>
                                @foreach ($locations as $item)
                                <option value="{{$item->id}}">{{$item->address}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('Pickup DateTime *') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{Form::text('pickup_time', null, ['class' => 'form-control date_selector', 'id' => 'date_selector', 'readonly', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                            {{Form::label('Add Destination Location ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="destination_id" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Destination Location</option>
                                    @foreach ($locations as $item)
                                    <option value="{{$item->id}}">{{$item->address}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Destination DateTime') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{Form::text('destination_time', null, ['class' => 'form-control date_selector', 'id' => 'date_selector', 'readonly', 'required' ])}}
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                            {{Form::label('Driver Name ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="driver_name" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Driver</option>
                                    @foreach ($drivers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">

                     <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add Route</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            <!-- /.box-header -->
            <div class="box-body">
                <iframe class="map col-md-12" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29374.82985549621!2d72.52208875!3d23.02914215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1538744497991" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/custom.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
@stop
@section('js')
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
