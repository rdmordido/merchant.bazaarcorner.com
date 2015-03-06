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
            <form id="form-update-merchant" method="post" action="/merchant/update/{{Auth::user()->id}}">            	
            	<input id="merchant_id" name="user_id" type="hidden" value="{{Auth::user()->id}}"/>
                <div id="update-user-success" class="alert alert-success alert-dismissable" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Success!</strong> Merchant informations has been updated
                </div>
            <div class="table-responsive">
                <table class="table">
                	<tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Merchant Name</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="name"></label>
	                            <input id="name" name="name" class="form-control" placeholder="name" value="{{Auth::user()->name}}"/>
	                        </div>
	                    </td>
	                </tr>
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
	                    <td style="vertical-align:middle;width:180px;"><label>Business Address</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="address"></label>
	                            <input id="address" name="address" class="form-control" placeholder="usiness address" value="{{Auth::user()->address}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Website</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="website"></label>
	                            <input id="website" name="website" class="form-control" placeholder="website url" value="{{Auth::user()->website}}"/>
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
	                    <td style="vertical-align:middle;width:180px;"><label>Facebook</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="facebook"></label>
	                            <input id="facebook" name="facebook" class="form-control" placeholder="facebook" value="{{Auth::user()->facebook}}"/>
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td style="vertical-align:middle;width:180px;"><label>Twitter</label></td>
	                    <td>
	                        <div class="form-group" style="margin:0px;">
	                            <label style="display:none;" class="control-label" for="twitter"></label>
	                            <input id="twitter" name="twitter" class="form-control" placeholder="twitter" value="{{Auth::user()->twitter}}"/>
	                        </div>
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