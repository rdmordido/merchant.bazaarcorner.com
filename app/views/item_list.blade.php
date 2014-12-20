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
                                <th style="width:165px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($items_list as $item)
                            <tr>
                                <td class="center"><img src="{{getUploadedImageUrl('item',$item->primary_image->name)->thumbUrl}}"/></td>
                                <td>{{$item->name}}</td>
                                <td>@currency($item->price)</td>
                                <td>{{$item->brand->name}}</td>
                                <td>{{$item->main_category->name}}</td>
                                <td>{{$item->sub_category->name}}</td>
                                <td class="center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          Actions
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                          <li><a class="btn-view-item-details" item-id="{{$item->id}}" href="javascript:;" data-toggle="modal" data-target="#bc-merchant-modal">View Details</a></li>
                                          <li><a href="/item/{{$item->id}}/edit">Update</a></li>
                                          <li><a class="btn-remove-item" item-id="{{$item->id}}" href="javascript:;">Remove</a></li>
                                        </ul>
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