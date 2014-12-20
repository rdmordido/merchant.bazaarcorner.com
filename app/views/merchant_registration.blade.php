<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bazaarcorner Merchant Registration</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/timeline.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/AdminLTE.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/merchant.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/morris.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/JQueryFileUpload/jquery.fileupload.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/JQueryFileUpload/jquery.fileupload-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/packages/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/packages/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jvectormap/jquery-jvectormap-1.2.2.css"/>        
    <link rel="stylesheet" type="text/css" href="/assets/css/fullcalendar/fullcalendar.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/daterangepicker/daterangepicker-bs3.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>
    @section('header-css')
    @show
    <link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <div class="panel panel-default" style="margin-top:25px;">
                    <div class="panel-sgdc">
                        <a href="javascript:;" class="sgcd-logo" style="text-decoration:none;cursor:default;">Bazaarcorner</a>
                    </div>
                    <div class="panel-body">
                        <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Merchant Registration</h3>
                    </div>
                        <form id="form-create-merchant" method="post" action="/merchant/create">
                            <div id="create-merchant-success" class="alert alert-success alert-dismissable" style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Success!</strong> New Merchant has been created
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td style="vertical-align:middle;width:180px;"><label>Merchant Name</label></td>
                                        <td>
                                            <div class="form-group" style="margin:0px;">
                                                <label style="display:none;" class="control-label" for="merchant_name">Merchant name is required</label>
                                                <input id="merchant_name" name="merchant_name" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;width:180px;"><label>Username</label></td>
                                        <td>
                                            <div class="form-group" style="margin:0px;">
                                                <label style="display:none;" class="control-label" for="username">Username is required</label>
                                                <input id="username" name="username" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;width:180px;"><label>Password</label></td>
                                        <td>
                                            <div class="form-group" style="margin:0px;">
                                                <label style="display:none;" class="control-label" for="password">Password is required</label>
                                                <input type="password" id="password" name="password" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;width:180px;"><label>Confirm Password</label></td>
                                        <td>
                                            <div class="form-group" style="margin:0px;">
                                                <label style="display:none;" class="control-label" for="password_confirmation">Re-enter password</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:middle;width:180px;"><label>Email Address</label></td>
                                        <td>
                                            <div class="form-group" style="margin:0px;">
                                                <label style="display:none;" class="control-label" for="email">Email address is required</label>
                                                <input id="email" name="email" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Register" style="width:20%;margin-left:auto;margin-right:auto;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery.ui.widget.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="/assets/js/merchant.js"></script>
</body>

</html>
