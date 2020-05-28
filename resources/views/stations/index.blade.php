@extends('layouts.master')

@section('page-title')
<title>Stations</title>
@endsection

@section('page-css')
     <link href="{{ asset('plugins/datatable/datatable.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{  session('message') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{  session('error') }}
    </div>
@endif
<style>
    .permission-div{
        background-color:#0f0f17;
        color:white;
        border:1px solid gray;
    }
    .permission-div h5{
        padding-top:20px;
        color:#c78383;
    }
    #permision_data_div{
        max-height:500px;
        overflow:auto;
    }
</style>
<div class="row">
    <input type = "hidden">
    <div class="col-md-12" style = "margin:auto">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <botton  class="btn btn-brand btn-elevate btn-icon-sm" href = "#" data-toggle="modal" data-target="#createStation">
                                <i class="la la-plus"></i>
                                Add
                            </botton>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" >
                        <table class="table table-striped- table-bordered table-hover table-checkable">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Station Name</td>
                                    <td>Latitude</td>
                                    <td>Longitude</td>
                                    <td>Location</td>
                                    <td>Address</td>
                                    <td>Phone</td>
                                    <td>Photo</td>
                                    <td>Hours</td>
                                    <td>Created Date</td>
                                    <td>Admin Id</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($stations)
                                    @foreach ($stations->all() as $station)
                                    <tr>
                                        <td>{{ $station->id }}</td>
                                        <td>{{ $station->station_name }}</td>
                                        <td>{{ $station->latitude }}</td>
                                        <td>{{ $station->longitude }}</td>
                                        <td>{{ $station && $station->location && $station->location->name ? $station->location->name : "" }}</td>
                                        <td>{{ $station->address }}</td>
                                        <td>{{ $station->phone}}</td>
                                        <td>{{ $station->photo}}</td>
                                        <td>{{ $station->hours}}</td>
                                        <td>{{ $station->created_at}}</td>
                                        <td>{{ $station->admin_id}}</td>
                                        <td>
                                            <button class="btn-sm btn btn-label-info btn-bold station_edit_button"  
                                                data-id = "{{ $station->id ? $station->id : '' }}"
                                                data-name = "{{ $station->station_name ? $station->station_name : '' }}"
                                                data-latitude = "{{$station->latitude ? $station->latitude : ''}}"
                                                data-longitude = "{{$station->longitude ? $station->longitude : ''}}"
                                                data-location = "{{$station->location->code ? $station->location->code : ''}}"
                                                data-address = "{{$station->address ? $station->address : ''}}"
                                                data-phone = "{{$station->phone ? $station->phone : ''}}"
                                                data-photo = "{{$station->photo ? $station->photo : ''}}"
                                                data-hours = "{{$station->hours ? $station->hours : ''}}"
                                                data-created = "{{$station->created_at ? $station->created_at : ''}}"
                                                data-admin = "{{$station->admin_id ? $station->admin_id : ''}}"
                                            ><i class="fa fa-edit"></i></button>
                                            <button class="btn-sm btn btn-label-danger btn-bold station_delete_button" 
                                                data-id = "{{ $station->id ? $station->id : '' }}"
                                                data-toggle="modal" data-target="#deleteStation"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

        <!--create modal-->
        <div class="modal fade" id="createStation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "{{ url('stations') }}">
                        {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Station Name</label>
                                    <input type="text" class="form-control" name="station_name" placeholder="Enter station name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" name="latitude" placeholder="Enter latitude" />
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" name="longitude" placeholder="Enter longigude"/>
                                </div>
                                <div class="form-group">
                                    <label>Location Code</label>
                                    <select class="form-control" name="location_code" id="exampleSelect1">
                                    @if($locations && count($locations) > 0)
                                        @foreach($locations as $loc)
                                        <option value = "{{ $loc && $loc->code ? $loc->code : '' }}">{{ $loc && $loc->name ? $loc->name : '' }}</option>
                                        @endforeach
                                    @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter address"/>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone"/>
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="photo[]" placeholder="Enter photo" multiple/>
                                </div>
                                <div class="form-group">
                                    <label>Hours</label>
                                    <input type="text" class="form-control" name="hours" placeholder="Enter hours"/>
                                </div>
                                <div class="form-group">
                                    <label>Create Date</label>
                                    <input type="date" class="form-control" name="created_at" placeholder="Enter created date"/>
                                </div>
                                <div class="form-group">
                                    <label>Admin Id</label>
                                    <select class = "form-control" name = "admin_id">
                                        @if($users && count($users)>0)
                                            @foreach($users as $u)
                                            <option value = "{{ $u && $u->id ? $u->id : '' }}">{{ $u && $u->name ? $u->name : "" }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
             </div>
        </div>

        <!--Edit Modal-->     
        <div class="modal fade" id="editStation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post"  id = "station_update_form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Station Name</label>
                                    <input type="text" class="form-control" id = "station_name_input" name="station_name" placeholder="Enter station name"/>
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" id = "latitude_input" name="latitude" placeholder="Enter latitude"/>
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" id ="longitude_input" name="longitude" placeholder="Enter longigude"/>
                                </div>
                                <div class="form-group">
                                    <label>Location Code</label>
                                    <select class="form-control" id = "location_input" name="location_code" >
                                    @if($locations && count($locations) > 0)
                                        @foreach($locations as $loc)
                                        <option value = "{{ $loc && $loc->code ? $loc->code : '' }}">{{ $loc && $loc->name ? $loc->name : '' }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id = "address_input" name="address" placeholder="Enter address"/>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" id="phone_input" name="phone" placeholder="Enter phone"/>
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" id="photo_input" name="photo" placeholder="Enter photo" multiple/>
                                </div>
                                <div class="form-group">
                                    <label>Hours</label>
                                    <input type="text" class="form-control" id="hours_input" name="hours" placeholder="Enter hours"/>
                                </div>
                                <div class="form-group">
                                    <label>Create Date</label>
                                    <input type="date" class="form-control" id="created_input" name="created_at" placeholder="Enter created date"/>
                                </div>
                                <div class="form-group">
                                    <label>Admin Id</label>
                                    <input type="text" class="form-control" id="admin_input" name="admin_id" placeholder="Enter admin id"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
             </div>
        </div>
        <!--Delete Modal-->     
        <div class="modal fade" id="deleteStation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Station</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Really want to delete???</h5>
                    </div>
                    <form method="POST"   id = "station_delete_form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                        </div>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>


@endsection

@section('page-js')
<script src="{{ asset('plugins/datatable/datatable.bundle.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.station_edit_button').on('click', function(){
            var station_id = $(this).data('id');
            var station_name = $(this).data('name');
            var latitude = $(this).data('latitude');
            var longitude = $(this).data('longitude');
            var location = $(this).data('location');
            var address = $(this).data('address');
            var phone = $(this).data('phone');
            var photo = $(this).data('photo');
            var hours = $(this).data('hours');
            var created = $(this).data('created');
            var admin = $(this).data('admin');
            $('#station_name_input').val(station_name);
            $('#latitude_input').val(latitude);
            $('#longitude_input').val(longitude);
            $('#location_input').val(location);
            $('#address_input').val(address);
            $('#phone_input').val(phone);
            $('#photo_input').val(photo);
            $('#hours_input').val(hours);
            $('#created_input').val(created);
            $('#admin_input').val(admin);
            $('#station_update_form').attr('action', "/stations/" + station_id);
            $('#editStation').modal('show');
        })
        $('.station_delete_button').on('click', function(){
            var station_id = $(this).data('id');
            $('#station_delete_form').attr('action', "/stations/" + station_id);
         })
    })
</script>
@endsection
