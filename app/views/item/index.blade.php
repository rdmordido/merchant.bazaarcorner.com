@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Items</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-bag"></i> Items</a></li>
            <li class="active">Manage Items</li>
        </ol>
    </div>
</div>
<div class="row">
              <div class="col-lg-12">
		<div class="panel panel-primary">
        <div class="panel-heading">Manage Items&nbsp;</div>        
            <div class="panel-body">
                <div class="table-responsive" style="overflow:hidden;">
                    <table id="merchant-item-list" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th style="text-align:center;width:210px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($items as $item)
                            <tr>
                                <td class="center"><img src="{{$item->primary_image->thumbUrl}}"/></td>
                                <td>{{$item->name}}</td>
                                <td>@currency($item->price)</td>
                                <td>{{$item->brand->name or ''}}</td>
                                <td>{{$item->main_category->name}}</td>
                                <td>{{$item->sub_category->name}}</td>
                                <td class="center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-default btn-view-item-details" item-id="{{$item->id}}" data-toggle="modal" data-target="#bc-merchant-modal"><i class="fa fa-search"></i> View</button>
                                        <button type="button" class="btn btn-sm btn-default" onClick="window.location='{{url("item/$item->id/edit")}}'"><i class="fa fa-edit"></i> Update</button>
                                        <button type="button" class="btn btn-sm btn-default btn-remove-item" item-id="{{$item->id}}"><i class="fa fa-trash-o"></i> Remove</button>
                                    </div>
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