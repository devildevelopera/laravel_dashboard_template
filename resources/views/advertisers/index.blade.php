@extends('layouts.master')

@section('page-title')
<title>Advertisers</title>
@endsection

@section('page-css')
     <link href="{{ asset('plugins/datatable/datatable.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')

<div class="row">
    <input type = "hidden">
    <div class="col-md-12" style = "margin:auto">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <botton  class="btn btn-brand btn-elevate btn-icon-sm" href = "#" data-toggle="modal" data-target="#createAdvertiser">
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
                                    <td>Business Name</td>
                                    <td>Contact Name</td>
                                    <td>Contact Phone</td>
                                    <td>Location</td>
                                    <td>Admin Id</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($advertisers)
                                    @foreach ($advertisers->all() as $advertiser)
                                    <tr>
                                        <td>{{ $advertiser->advertiser_id }}</td>
                                        <td>{{ $advertiser->business_name }}</td>
                                        <td>{{ $advertiser->contact_name }}</td>
                                        <td>{{ $advertiser->contact_phone }}</td>
                                        <td>{{ $advertiser && $advertiser->location && $advertiser->location->name ? $advertiser->location->name : "" }}</td>
                                        <td>{{ $advertiser->admin_id }}</td>
                                        <td>
                                            <button class="btn-sm btn btn-label-info btn-bold advertiser_edit_button"  
                                                data-id = "{{ $advertiser->advertiser_id ? $advertiser->advertiser_id : '' }}"
                                                data-businessname = "{{ $advertiser->business_name ? $advertiser->business_name : '' }}"
                                                data-contactname = "{{$advertiser->contact_name ? $advertiser->contact_name : ''}}"
                                                data-contactphone = "{{$advertiser->contact_phone ? $advertiser->contact_phone : ''}}"
                                                data-location = "{{$advertiser->location->code ? $advertiser->location->code : ''}}"
                                                data-admin = "{{$advertiser->admin_id ? $advertiser->admin_id : ''}}"
                                            ><i class="fa fa-edit"></i></button>
                                            <button class="btn-sm btn btn-label-danger btn-bold advertiser_delete_button" 
                                                data-id = "{{ $advertiser->advertiser_id ? $advertiser->advertiser_id : '' }}"
                                            ><i class="fa fa-trash"></i></button>
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
        <div class="modal fade" id="createAdvertiser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Advertiser</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "{{ url('advertisers') }}">
                        {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" name="business_name" placeholder="Enter business name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Enter contact name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input type="text" class="form-control" name="contact_phone" placeholder="Enter contact name" required/>
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
        <div class="modal fade" id="editAdvertiser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Advertiser</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post"  id = "advertiser_update_form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" id="business_name_input" name="business_name" placeholder="Enter business name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" class="form-control" id="contact_name_input" name="contact_name" placeholder="Enter contact name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone_input" name="contact_phone" placeholder="Enter contact name" required/>
                                </div>
                                <div class="form-group">
                                    <label>Location Code</label>
                                    <select class="form-control" name="location_code" id="location_input">
                                    @if($locations && count($locations) > 0)
                                        @foreach($locations as $loc)
                                        <option value = "{{ $loc && $loc->code ? $loc->code : '' }}">{{ $loc && $loc->name ? $loc->name : '' }}</option>
                                        @endforeach
                                    @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Admin Id</label>
                                    <select class = "form-control" name = "admin_id" id="admin_input">
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
        <!--Delete Modal-->     
        <div class="modal fade" id="deleteAdvertiser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Advertiser</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Really want to delete???</h5>
                    </div>
                    <form method="POST"   id = "advertiser_delete_form" >
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
        $('.advertiser_edit_button').on('click', function(){
            var id = $(this).data('id');
            var business_name = $(this).data('businessname');
            var contact_name = $(this).data('contactname');
            var contact_phone = $(this).data('contactphone');
            var location = $(this).data('location');
            var admin = $(this).data('admin');
            $('#business_name_input').val(business_name);
            $('#contact_name_input').val(contact_name);
            $('#contact_phone_input').val(contact_phone);
            $('#location_input').val(location);
            $('#admin_input').val(admin);
            $('#advertiser_update_form').attr('action', '/advertisers/' + id);
            $('#editAdvertiser').modal('show');
        })
        $('.advertiser_delete_button').on('click', function(){
            var id = $(this).data('id');
            $('#advertiser_delete_form').attr('action', '/advertisers/' + id);
            $('#deleteAdvertiser').modal('show');
        })
    })
</script>
@endsection
