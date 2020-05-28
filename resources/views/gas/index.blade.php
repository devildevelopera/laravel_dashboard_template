@extends('layouts.master')

@section('page-title')
<title>Gas</title>
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
                            <botton  class="btn btn-brand btn-elevate btn-icon-sm" href = "#" data-toggle="modal" data-target="#createGas">
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
                                    <td>Station</td>
                                    <td>Price Regular</td>
                                    <td>Price Mid</td>
                                    <td>Price Premium</td>
                                    <td>Price Diesel</td>
                                    <td>Updated Date</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($gas)
                                    @foreach ($gas->all() as $g)
                                    <tr>
                                        <td>{{ $g->id }}</td>
                                        <td>{{ $g && $g->station && $g->station->station_name ? $g->station->station_name :'' }}</td>
                                        <td>{{$g->price_regular}}</td>
                                        <td>{{$g->price_mid}}</td>
                                        <td>{{$g->price_premium}}</td>
                                        <td>{{$g->price_diesel}}</td>
                                        <td>{{$g->updated}}</td>
                                        <td>
                                            <button class="btn-sm btn btn-label-info btn-bold gas_edit_button"  
                                                data-id = "{{ $g->id ? $g->id : '' }}"
                                                data-station = "{{ $g->station->id ? $g->station->id : '' }}"
                                                data-priceregular = "{{ $g->price_regular ? $g->price_regular : '' }}"
                                                data-pricemid = "{{ $g->price_mid ? $g->price_mid : '' }}"
                                                data-pricepremium = "{{ $g->price_premium ? $g->price_premium : '' }}"
                                                data-pricediesel = "{{ $g->price_diesel ? $g->price_diesel : '' }}"
                                                data-updated = "{{$g->updated ? $g->updated : ''}}"
                                            ><i class="fa fa-edit"></i></button>
                                            <button class="btn-sm btn btn-label-danger btn-bold gas_delete_button" 
                                                data-id = "{{ $g->id ? $g->id : '' }}"
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
        <div class="modal fade" id="createGas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Gas Price Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action = "{{ url('gas') }}">
                        {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Station</label>
                                    <select class="form-control" name="station_id" id="exampleSelect1">
                                    @if($stations && count($stations) > 0)
                                        @foreach($stations as $station)
                                        <option value = "{{ $station && $station->id ? $station->id : '' }}">{{ $station && $station->station_name ? $station->station_name : '' }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price Regular</label>
                                    <input type="text" class="form-control" name="price_regular" placeholder="Enter price regular" required />
                                </div>
                                <div class="form-group">
                                    <label>Price Mid</label>
                                    <input type="text" class="form-control" name="price_mid" placeholder="Enter price mid" required />
                                </div>
                                <div class="form-group">
                                    <label>Price Premium</label>
                                    <input type="text" class="form-control" name="price_premium" placeholder="Enter price premium" required />
                                </div>
                                <div class="form-group">
                                    <label>Price Diesel</label>
                                    <input type="text" class="form-control" name="price_diesel" placeholder="Enter price diesel" required />
                                </div>
                                <div class="form-group">
                                    <label>Updated Date</label>
                                    <input type="date" class="form-control" name="updated" placeholder="Enter updated date" required />
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
        <div class="modal fade" id="editGas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Gas Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id ="gas_update_form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                            <div class="card-body">
                            <div class="form-group">
                                    <label>Station</label>
                                    <select class="form-control" name="station_id" id="station_input">
                                    @if($stations && count($stations) > 0)
                                        @foreach($stations as $station)
                                        <option value = "{{ $station && $station->id ? $station->id : '' }}">{{ $station && $station->station_name ? $station->station_name : '' }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Price Regular</label>
                                        <input type="text" class="form-control" id="price_regular_input" name="price_regular" placeholder="Enter price regular" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Price Mid</label>
                                        <input type="text" class="form-control" id="price_mid_input" name="price_mid" placeholder="Enter price mid" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Price Premium</label>
                                        <input type="text" class="form-control" id="price_premium_input" name="price_premium" placeholder="Enter price premium" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Price Diesel</label>
                                        <input type="text" class="form-control" id="price_diesel_input" name="price_diesel" placeholder="Enter price diesel" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Updated</label>
                                        <input type="date" class="form-control" id="updated_input" name="updated" placeholder="Enter updated date" required />
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
        <div class="modal fade" id="deleteGas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Gas Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Really want to delete???</h5>
                    </div>
                    <form method="POST"   id = "gas_delete_form" >
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
        $('.gas_edit_button').on('click', function(){
            var id = $(this).data('id');
            var station = $(this).data('station');
            var priceregular = $(this).data('priceregular');
            var pricemid = $(this).data('pricemid');
            var pricepremium = $(this).data('pricepremium');
            var pricediesel = $(this).data('pricediesel');
            var updated = $(this).data('updated');
            $('#station_input').val(station);
            $('#price_regular_input').val(priceregular);
            $('#price_mid_input').val(pricemid);
            $('#price_premium_input').val(pricepremium);
            $('#price_diesel_input').val(pricediesel);
            $('#updated_input').val(updated);
            $('#gas_update_form').attr('action', '/gas/'+ id);
            $('#editGas').modal('show');
        })
        $('.gas_delete_button').on('click', function(){
            var id = $(this).data('id');
            $('#gas_delete_form').attr('action', '/gas/' + id);
            $('#deleteGas').modal('show');
        })
    })
</script>
@endsection
