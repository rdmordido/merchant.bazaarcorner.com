@extends('layouts.merchant')
@section('content')
<div id="content-header" class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </div>    
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    150
                </h3>
                <p>
                    New Orders
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    53<sup style="font-size: 20px">%</sup>
                </h3>
                <p>
                    Sales Increase
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    44
                </h3>
                <p>
                    Followers
                </p>
            </div>
            <div class="icon">
                <i class="ion-ios-people-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    65
                </h3>
                <p>
                    Unique Visitors
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div>
 <div class="row">                        
    <section class="col-lg-6 connectedSortable"> 
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div>
        <div class="box box-warning">
            <div class="box-header">
                <i class="fa fa-calendar"></i>
                <div class="box-title">Calendar</div>
                
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                </div><!-- /. tools -->                                    
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div>
    </section>
    
    <section class="col-lg-6 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-right box-tools">                                        
                    <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                    <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                </div>
                <i class="fa fa-map-marker"></i>
                <h3 class="box-title">
                    Followers
                </h3>
            </div>
            <div class="box-body no-padding">
                <div id="world-map" style="height: 300px;"></div>
                <div class="table-responsive">
                    <!-- .table - Uses sparkline charts-->
                    <table class="table table-striped">
                        <tr>
                            <th>Country</th>
                            <th>Followers</th>
                            <th>Online</th>
                            <th>Page Views</th>
                        </tr>
                        <tr>
                            <td><a href="#">USA</a></td>
                            <td><div id="sparkline-1"></div></td>
                            <td>209</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td><a href="#">India</a></td>
                            <td><div id="sparkline-2"></div></td>
                            <td>131</td>
                            <td>958</td>
                        </tr>
                        <tr>
                            <td><a href="#">Britain</a></td>
                            <td><div id="sparkline-3"></div></td>
                            <td>19</td>
                            <td>417</td>
                        </tr>
                        <tr>
                            <td><a href="#">Brazil</a></td>
                            <td><div id="sparkline-4"></div></td>
                            <td>109</td>
                            <td>476</td>
                        </tr>
                        <tr>
                            <td><a href="#">China</a></td>
                            <td><div id="sparkline-5"></div></td>
                            <td>192</td>
                            <td>437</td>
                        </tr>
                        <tr>
                            <td><a href="#">Australia</a></td>
                            <td><div id="sparkline-6"></div></td>
                            <td>1709</td>
                            <td>947</td>
                        </tr>
                    </table><!-- /.table -->
                </div>
            </div><!-- /.box-body-->
            <div class="box-footer">
                <button class="btn btn-info"><i class="fa fa-download"></i> Generate PDF</button>
                <button class="btn btn-warning"><i class="fa fa-bug"></i> Report Bug</button>
            </div>
        </div>
    </section>
</div>
@stop

@section('footer-js')
<script src="/assets/js/plugins/morris/raphael.min.js"></script>
<script src="/assets/js/plugins/morris/morris.min.js"></script>
<script src="/assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>


<script src="/assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="/assets/js/plugins/jqueryKnob/jquery.knob.js"></script>
<script src="/assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/assets/js/plugins/iCheck/icheck.min.js"></script>
<script src="/assets/js/AdminLTE/app.js"></script>

<script src="/assets/js/AdminLTE/dashboard.js"></script>  
<script src="/assets/js/AdminLTE/demo.js"></script>
@stop