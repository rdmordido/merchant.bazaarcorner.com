@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Items</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-bag"></i> Items</a></li>
            <li><a href="/item">Manage Items</a></li>
            <li class="active">Item Details</li>
        </ol>
    </div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
        <div class="panel-heading">Item Details&nbsp;</div>        
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                	<tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Id</label></td>
	                    <td><strong>{{$item->id}}</strong></td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Name</label></td>
	                    <td>{{$item->name}}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Price</label></td>
	                    <td>@currency($item->price)</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Discount</label></td>
	                    <td>{{$item->discount->name or 'None'}}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Main Category</label></td>
	                    <td>{{$item->main_category->name}}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Sub Category</label></td>
	                    <td>{{$item->sub_category->name or 'None'}}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Brand</label></td>
	                    <td>{{$item->brand->name or 'None'}}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Description</label></td>
	                    <td>{{$item->description or '' }}</td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Upload Images</label></td>
	                    <td>
                            <table id="uploaded_images" role="presentation" class="table table-striped">
                            	<tbody>
                            		@foreach($item->images()->orderBy('is_primary','desc')->get() as $image)
                            		<tr class="template-upload fade in">
                            			<td><span class="preview"><img src="{{getUploadedImageUrl('item',$image->name)->thumbUrl}}"/></span></td>
                            			<td><p class="name">{{$image->name}}</p><strong class="error text-danger"></strong></td>
                            			<td></td>
                            			<td></td>
                            		</tr>
                            		@endforeach
                            	</tbody>
							</table>
	                    </td>
	                </tr>
                	<tr>
	                	<td colspan="2" style="text-align:center;">
	                		<button type="button" class="btn btn-default" onClick="window.location='{{url("item")}}'">Back</button>
	                		<button type="button" class="btn btn-primary" onClick="window.location='{{url("item/$item->id/edit")}}'">Update Item Details</button>
	                	</td>
                	</tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('footer-js')
<script src="/assets/js/plugins/JQueryFileUpload/jquery.fileupload.js"></script>
<script src="/assets/js/plugins/JQueryFileUpload/jquery.iframe-transport.js"></script>
<script src="/assets/js/plugins/JQueryFileUpload/jquery.fileupload-process.js"></script>
<script src="/assets/js/plugins/JQueryFileUpload/jquery.fileupload-validate.js"></script>
<script src="/assets/js/plugins/JQueryFileUpload/jquery.fileupload-ui.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="/assets/js/plugins/JQueryFileUpload/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script src="/assets/js/fileupload.js"></script>
@stop