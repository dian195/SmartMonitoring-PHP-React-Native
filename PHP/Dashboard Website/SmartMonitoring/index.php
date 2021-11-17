<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />

    <title>Smart Monitoring</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="assets/img/favicons/favicon.png" />
    <!-- END Icons -->
    <!-- Stylesheets -->
    <!-- Web fonts -->
    <link rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700" />

    <!-- Bootstrap and OneUI CSS framework -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" id="css-main" href="assets/css/oneui.css" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>
<body>
    <div id="page-container"
         class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
        <!-- Sidebar -->
        <nav id="sidebar">
            <!-- Sidebar Scroll Container -->
            <div id="sidebar-scroll">
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="side-header side-content bg-white-op">
                        <button class="btn btn-link text-gray pull-right hidden-md hidden-lg"
                                type="button"
                                data-toggle="layout"
                                data-action="sidebar_close">
                            <i class="fa fa-times"></i>
                        </button>
                        <a class="h5 text-white" href="index.php">
                            <i class="fa fa-circle-o-notch text-primary"></i><span class="h4 font-w600 sidebar-mini-hide">&nbsp;&nbsp;Smart Monitoring</span>
                        </a>
                    </div>
                    <div class="side-content">
                        <ul class="nav-main">
                            <li>
                                <a href="index.php?m=Pages&p=location1">
                                    <i class="si si-home"></i><span class="sidebar-mini-hide">Lokasi 1</span>
                                </a>
                            </li>
                            <li>
                            <a href="index.php?m=Pages&p=location2">
                                    <i class="si si-home"></i><span class="sidebar-mini-hide">Lokasi 2</span>
                                </a>
                            </li>
                            <li>
                            <a href="index.php?m=Pages&p=location3">
                                    <i class="si si-home"></i><span class="sidebar-mini-hide">Lokasi 3</span>
                                </a>
                            </li>
                            <li>
                            <a href="index.php?m=Pages&p=location4">
                                    <i class="si si-home"></i><span class="sidebar-mini-hide">Lokasi 4</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END Sidebar -->
        <?php
            if (!isset($_GET['p'])) {
                include 'Pages/home.php';
            } else {
                $page = $_GET['p'];
                $modul = $_GET['m'];
                include $modul . '/' . $page . ".php";
            }
        ?>
        <!-- Footer -->
        <footer id="page-footer"
                class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
            <div class="pull-right">

            </div>
            <div class="pull-left">
                <a class="font-w600" href="#">Smart Monitoring</a> &copy; 2021
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->
    <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="assets/js/core/jquery.appear.min.js"></script>
    <script src="assets/js/core/jquery.countTo.min.js"></script>
    <script src="assets/js/core/jquery.placeholder.min.js"></script>
    <script src="assets/js/core/js.cookie.min.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Page JS Plugins -->
    <script src="assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="assets/js/plugins/flot/jquery.flot.min.js"></script>
    <script src="assets/js/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="assets/js/plugins/flot/jquery.flot.stack.min.js"></script>
    <script src="assets/js/plugins/flot/jquery.flot.resize.min.js"></script>

</body>
</html>
