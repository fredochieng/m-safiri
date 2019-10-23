<div class="modal fade in" id="modal_edit_route_{{ $item->route_id }}" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!!
               Form::open(['action'=>['RoutesController@update',$item->route_id],'method'=>'PATCH','class'=>'form','enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Route</h4>
            </div>
            <input type="hidden" name="route_id" value="{{$item->route_id}}">
            <div class="modal-body">
                <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Destination DateTime') !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        {{Form::text('destination_time',$item->destination_time , ['class' => 'form-control date_selector', 'id' => 'date_selector', 'readonly', 'required' ])}}
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                {{Form::label('Driver Name ')}}
                                <div class="form-group">
                                 <select class="form-control select2" name="driver_id" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                <option value="{{$item->driver_id}}">{{$item->driver_name}} </option>
                                        @foreach ($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->driver_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    <div class="col-md-4">
                        {{Form::label('Add Pickup Location ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="pickup_id" required style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{$item->location_id}}">{{$item->location}}</option>
                                @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->address}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Pickup DateTime') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{Form::text('pickup_time', $item->pickup_time, ['class' => 'form-control date_selector', 'id' => 'date_selector', 'readonly', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            {{Form::label('Add Destination Location ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="destination_id" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="$item->id">{{$item->dest_address}}</option>
                                    @foreach ($locations as $item)
                                    <option value="{{$item->id}}">{{$item->address}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>

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

