@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Items</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:;"><i class="ion ion-bag"></i> Items</a></li>
            <li class="active">Create New Item</li>
        </ol>
    </div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
        <div class="panel-heading">Create New Item&nbsp;</div>        
        <div class="panel-body">
            <form id="form-create-item" method="post" action="/item">
                <div id="create-item-success" class="alert alert-success alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Success!</strong> New Item has been created
                </div>
            <div class="table-responsive">
                <table class="table">
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Name</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_name">Item name is required</label>
	                            <input id="item_name" name="item_name" class="form-control" style="text-align:left;"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Price</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                        	<label style="display:none;" class="control-label" for="item_price">Price is required</label>
	                            <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input id="item_price" name="item_price" class="form-control">
                                </div>
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
	                                <option value="{{$discount->id}}">{{$discount->title}}</option>
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
	                                <option value="{{$brand->id}}">{{$brand->name}}</option>
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
	                                <option value="{{$category->id}}">{{$category->name}}</option>
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
                        		</select>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;"><label>Description</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="item_description">Description is required</label>
	                            <textarea id="item_description" name="item_description" class="form-control" rows="3" style="resize:none;height:120px;"></textarea>
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
                                <button id="fileupload-delete-all" type="button" class="btn btn-sm btn-danger delete" style="display:none;">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete All</span>
                                </button>
							</div>
							<div id="item-image-error" class="alert alert-danger alert-dismissable" style="display:none;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Please upload an image</strong></div>
                            <div id="fileupload-progress" class="progress" style="display:none;"><div class="progress-bar progress-bar-success"></div></div>
							<input id="item_primary_image" name="item_primary_image" type="hidden" value=""/>
                            <table id="uploaded_images" role="presentation" class="table table-striped">
							</table>
	                    </td>
	                </tr>
	                <?php /*
	                <tr>
	                    <td style="vertical-align:middle;"><label>Upload Video</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="profile_image"></label>
	                            <input type="hidden" id="profile_image" name="profile_image" value="{{Auth::user()->profile_image}}"/>	                            
	                        </div>
	                        <div style="position:relative;">
	                            <span class="btn btn-success btn-sm fileinput-button"><i class="glyphicon glyphicon-upload"></i><span>&nbsp;Add Video</span>
									<input id="upload-item-video" type="file" data-url="<?=URL::to('/upload/item_video')?>" style="cursor:pointer;">
								</span>
								<button id="delete-item-video" type="button" class="btn btn-sm btn-danger delete" style="cursor:pointer;display:none;">
                    				<i class="glyphicon glyphicon-trash"></i>
                    				<span>Delete</span>
                    			</button>
							</div>
                            <div id="fileupload-progress" class="progress" style="display:none;"><div class="progress-bar progress-bar-success"></div></div>
							<img id="item-video-preview" src=""/>
	                </tr>
	                */ ?>
                	<tr><td colspan="2" style="text-align:center;"><button type="submit" class="btn btn-primary">Create New Item</button></td></tr>
                </table>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@stop

@section('footer-js')
<script src="/assets/js/plugins/input-mask/jquery.inputmask.bundle.js"></script>

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

<script type="text/javascript">
$("#item_price").inputmask({alias:'currency'});
</script>
@stop