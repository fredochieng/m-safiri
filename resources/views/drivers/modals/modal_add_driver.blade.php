<div class="modal fade in" id="modal_add_driver" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('DriverController@store'), 'method' => 'post' , 'enctype' =>
            'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Driver</h4>
            </div>
            {{-- <input type="hidden" name="company_id" value="{{$company_id}}" <div class="col-md-4"> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Driver Name *') !!}
                                <div class="form-group">
                                    {{Form::text('driver_name', null, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Email Address *') !!}
                                <div class="form-group">
                                    {{Form::email('email', null, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Phone Number *') !!}
                                <div class="form-group">
                                    {{Form::text('phone_no', null, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Date of Birth *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{Form::text('dob', null, ['class' => 'form-control date_selector', 'id' => 'date_selector', 'required',  'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Gender ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="gender" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Male">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Country ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="country_id" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $item)
                                    <option value="{{$item->id}}">{{$item->country}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('City')}}
                            <div class="form-group">
                                <select class="form-control select2" name="city_id" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $item)
                                    <option value="{{$item->id}}">{{$item->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Postal Code') !!}
                                <div class="form-group">
                                    {{Form::text('postal_code', null, ['class' => 'form-control', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Address') !!}
                                <div class="form-group">
                                    {{Form::text('address', null, ['class' => 'form-control', 'required' ])}}
                    </div>
                </div>
            </div> --}}
            <div class="col-md-4">
                {{Form::label('Upload Driver Image *')}}
                <div class="form-group">
                    {{Form::file('driver_image',['class'=>'form-control', 'required'])}}
                </div>
            </div>
            <div class="col-md-4">
                {{Form::label('Upload Vehicle Document *')}}
                <div class="form-group">
                    {{Form::file('driver_license',['class'=>'form-control', 'required'])}}
                </div>
            </div>
            <div class="col-md-4">
                {{Form::label('Upload Address Proof *')}}
                <div class="form-group">
                    {{Form::file('address_proof',['class'=>'form-control', 'required'])}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add New Driver</button>
    </div>
    {!! Form::close() !!}
</div>
<!-- /.modal-content -->
</div>
</div>