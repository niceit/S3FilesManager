<!DOCTYPE html>
<html lang="en">

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
    a
<body class="nav-md">
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
                                    <a href="<?php echo $this->baseUrl ?>/index.php?route=home/setting">
                                        <i class="fa fa-step-forward"></i>
                                        1. License agreement
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->baseUrl ?>/index.php?route=home/change-password">
                                        <i class="fa fa-step-forward"></i>
                                        2. Requirement checking
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->baseUrl ?>/index.php?route=home/logout">
                                        <i class="fa fa-step-forward"></i>
                                        3. Application settings
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->baseUrl ?>/index.php?route=home/logout">
                                        <i class="fa fa-step-forward"></i>
                                        4. Finish
                                    </a>
                                </li>
                            </ul>
                        </div>a
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

                                    </div>
                                    <div id="step-2">
                                        <h2 class="StepTitle">Step 2 Content</h2>
                                        <p>
                                            do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-3">
                                        <h2 class="StepTitle">Step 3 Content</h2>
                                        <p>
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-4">
                                        <h2 class="StepTitle">Step 4 Content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
                        Copyright &copy; 2106 | <b>Pretty S3 Files Manager</b> script.
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
    <script type="text/javascript">
        $('#wizard').smartWizard();

        function onFinishCallback() {
            $('#wizard').smartWizard('showMessage', 'Finish Clicked');
            //alert('Finish Clicked');
        }
    </script>
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
</body>

</html>
