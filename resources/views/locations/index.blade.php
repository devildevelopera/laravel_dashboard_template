@extends('layouts.master')

@section('page-title')
<title>Locations</title>
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
                            <botton  class="btn btn-brand btn-elevate btn-icon-sm" href = "#" data-toggle="modal" data-target="#createLocation">
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
                                    <td>Code</td>
                                    <td>Name</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($locations)
                                    @foreach ($locations->all() as $location)
                                    <tr>
                                        <td>{{ $location->id }}</td>
                                        <td>{{ $location->code }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>
                                            <button class="btn-sm btn btn-label-info btn-bold location_edit_button"  
                                                data-id="{{ $location->id ? $location->id : ''}}"
                                                data-code = "{{ $location->code ? $location->code : '' }}"
                                                data-name = "{{ $location->name ? $location->name : '' }}"
                                            ><i class="fa fa-edit"></i></button>
                                            <button class="btn-sm btn btn-label-danger btn-bold location_delete_button" 
                                             data-id="{{ $location->id ? $location->id : ''}}"
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
        <div class="modal fade" id="createLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "{{ url('locations') }}">
                        {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" name="code" placeholder="Enter code" required/>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" required />
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
        <div class="modal fade" id="editLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="location_update_form">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" id = "code_input" name="code" placeholder="Enter code"/>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id = "name_input" name="name" placeholder="Enter name"/>
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
        <div class="modal fade" id="deleteLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Really want to delete???</h5>
                    </div>
                    <form method="POST" id="location_delete_form">
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
        $('.location_edit_button').on('click', function(){
            var id =$(this).data('id')
            var code = $(this).data('code');
            var name = $(this).data('name');
            $('#code_input').val(code);
            $('#name_input').val(name);
            $('#editLocation').modal('show');
            $('#location_update_form').attr('action', '/locations/' + id);
        })
        $('.location_delete_button').on('click', function(){
            var id = $(this).data('id');
            $('#deleteLocation').modal('show');
            $('#location_delete_form').attr('action','/locations/' + id);
        })
    })
</script>
@endsection
