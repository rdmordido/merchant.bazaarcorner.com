@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Discounts</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-pricetags"></i> Discounts</a></li>
            <li class="active">Manage Discounts</li>
        </ol>
    </div>
</div>
<div class="row">
              <div class="col-lg-12">
		<div class="panel panel-primary">
        <div class="panel-heading">Manage Discounts&nbsp;</div>        
            <div class="panel-body">
                <div class="table-responsive" style="overflow:hidden;">
                    <table id="merchant-discount-list" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:10%"></th>
                                <th style="width:40%">Title</th>
                                <th style="width:10%">Items</th>
                                <th style="width:5%">Active</th>
                                <th style="width:35%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($discount_list as $discount)
                            <tr>
                                <td class="center"><img src="{{getUploadedImageUrl('discount',$discount->image)->thumbUrl}}"/></td>
                                <td>{{$discount->title}}</td>
                                <td><span class="badge">{{$discount->items()->count()}}</span></td>
                                <td>{{($discount->is_active == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning available">Inactive</span>'}}</td>
                                <td class="center">
                                    
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-default" onClick="window.location='{{url("discount/$discount->id/items")}}'"><i class="fa fa-th-list"></i> Items</button>
                                        <button type="button" class="btn btn-sm btn-default btn-view-discount-details" discount-id="{{$discount->id}}" data-toggle="modal" data-target="#bc-merchant-modal"><i class="fa fa-search"></i> View</button>
                                        <button type="button" class="btn btn-sm btn-default" onClick="window.location='{{url("discount/$discount->id/edit")}}'"><i class="fa fa-edit"></i> Update</button>
                                        <button type="button" class="btn btn-sm btn-default btn-remove-discount" discount-id="{{$discount->id}}"><i class="fa fa-trash-o"></i> Remove</button>
                                    </div>
                                
                                    <!--
                                    <div class="btn-group">
                                        <a class="btn btn-app"><i class="fa fa-search-plus"></i> Update</a>
                                        <a class="btn btn-app"><i class="fa fa-edit"></i> Update</a>
                                        <a class="btn btn-app"><i class="fa fa-trash-o"></i> Remove</a>
                                    </div>
                                -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer-js')
<script src="/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
bc_merchant.init_datatables();
</script>

@stop