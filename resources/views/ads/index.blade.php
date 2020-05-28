@extends('layouts.master')

@section('page-title')
<title>Ads</title>
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
                            <botton  class="btn btn-brand btn-elevate btn-icon-sm" href = "#" data-toggle="modal" data-target="#createAds">
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
                                    <td>Advertiser Business</td>
                                    <td>AD Image</td>
                                    <td>AD Size</td>
                                    <td>AD Target</td>
                                    <td>AD Action</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Admin Id</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($ads)
                                    @foreach ($ads->all() as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a && $a->advertiser && $a->advertiser->business_name ?  $a->advertiser->business_name : '' }}</td>
                                        <td>{{ $a->ad_image }}</td>
                                        <td>{{ $a->ad_size }}</td>
                                        <td>{{ $a->ad_target}}</td>
                                        <td>{{ $a->ad_action }}</td>
                                        <td>{{ $a->startdate}}</td>
                                        <td>{{ $a->enddate}}</td>
                                        <td>{{ $a->admin_id}}</td>
                                        <td>
                                            <button class="btn-sm btn btn-label-info btn-bold ads_edit_button"  
                                                data-id = "{{ $a->id ? $a->id : '' }}"
                                                data-advertiser = "{{ $a->advertiser->advertiser_id ? $a->advertiser->advertiser_id : '' }}"
                                                data-image = "{{$a->ad_image ? $a->ad_image : ''}}"
                                                data-size = "{{$a->ad_size ? $a->ad_size : ''}}"
                                                data-target = "{{$a->ad_target ? $a->ad_target : ''}}"
                                                data-action = "{{$a->ad_action ? $a->ad_action : ''}}"
                                                data-startdate = "{{$a->startdate ? $a->startdate : ''}}"
                                                data-enddate = "{{$a->enddate ? $a->enddate : ''}}"
                                                data-admin = "{{$a->admin_id ? $a->admin_id : ''}}"
                                            ><i class="fa fa-edit"></i></button>
                                            <button class="btn-sm btn btn-label-danger btn-bold ads_delete_button" 
                                                data-id = "{{ $a->id ? $a->id : '' }}"
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
        <div class="modal fade" id="createAds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Ads</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "{{ url('ads') }}">
                        {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Advertiser Business</label>
                                    <select class = "form-control" name = "advertiser_id">
                                        @if($advertisers && count($advertisers)>0)
                                            @foreach($advertisers as $advertiser)
                                            <option value = "{{ $advertiser && $advertiser->advertiser_id ? $advertiser->advertiser_id : '' }}">{{ $advertiser && $advertiser->business_name ? $advertiser->business_name : "" }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ad Image</label>
                                    <input type="text" class="form-control" name="ad_image" placeholder="Enter ad image" />
                                </div>
                                <div class="form-group">
                                    <label>Ad Size</label>
                                    <input type="text" class="form-control" name="ad_size" placeholder="Enter ad size"/>
                                </div>
                                <div class="form-group">
                                    <label>Ad Target</label>
                                    <input type="text" class="form-control" name="ad_target" placeholder="Enter ad target"/>
                                </div>
                                <div class="form-group">
                                    <label>Ad Action</label>
                                    <input type="text" class="form-control" name="ad_action" placeholder="Enter ad action"/>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" name="startdate" placeholder="Enter start date"/>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" name="enddate" placeholder="Enter end date"/>
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
        <div class="modal fade" id="editAds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Ads</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="post"  id = "ads_update_form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Advertiser Business</label>
                                    <select class = "form-control" name = "advertiser_id" id="advertiser_id_input">
                                        @if($advertisers && count($advertisers)>0)
                                            @foreach($advertisers as $advertiser)
                                            <option value = "{{ $advertiser && $advertiser->advertiser_id ? $advertiser->advertiser_id : '' }}">{{ $advertiser && $advertiser->business_name ? $advertiser->business_name : "" }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ad Image</label>
                                    <input type="text" class="form-control" id="ad_image_input" name="ad_image" placeholder="Enter ad image" />
                                </div>
                                <div class="form-group">
                                    <label>Ad Size</label>
                                    <input type="text" class="form-control" id="ad_size_input" name="ad_size" placeholder="Enter ad size"/>
                                </div>
                                <div class="form-group">
                                    <label>Ad Target</label>
                                    <input type="text" class="form-control" id="ad_target_input" name="ad_target" placeholder="Enter ad target"/>
                                </div>
                                <div class="form-group">
                                    <label>Ad Action</label>
                                    <input type="text" class="form-control" id="ad_action_input" name="ad_action" placeholder="Enter ad action"/>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="startdate_input" name="startdate" placeholder="Enter start date"/>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" id="enddate_input" name="enddate" placeholder="Enter end date"/>
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
        <div class="modal fade" id="deleteAds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Ads</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Really want to delete???</h5>
                    </div>
                    <form method="POST"   id = "ads_delete_form" >
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
        $('.ads_edit_button').on('click', function(){
            var ads_id = $(this).data('id');
            var advertiser = $(this).data('advertiser');
            var ad_image = $(this).data('image');
            var ad_size = $(this).data('size');
            var ad_target = $(this).data('target');
            var ad_action = $(this).data('action');
            var startdate = $(this).data('startdate');
            var enddate = $(this).data('enddate');
            var admin = $(this).data('admin');
            $('#advertiser_id_input').val(advertiser);
            $('#ad_image_input').val(ad_image);
            $('#ad_size_input').val(ad_size);
            $('#ad_target_input').val(ad_target);
            $('#ad_action_input').val(ad_action);
            $('#startdate').val(startdate);
            $('#enddate').val(enddate);
            $('#admin_input').val(admin);
            $('#ads_update_form').attr('action', "/ads/"+ ads_id);
            $('#editAds').modal('show');
        })
        $('.ads_delete_button').on('click', function(){
            var ads_id = $(this).data('id');
            $('#ads_delete_form').attr('action', "/ads/"+ ads_id);
            $('#deleteAds').modal('show');
        })
    })
</script>
@endsection
