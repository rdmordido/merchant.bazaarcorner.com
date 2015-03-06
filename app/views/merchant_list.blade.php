@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Merchants</h1>
    </div>
</div>
<div class="row">
              <div class="col-lg-12">
		<div class="panel panel-primary">
        <div class="panel-heading">Merchant Listing&nbsp;</div>        
            <div class="panel-body">
                <div class="table-responsive" style="overflow:hidden;">
                    <table id="merchant-listing" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:10%">Id</th>
                                <th style="width:auto">Name</th>
                                <th style="width:auto">Default Username</th>
                                <th style="width:auto">Default Password</th>
                                <th style="width:auto">Website</th>
                                <th style="width:auto">Email Address</th>
                                <th style="width:auto;">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($merchants as $merchant)
                            <tr>
                                <td>{{$merchant->id}}</td>
                               <td>{{$merchant->name}}</td>
                               <td>{{$merchant->username}}</td>
                               <td>password</td>
                               <td>{{$merchant->website}}</td>
                               <td>{{$merchant->email}}</td>
                               <td>{{$merchant->phone}}</td>
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