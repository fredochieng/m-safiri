<div class="modal fade in" id="modal_edit_vehicle_{{ $vehicles->vehicle_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['VehiclesController@update',$vehicles->vehicle_id],'method'=>'PATCH','class'=>'form','enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Vehicle - <strong>{{ $vehicles->vehicle_number }}</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Vehicle Name / Model') !!}
                            <div class="form-group">
                                {{Form::text('vehicle_name', $vehicles->vehicle_name, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Vehicle Type ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="vehicle_type_id" id="vehicle_type_id" required
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{ $vehicles->vehicle_type_id }}">{{ $vehicles->vehicle_type }}</option>
                                @foreach($vehicle_types as $item)
                                <option value='{{ $item->id }}'>{{ $item->vehicle_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Plate Number') !!}
                            <div class="form-group">
                                {{Form::text('vehicle_number', $vehicles->vehicle_number, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Driver') !!}
                            <div class="form-group">
                                {{Form::text('driver', $vehicles->fullname, ['class' => 'form-control', 'readonly' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Number of Seats') !!}
                            <div class="form-group">
                                {{Form::number('seats', $vehicles->seats, ['class' => 'form-control', 'min'=>'1','required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Created At') !!}
                            <div class="form-group">
                                {{Form::text('vehicle_created_at', $vehicles->vehicle_created_at, ['class' => 'form-control', 'readonly' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Vehicle Image')}}
                        <div class="form-group">
                            <a href="/{{ $vehicles->vehicle_picture }}" target="_blank">
                                <i class="fa fa-fw fa-download"></i> Download Vehicle Image</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Vehicle Document')}}
                        <div class="form-group">
                            <a href="/{{ $vehicles->vehicle_document }}" target="_blank">
                                <i class="fa fa-fw fa-download"></i> Download Vehicle Document</a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        {{Form::label('Upload Vehicle Image')}}
                        <div class="form-group">
                            {{Form::file('vehicle_picture', ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Upload Vehicle Document')}}
                        <div class="form-group">
                            {{Form::file('vehicle_document',['class'=>'form-control'])}}
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