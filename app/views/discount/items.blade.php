@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Discounts</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-pricetags"></i> Discounts</a></li>
            <li><a href="/discount">Manage Discounts</a></li>
            <li class="active">Items</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{$discount->title}}</h3>
            </div>
            <div class="panel-body">
                <table class="table" border="0">
                    <tr>
                        <th width="200">Type</th>
                        <td>{{$discount->type}}</td>
                    </tr>
                    @if($discount->type == 'price')
                    <tr>
                        <th>Less Price</th>
                        <td>{{$discount->price}}</td>
                    </tr>
                    @elseif($discount->type == 'rate')
                    <tr>
                        <th>Less Rate</th>
                        <td>{{$discount->rate}}% Off</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Start</th>
                        <td>{{date('m/d/Y',strtotime($discount->start))}}</td>
                    </tr>
                    <tr>
                        <th>End</th>
                        <td>{{date('m/d/Y',strtotime($discount->end))}}</td>
                    </tr>
                    <tr>
                        <th>Created on</th>
                        <td>{{date('m/d/Y H:i:s',strtotime($discount->created_at))}}</td>
                    </tr>
                    <tr>
                        <th>Last Modified</th>
                        <td>{{date('m/d/Y H:i:s',strtotime($discount->updated_at))}}</td>
                    </tr>
                </table>

                <div class="margin">
                <!--
                    <button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Items</button>
                    <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i> Deactivate</button>
                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Remove</button>
                    <button type="button" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Update Details</button>
                -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive" style="overflow:hidden;">
                                    <table id="merchant-discount-item-list" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Orig Price</th>
                                                <th>List Price</th>
                                                <th>Brand</th>
                                                <th>Main Category</th>
                                                <th>Sub Category</th>
                                                <th style="width:165px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($discount->items()->get() as $item)
                                            <tr>
                                                <td class="center"><img src="{{getUploadedImageUrl('item',$item->getItemPrimaryImage()->name)->thumbUrl}}"/></td>
                                                <td>{{$item->name}}</td>
                                                <td>@currency($item->price)</td>
                                                <td>@currency($item->getItemListPrice())</td>
                                                <td>{{$item->brand->name or 'None'}}</td>
                                                <td>{{$item->getItemMainCategory()->name}}</td>
                                                <td>{{$item->getItemSubCategory()->name or 'None'}}</td>
                                                <td class="center">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-default" onClick="window.location='{{url("item/$item->id")}}'"><i class="fa fa-search"></i> View</button>
                                                        <button type="button" class="btn btn-sm btn-default" onClick="window.location='{{url("item/$item->id/edit")}}'"><i class="fa fa-edit"></i> Update</button>
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