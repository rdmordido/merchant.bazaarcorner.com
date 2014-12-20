@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchant Informations</h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-user"></i> Merchant Informations</li>
        </ol>
    </div>    
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
        <div class="panel-heading">Update Informations&nbsp;</div>        
        <div class="panel-body">
            <form id="form-update-user" method="post" action="/user/{{Auth::user()->id}}">            	
            	<input id="user_id" name="user_id" type="hidden" value="{{Auth::user()->id}}"/>
                <div id="update-user-success" class="alert alert-success alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Success!</strong> Merchant informations has been updated
                </div>
            <div class="table-responsive">
                <table class="table">
                	<tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Username</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="username"></label>
	                            <input id="username" name="username" class="form-control" placeholder="username" value="{{Auth::user()->username}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Change Password</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="password"></label>
	                            <input id="password" name="password" type="password" class="form-control" placeholder="new password"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Confirm Password</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="password_confirmation"></label>
	                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="confirm new password"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>First Name</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="first_name"></label>
	                            <input id="first_name" name="first_name" class="form-control" placeholder="first name" value="{{Auth::user()->first_name}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Last Name</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="last_name"></label>
	                            <input id="last_name" name="last_name" class="form-control" placeholder="last name" value="{{Auth::user()->last_name}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Birthdate</label></td>
	                    <td>
	                        <div class="form-group">
	                            <div class="input-group">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input id="birthdate" name="birthdate" type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="@if(Auth::user()->birthdate != '' ) {{date('m/d/Y',strtotime(Auth::user()->birthdate))}} @endif">
	                            </div>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Email Address</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="email"></label>
	                            <input id="email" name="email" class="form-control" placeholder="email address" value="{{Auth::user()->email}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Contact Number</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="phone"></label>
	                            <input id="phone" name="phone" class="form-control" placeholder="contact number" value="{{Auth::user()->phone}}"/>
	                        </div>
	                    </td>
	                </tr>
	                
	                <tr>
	                    <td style="vertical-align:middle;"><label>Profile Image</label></td>
	                    <td>
	                    	<div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="profile_image"></label>
	                            <input type="hidden" id="profile_image" name="profile_image" value=""/>
	                        </div>
	                        <div style="margin-bottom:10px;position:relative;">
	                            <span class="btn btn-success btn-sm fileinput-button"><i class="glyphicon glyphicon-plus"></i><span>Upload an image...</span>
									<input id="upload_profile_image" type="file" name="file" data-url="<?=URL::to('/upload/profile')?>" style="cursor:pointer;">
								</span>
							</div>
                            <div id="fileupload-progress" class="progress" style="display:none;"><div class="progress-bar progress-bar-success"></div></div>
	                        <table id="uploaded_images" role="presentation" class="table table-striped"></table>
	                    </td>
	                </tr>
                	<tr><td colspan="2" style="text-align:center;"><button type="submit" class="btn btn-primary">Update</button></td></tr>
                </table>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@stop

@section('footer-js')
<script src="/assets/js/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/assets/js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/assets/js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/assets/js/plugins/daterangepicker/daterangepicker.js"></script>
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
$("#birthdate").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
</script>
@stop