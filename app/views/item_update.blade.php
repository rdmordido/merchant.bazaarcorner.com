@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Items</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-bag"></i> Items</a></li>
            <li><a href="/item">Manage Items</a></li>
            <li class="active">Update Item Details</li>
        </ol>
    </div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
        <div class="panel-heading">Update Item Details&nbsp;</div>        
        <div class="panel-body">
            <form id="form-update-item" method="post" action="/item">
            	<input type="hidden" id="merchant_id" name="merchant_id" value="{{Auth::user()->id}}"/>
            	<input type="hidden" id="item_id" name="item_id" value="{{$item->id}}"/>
                <div id="update-item-success" class="alert alert-success alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Success!</strong> Item Details has been updated
                </div>
            <div class="table-responsive">
                <table class="table">
                	<tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Id</label></td>
	                    <td><strong>{{$item->id}}</strong></td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Name</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_name">Item name is required</label>
	                            <input id="item_name" name="item_name" class="form-control" value="{{$item->name}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Price</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_price">Price is required</label>
	                            <input id="item_price" name="item_price" class="form-control" value="{{$item->price}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Discount</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <select id="item_discount" name="item_discount" class="form-control">
	                            	<option value="">None</option>
	                            	@foreach($discount_list as $discount)
	                                <option value="{{$discount->id}}" @if($item->discount_id != '' && $discount->id == $item->discount_id) selected @endif>{{$discount->title}}</option>
	                                @endforeach
                        		</select>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Brand</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_brand">Brand name is required</label>	                            
	                            <select id="item_brand" name="item_brand" class="form-control">
	                            	<option value="">Select Brand Name</option>
	                            	@foreach($brand_list as $brand)
	                                <option value="{{$brand->id}}" @if($brand->id == $item->brand->id) selected @endif>{{$brand->name}}</option>
	                                @endforeach
                        		</select>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Main Category</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_main_category">Main Category is required</label>	                            
	                            <select id="item_main_category" name="item_main_category" class="form-control">
	                                <option value="">Select Main Category</option>
	                                @foreach($main_categories as $category)
	                                <option value="{{$category->id}}" @if($category->id == $item->main_category->id) selected @endif>{{$category->name}}</option>
	                                @endforeach
                        		</select>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Sub Category</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_sub_category">Sub Category is required</label>	                            
	                            <select id="item_sub_category" name="item_sub_category" class="form-control">
	                                <option value="">Select Sub Category</option>
	                                @foreach($sub_categories as $category)
	                                <option value="{{$category->id}}" @if($category->id == $item->sub_category->id) selected @endif>{{$category->name}}</option>
	                                @endforeach
                        		</select>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Description</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_description">Description is required</label>
	                            <textarea id="item_description" name="item_description" class="form-control" rows="3" style="resize:none;height:120px;">{{$item->description}}</textarea>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Upload Images</label></td>
	                    <td>
	                        <div style="margin-bottom:10px;position:relative;">
	                            <span class="btn btn-success btn-sm fileinput-button"><i class="glyphicon glyphicon-plus"></i><span>Add images...</span>
									<input id="upload_item_image" type="file" name="files[]" multiple data-url="<?=URL::to('/upload/item')?>" style="cursor:pointer;">
								</span>
                                <button id="fileupload-delete-all" type="button" class="btn btn-sm btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete All</span>
                                </button>
							</div>
							<div id="item-image-error" class="alert alert-danger alert-dismissable" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Please upload an image</strong></div>
                            <div id="fileupload-progress" class="progress" style="display:none;"><div class="progress-bar progress-bar-success"></div></div>
							<input id="item_primary_image" name="item_primary_image" type="hidden" value="{{$item->primary_image->name}}"/>
                            <table id="uploaded_images" role="presentation" class="table table-striped">
                            	<tbody>
                            		@foreach($item->images()->orderBy('is_primary','desc')->get() as $image)
                            		<tr class="fileupload-item template-upload fade in">
                            			<td><span class="preview"><img src="{{getUploadedImageUrl('item',$image->name)->thumbUrl}}"/></span></td>
                            			<td>
                            				<input name="item_images[]" class="image-name" type="hidden" value="{{$image->name}}">
                            				<p class="name">{{$image->name}}</p><strong class="error text-danger"></strong></td>
                            			<td>
                            				<button type="button" class="btn-set-as-primary btn btn-sm btn-info" style="@if($image->is_primary == 1) display:none; @endif">
                            					<i class="glyphicon glyphicon-ok"></i>
                            					<span>Set as Primary</span>
                            				</button>
                            			</td>
                            			<td>
                            				<button type="button" class="btn-delete-fileupload btn btn-sm btn-danger delete" delete-url="/upload/item/?file={{$image->name}}" style="cursor:pointer;">
                            					<i class="glyphicon glyphicon-trash"></i><span>Delete</span>
                            				</button>
                            			</td>
                            		</tr>
                            		@endforeach
                            	</tbody>
							</table>
	                    </td>
	                </tr>


                	<tr><td colspan="2" style="text-align:center;"><button type="submit" class="btn btn-primary">Update Item Details</button></td></tr>
                </table>
            </div>
            </form>
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