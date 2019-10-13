<div class="modal fade in" id="modal_add_location" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="width:20%">
            <div class="modal-content">
                {!! Form::open(['url' => action('LocationsController@store'), 'method' => 'post' , 'enctype' =>
                'multipart/form-data'])
                !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Location </h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Location *') !!}
                                <div class="form-group">
                                    {{Form::text('location', null, ['class' => 'form-control', 'required' ])}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add Location</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
