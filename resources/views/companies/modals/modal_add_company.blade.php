<div class="modal fade in" id="modal_add_company" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('CompaniesController@store'), 'method' => 'post' , 'enctype' =>
            'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Company</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Company Name *') !!}
                            <div class="form-group">
                                {{Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Address *') !!}
                            <div class="form-group">
                                {{Form::text('address', null, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Zipcode *') !!}
                            <div class="form-group">
                                {{Form::text('zipcode', null, ['class' => 'form-control','required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Contact Name *') !!}
                            <div class="form-group">
                                {{Form::text('contact_name', null, ['class' => 'form-control','required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Contact Email *') !!}
                            <div class="form-group">
                                {{Form::email('contact_email', null, ['class' => 'form-control','required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Contact Number *') !!}
                            <div class="form-group">
                                {{Form::text('contact_number', null, ['class' => 'form-control','required' ])}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add New Company</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>