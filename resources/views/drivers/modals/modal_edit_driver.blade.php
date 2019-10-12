<div class="modal fade in" id="modal_edit_driver_{{ $drivers->driver_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['DriverController@update',$drivers->driver_id],'method'=>'PATCH','class'=>'form','enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Driver</h4>
            </div>
            {{-- <input type="hidden" name="company_id" value="{{$company_id}}" <div class="col-md-4"> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Driver Name *') !!}
                                <div class="form-group">
                                    {{Form::text('driver_name', $drivers->fullname, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Email Address *') !!}
                                <div class="form-group">
                                    {{Form::email('email', $drivers->email, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Phone Number *') !!}
                                <div class="form-group">
                                    {{Form::text('phone_no', $drivers->mobile_number, ['class' => 'form-control', 'id' => 'vehicle_name', 'required' ])}}
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
                                    {{Form::text('dob', $drivers->dob, ['class' => 'form-control date_selector', 'id' => 'date_selector', 'readonly', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Gender ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="gender" required style="width: 100%;"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="{{ $drivers->gender }}">{{ $drivers->gender }}</option>
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
                                    <option value="{{ $drivers->country_id }}">{{ $drivers->country }}</option>
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
                                    <option value="{{ $drivers->city_id }}">{{ $drivers->city }}</option>
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
                                    {{Form::text('postal_code', $drivers->postal_code, ['class' => 'form-control', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Address') !!}
                                <div class="form-group">
                                    {{Form::text('address', $drivers->postal_code, ['class' => 'form-control', 'required' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Driver Image')}}
                            <div class="form-group">
                                <a href="/{{ $drivers->driver_image }}" target="_blank">
                                    <i class="fa fa-fw fa-download"></i> Download Driver Image</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('License Document')}}
                            <div class="form-group">
                                <a href="/{{ $drivers->licence_file }}" target="_blank">
                                    <i class="fa fa-fw fa-download"></i> Download Driver Licence</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Driver Address Proof')}}
                            <div class="form-group">
                                <a href="/{{ $drivers->address_file }}" target="_blank">
                                    <i class="fa fa-fw fa-download"></i> Download Driver Address Proof</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Upload Driver Image *')}}
                            <div class="form-group">
                                {{Form::file('driver_image',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Upload License Document *')}}
                            <div class="form-group">
                                {{Form::file('driver_license',['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{Form::label('Upload Address Proof *')}}
                            <div class="form-group">
                                {{Form::file('address_proof',['class'=>'form-control'])}}
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