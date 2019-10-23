<div class="modal fade in" id="modal_edit_price_{{ $item->price_id }}" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog" style="width:50%">
            <div class="modal-content">
                {!!
                Form::open(['action'=>['TripPriceController@update',$item->price_id],'method'=>'PATCH','class'=>'form','enctype'=>'multipart/form-data'])
                !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Trip Price</h4>
                </div>
                <input type="hidden" name="price_id" value="{{ $item->price_id }}">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('Price Type ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="price_type" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                <option value="{{ $item->price_type }}">{{$item->price_type}}</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Price/Kilometer">Price/Kilometer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{Form::label('Location From ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="location_from" required style="width: 100%;"tabindex="-1" aria-hidden="true">
                                    <option value="{{$item->location_id}}">{{$item->location}}</option>
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
                                    <option value="{{$item->id}}">{{$item->dest_address}}</option>
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
                                    {{Form::text('price', $item->price, ['class' => 'form-control', 'required' ])}}
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
