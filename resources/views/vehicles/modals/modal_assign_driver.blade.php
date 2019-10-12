<div class="modal fade in" id="modal_assign_driver_{{ $vehicles->vehicle_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['url' => action('VehiclesController@assignDriver'), 'method' => 'post' , 'enctype' =>
            'multipart/form-data'])
            !!}

            <input type="hidden" name="vehicle_id" value="{{ $vehicles->vehicle_id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Assign Driver - <strong>{{ $vehicles->vehicle_number}}</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('Select Driver ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="driver_id" required style="width: 100%;"
                                tabindex="-1" aria-hidden="true">
                                <option value="">Select Driver</option>
                                @foreach ($unassigned_drivers as $item)
                                <option value="{{$item->driver_id}}">{{$item->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Assign Driver</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>