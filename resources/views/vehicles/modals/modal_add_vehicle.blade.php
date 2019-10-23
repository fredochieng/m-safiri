<div class="modal fade in" id="modal_add_vehicle" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('VehiclesController@store'), 'method' => 'post' , 'enctype' =>
            'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Vehicle</h4>
            </div>
            <input type="hidden" name="company_id" value="{{$company_id}}" <div class="col-md-4">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Vehicle Name / Model *') !!}
                            <div class="form-group">
                                {{Form::text('vehicle_name', null, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Vehicle Type ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="vehicle_type_id" id="vehicle_type_id" required
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select Vehicle Type</option>
                                @foreach($vehicle_types as $item)
                                <option value='{{ $item->id }}'>{{ $item->vehicle_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Plate Number *') !!}
                            <div class="form-group">
                                {{Form::text('vehicle_number', null, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Number of seats *') !!}
                            <div class="form-group">
                                {{Form::number('seats', null, ['class' => 'form-control', 'min'=>'1','required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Upload Vehicle Image *')}}
                        <div class="form-group">
                            {{Form::file('vehicle_picture',['class'=>'form-control', 'required'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Upload Vehicle Document *')}}
                        <div class="form-group">
                            {{Form::file('vehicle_document',['class'=>'form-control', 'required'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add New Vehicle</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>