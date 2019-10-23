<div class="modal fade in" id="modal_add_price" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                {!! Form::open(['url' => action('TripPriceController@store'), 'method' => 'post' , 'enctype' =>
                'multipart/form-data'])
                !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Location Price</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('Price Type ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="price_type" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                    <option value="">Select Price Type</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Price/Kilometer">Price/Kilometer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{Form::label('Location From ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="location_from" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                    <option value="">Select pick up Location</option>
                                    @foreach ($locations as $location)
                                    <option value="{{$location->id}}">{{$location->address}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                {{Form::label('Location To ')}}
                                <div class="form-group">
                                    <select class="form-control select2" name="location_to" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                        <option value="">Select Location Destination</option>
                                        @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->address}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Price *') !!}
                                <div class="form-group">
                                    {{Form::text('price', null, ['class' => 'form-control', 'required' ])}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add New Price</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
