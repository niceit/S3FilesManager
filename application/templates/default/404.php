<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Not Found | Pretty S3 Files Manager</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>/assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">

        <div class="main_container">

            <!-- page content -->
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        <h1 class="error-number">404</h1>
                        <h2>Sorry but we couldnt find this page</h2>
                        <p>This page you are looking for does not exsist <a href="#">Report this?</a>
                        </p>
                        <div class="mid_center">
                            <a href="<?php echo $AppConfig->params('siteUrl') ?>" class="btn btn-primary">
                                <i class="fa fa-backward"> </i>
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

        </div>
        <!-- footer content -->
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/icheck/icheck.min.js"></script>

    <script src="<?php echo $AppConfig->params('siteUrl') . $AppConfig->params('URL_Root') ?>js/custom.js"></script>

    <!-- /footer content -->
</body>

</html>