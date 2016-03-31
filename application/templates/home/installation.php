<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo $this->baseUrl;  ?>" />
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <title>Pretty S3 File Managers</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo $this->assetsUrl ?>/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $this->assetsUrl ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $this->assetsUrl ?>/css/animate.min.css" rel="stylesheet">
    <!-- select2 -->
    <link href="<?php echo $this->assetsUrl ?>/css/select/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $this->assetsUrl ?>/upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="<?php echo $this->assetsUrl ?>/upload/css/jquery.fileupload-ui.css">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo $this->assetsUrl ?>/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl ?>/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?php echo $this->assetsUrl ?>/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo $this->assetsUrl ?>/css/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo $this->assetsUrl ?>/js/jquery.min.js"></script>
    <script src="<?php echo $this->assetsUrl ?>/js/nprogress.js"></script>
    <!-- select2 -->
    <script src="<?php echo $this->assetsUrl ?>/js/select/select2.full.js"></script>
    <script src="<?php echo $this->assetsUrl ?>/js/global.js"></script>

    <script>
        NProgress.start();
    </script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="nav-md">
    <input type="hidden" name="site_url" value="<?php echo str_replace('/assets/', '', $this->assetsUrl) ?>">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo $this->baseUrl;  ?>" class="site_title"><i class="fa fa-home"></i> <span>Installation</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo $this->assetsUrl ?>/images/1459167985_users-13.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Installation progress</span>
                            <h2></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />
                    <div class="clearfix"></div>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li>
                                    <a class="left-installation-steps step1 active" href="javascript:;">
                                        <i class="fa fa-step-forward"></i>
                                        1. License agreement
                                    </a>
                                </li>
                                <li>
                                    <a class="left-installation-steps step2" href="javascript:;">
                                        <i class="fa fa-step-forward"></i>
                                        2. Requirement checking
                                    </a>
                                </li>
                                <li>
                                    <a class="left-installation-steps step3" href="javascript:;">
                                        <i class="fa fa-step-forward"></i>
                                        3. Application settings
                                    </a>
                                </li>
                                <li>
                                    <a class="left-installation-steps step4" href="javascript:;">
                                        <i class="fa fa-step-forward"></i>
                                        4. Finish
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>
                                    <i class="fa fa-bars"> </i>
                                    &nbsp;
                                    Welcome to Pretty S3 Files Manager Installation Progress
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!-- Smart Wizard -->
                                <div id="wizard" class="form_wizard wizard_horizontal">
                                    <ul class="wizard_steps">
                                        <li>
                                            <a href="#step-1">
                                                <span class="step_no">1</span>
                                                <span class="step_descr">
                                        Step 1<br />
                                        <small>License agreement</small>
                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-2">
                                                <span class="step_no">2</span>
                                                <span class="step_descr">
                                        Step 2<br />
                                        <small>Requirement checking</small>
                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-3">
                                                <span class="step_no">3</span>
                                                <span class="step_descr">
                                        Step 3<br />
                                        <small>Application settings</small>
                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-4">
                                                <span class="step_no">4</span>
                                                <span class="step_descr">
                                        Step 4<br />
                                        <small>Finish</small>
                                    </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="step-1">
                                        Thanks you for purchasing <b>Pretty S3 Files Manager</b> it's designed to help people can manage Amazon S3 Cloud
                                        Files at their own hosting in just some easy steps and don't need to login to Cloud when they want to manage/change
                                        something there. Some of support features will be listed below so you can track, a better feature we are currently
                                        developing and will release in next build, by the way don't hesitate to contact us and provide your idea to help
                                        us improve it, that would be appreciated and we always have awards for the good idea!
                                        <p>&nbsp;</p>
                                        <p><b>What news in this release : </b></p>
                                        <ul style="list-style: none;">
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Fully Ajax Support
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Support multiple buckets, manage/create bucket
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Support multiple buckets, manage/create folder
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Support manage folders/sub-folder and permissions
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Ajax file upload directly to S3
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Manage/add/delete file also multiple file selection
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Manage object/file properties and permissions
                                            </li>
                                            <li>
                                                <i class="fa fa-check-circle"> </i>
                                                Administrative login security
                                            </li>
                                        </ul>
                                        <p>&nbsp;</p>
                                        <h4>License agreement</h4>
                                        <div class="license-agreement" ">
                                            <p>
                                                <b>Pretty S3 Files Manager</b> is developed under Amazon S3 API V3 and GNU license, by
                                                purchasing this software you are allowed to copy and install it into your system and using it according to your purpose. You are not
                                                allowed to re-public it under another purpose by modifying code and rename it to your own, we will remove all supporting services if system
                                                detects that you do an unauthorized stuff.
                                            </p>
                                            <p>As our customers we will do the best to support you. Thanks you!</p>
                                            <p class="form-horizontal">
                                                <div class="form-group">
                                                    <input class="flat" type="checkbox" name="license_checkbox" value="1">
                                                    <label class="control-label">I have read and agree with software's license</label>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="step-2">
                                        <h3 class="StepTitle">
                                            <i class="fa fa-question-circle"> </i>
                                            System requirement check
                                        </h3>
                                        <div class="requirement-checking-content">
                                        </div>
                                    </div>
                                    <div id="step-3" style="overflow: hidden;">
                                        <h3 class="StepTitle">
                                            <i class="fa fa-cog"> </i>
                                            Configuration
                                        </h3>
                                        <form class="form-horizontal form-label-left setting-form" name="setting_form">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Site URL</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="text" name="setting[url]" value="<?php echo str_replace('/assets/', '', $this->assetsUrl) ?>">
                                                    <br>
                                                    <p class="small">
                                                        This Site URL is automatic detected by your request URI. By changing this maybe cause problems.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <h4>Amazon S3 Settings:</h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">App Key</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="text" name="setting[app_id]" value="" placeholder="Put your S3 App Key Here">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Secret Key</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="text" name="setting[app_secret]" value="" placeholder="Put your S3 Secret Key Here">
                                                    <br>
                                                    <p>&nbsp;</p>
                                                    <p class="small">
                                                        Don't know to obtain Amazon S3 Cloud App Key and Secret?
                                                        <a class="btn btn-info btn-sm" href="#s3-key-instruction" data-toggle="modal" data-modal="#s3-key-instruction">
                                                            <i class="fa fa-book"> </i>
                                                            Follow this instruction
                                                        </a>.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Region</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php $regions = AppS3::getAvailableRegions() ?>
                                                    <select name="setting[region]" class="region form-control" tabindex="-1">
                                                        <option value="">Choose Region</option>
                                                        <?php foreach ($regions as $key => $region) : ?>
                                                            <option value="<?php echo $key ?>"><?php echo '(' . $key . ') ' . $region ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <br>
                                                    <p>
                                                        <b>Important:</b> Please choose the correct region which you registered at Amazon S3 Service.
                                                        If you use a region other than the US East (N. Virginia) endpoint to create a bucket, you must set the LocationConstraint bucket parameter to the same region.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <a href="javascript:;" class="btn btn-primary btn-sm" id="btn-connect-cloud">
                                                        <i class="fa fa-plug"> </i>
                                                        Connect to S3 Cloud
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Bucket</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name="setting[bucket]" class="region form-control" tabindex="-1">
                                                        <option value="">Choose Bucket</option>
                                                    </select>
                                                    <br>
                                                    <p class="small">
                                                        Click connect button above to list available bucket.
                                                        <br>
                                                        Choose a bucket and set it for default launching at Dashboard. You can change it later too at setting page.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <h4>Account Login Settings:</h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Login name</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="text" name="setting[username]" value="" placeholder="Your login username">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="password" name="setting[password]" value="" placeholder="******">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Re-type Password</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" type="password" name="setting[re_password]" value="" placeholder="******">
                                                    <br>
                                                    <p class="small">
                                                        Keep this in safe place for future login session.
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="step-4">
                                        <h2 class="StepTitle">
                                            <i class="fa fa-check"> </i>
                                            Finished!
                                        </h2>
                                        <p>Congratulation! All configurations had been set and ready to launch the application now.</p>
                                        <p><b>Keep in safe your login information below: </b></p>
                                        <p>&nbsp;</p>
                                        <ul>
                                            <li>
                                                Username: <b id="login-username"></b>
                                            </li>
                                            <li>
                                                Password: <b id="login-password"></b>
                                            </li>
                                        </ul>
                                        <p align="center">
                                            <a href="<?php echo str_replace('/assets/', '', $this->assetsUrl) ?>/" class="btn btn-success">
                                                <i class="fa fa-forward"> </i>
                                                Process to Dashboard
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <!-- End SmartWizard Content -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->

                <footer>
                    <p align="center">
                        Copyright &copy; 2106 | <b>Pretty S3 Files Manager</b> script. For more supports, feel free to contact us at <a href="mailto:support@phprocket.com">support@phprockets.com</a>
                    </p>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo $this->assetsUrl ?>/js/bootstrap.min.js"></script>

    <!-- gauge js -->
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/gauge/gauge.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/gauge/gauge_demo.js"></script>
    <!-- chart js -->
    <script src="<?php echo $this->assetsUrl ?>/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo $this->assetsUrl ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo $this->assetsUrl ?>/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo $this->assetsUrl ?>/js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/datepicker/daterangepicker.js"></script>

    <script src="<?php echo $this->assetsUrl ?>/js/custom.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/date.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/wizard/jquery.smartWizard.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/installation.js"></script>
    <script>
        $(document).ready(function () {
            // [17, 74, 6, 39, 20, 85, 7]
            //[82, 23, 66, 9, 99, 6, 2]
            var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];

            var data2 = [[gd(2012, 1, 1), 82], [gd(2012, 1, 2), 23], [gd(2012, 1, 3), 66], [gd(2012, 1, 4), 9], [gd(2012, 1, 5), 119], [gd(2012, 1, 6), 6], [gd(2012, 1, 7), 9]];
            $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                data1, data2
            ], {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                },
                colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                xaxis: {
                    tickColor: "rgba(51, 51, 51, 0.06)",
                    mode: "time",
                    tickSize: [1, "day"],
                    //tickLength: 10,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Verdana, Arial',
                    axisLabelPadding: 10
                    //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
                },
                yaxis: {
                    ticks: 8,
                    tickColor: "rgba(51, 51, 51, 0.06)",
                },
                tooltip: false
            });

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
        });
    </script>

    <!-- worldmap -->
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script>
        $(function () {
            $('#world-map-gdp').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#E6F2F0', '#149B7E'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function (e, el, code) {
                    el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>
    <!-- skycons -->
    <script src="<?php echo $this->assetsUrl ?>/js/skycons/skycons.js"></script>
    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>

    <!-- dashbord linegraph -->
    <script>
        var doughnutData = [
            {
                value: 30,
                color: "#455C73"
            },
            {
                value: 30,
                color: "#9B59B6"
            },
            {
                value: 60,
                color: "#BDC3C7"
            },
            {
                value: 100,
                color: "#26B99A"
            },
            {
                value: 120,
                color: "#3498DB"
            }
        ];
        var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    </script>
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <script>
        NProgress.done();
    </script>
    <!-- /datepicker -->

    <!-- PNotify -->
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/notify/pnotify.nonblock.js"></script>

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="<?php echo $this->assetsUrl ?>/upload/js/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="<?php echo $this->assetsUrl ?>/upload/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->


    <!-- /footer content -->
    <div id="error-popup" data-backdrop="static" data-keyboard="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div style="width: 80%" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title title-popup"  id="myModalLabel2">Oop! Something wrong. Error from server: </h4>
                </div>
                <div class="modal-body" id="content-detail">
                    <div class="alert alert-error" style="word-wrap: break-word;"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="s3-key-instruction" data-backdrop="static" data-keyboard="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div style="width: 80%" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title title-popup"  id="myModalLabel2">
                        How to manage S3 Key and Secret?
                    </h4>
                </div>
                <div class="modal-body" id="content-detail">
                    <p class="entry-content">
                    <h2>How to Retrieve IAM Access Keys</h2>
                    <div>
                        1. Go to&nbsp;<strong><a href="https://www.amazon.com/ap/signin?openid.assoc_handle=aws&amp;openid.return_to=https%3A%2F%2Fsignin.aws.amazon.com%2Foauth%3Fresponse_type%3Dcode%26client_id%3Darn%253Aaws%253Aiam%253A%253A015428540659%253Auser%252Fhomepage%26redirect_uri%3Dhttps%253A%252F%252Fconsole.aws.amazon.com%252Fconsole%252Fhome%253Fstate%253DhashArgs%252523%2526isauthcode%253Dtrue%26noAuthCookie%3Dtrue&amp;openid.mode=checkid_setup&amp;openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&amp;openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&amp;openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&amp;action=&amp;disableCorpSignUp=&amp;clientContext=&amp;marketPlaceId=&amp;poolName=&amp;authCookies=&amp;pageId=aws.ssop&amp;siteState=registered%2Cen_US&amp;accountStatusPolicy=P1&amp;sso=&amp;openid.pape.preferred_auth_policies=MultifactorPhysical&amp;openid.pape.max_auth_age=120&amp;openid.ns.pape=http%3A%2F%2Fspecs.openid.net%2Fextensions%2Fpape%2F1.0&amp;server=%2Fap%2Fsignin%3Fie%3DUTF8&amp;accountPoolAlias=&amp;forceMobileApp=0&amp;language=en_US&amp;forceMobileLayout=0" target="_blank">Amazon Web Services</a></strong>
                        console<strong>&nbsp;</strong>
                        and&nbsp;click on the name of your account (it is located in the top right corner of the console).
                        In the expanded drop-down list, select <strong>Security Credentials.</strong>&nbsp;
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/11.png" alt="1" width="421" height="242" >
                        </p>
                    </div>
                    <div>
                        2. Click the&nbsp;<strong>Get Started with IAM Users&nbsp;</strong>button.
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/2015-06-01-13_55_24-IAM-Management-Console.png" alt="2015-06-01 13_55_24-IAM Management Console" width="756" height="199">
                        </p>
                    </div>
                    <div>
                        3. This will bring you&nbsp;to the<strong> IAM Dashboard</strong>&nbsp;where you can manage IAM users and their&nbsp;permissions like creating new IAM users, adding IAM users to the custom groups, granting them a certain level of permissions,&nbsp;etc.
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/56.png" alt="56" width="808" height="258">
                        </p>
                    </div>
                    <div>
                        4. To review the IAM access keys, select a particular IAM user and go to&nbsp;<strong>User Actions</strong> &gt; <strong>Manage Access Keys</strong>
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/drop_down_menu_keys.png" alt="drop_down_menu_keys" width="394" height="288">
                        </p>
                    </div>
                    <div>
                        5. You will see a&nbsp;list of Access Keys for the IAM user.
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/note.png" alt="note!" width="616" height="361">
                        </p>
                        <strong>Note:</strong>&nbsp;
                        You cannot retrieve the existing secret keys. You can see the secret key only once immediately after creating. So, in order to get&nbsp;a&nbsp;secret key, you will need to create a new one.</p>
                    </div>
                    <div>
                        6. Click <strong>Create Access Key</strong> to create a new key
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/note_2.png" alt="note!_2" width="622" height="364">
                        </p>
                    </div>
                    <div>
                        7.&nbsp;The new access keys will be generated and displayed on the screen.&nbsp;
                        <p align="center">
                            <img src="<?php echo $this->assetsUrl ?>/images/s3/123457547.png" alt="123457547" width="751" height="345">
                        </p>
                        <span style="color: #ff0000;"><strong>Attention!</strong></span>&nbsp;
                        If you do not write down the key or download&nbsp;the key file to your computer before you press "Close" or "Cancel" you will not be able to retrieve the secret key in future. Then you'll have to delete the keys which you created start to create new keys.
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
