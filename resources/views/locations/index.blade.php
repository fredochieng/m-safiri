@extends('adminlte::page')

@section('title', 'Locations | Turyde')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Locations</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_location" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Location </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="records" class="table table-hover">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude To</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->address }}</td>
                    <td>{{ $location->latitude }}</td>
                    <td>{{ $location->longitude }}</td>
                    <td>{{ $location->status }}</td>

                    <td>

                        <a class="btn btn-danger btn-sm" title="Delete Location" href="#" data-toggle="modal"
                            data-target="#modal_delete_location_{{$location->location_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i>
                        </a>

                    </td>
                </tr>
                @include('locations.modals.modal_delete_location')
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@include('locations.modals.modal_add_location')
@stop
@section('css')
<link rel="stylesheet" href="/css/custom.css">
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
@stop
@section('js')
<script src="/js/dataTable.js"></script>
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
{{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAF9GH9ZPJeI5rtJGUaEUV7Dyfbtdjc2NI&libraries=places&language=en-AU"></script>
<script>
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
</script>
<script>
function geoCode(){
var location = $("#address").val();
var param = {address: location, key: 'AIzaSyAF9GH9ZPJeI5rtJGUaEUV7Dyfbtdjc2NI '};
$.ajax({
  url: 'https://maps.googleapis.com/maps/api/geocode/json',
   data:param,
  success: function(response) {
    console.log(response);
    var address = response.results[0].formatted_address;
    var lat = response.results[0].geometry.location.lat;
    var lng = response.results[0].geometry.location.lng;
    console.log(lat);
    /* Ajax call to insert data into database */
                $.ajax({
                            url: "ajax/insertGeometry.php",
                            method: 'get',
                            data: {
                            address: address,
                            lat: lat,
                            lng: lng
                      },
                    success: function(data){
                    if(data == 'exist'){
                        alert('Location already exist.');
                    }
                    else{
                        alert('Location added successfully.');
                    }
                     // What to do if we succeed
                    window.location='locations.php';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                            alert(textStatus);// What to do if we fail
                                console.log(textStatus);
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
  },
                    error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
                                console.log(textStatus);
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
});
} --}}
@stop
