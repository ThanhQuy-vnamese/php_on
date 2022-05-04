<?php
include("../../Source/connect.php");
$database= new Database();
include("../../Source/login.php");
$user=new User();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>VoiceX Admin - Dashboard</title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="../assets/vendor_components/bootstrap/dist/css/bootstrap.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="../assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- toast CSS -->
    <link href="../assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

    <!-- theme style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- VoiceX Admin skins -->
    <link rel="stylesheet" href="css/skin_color.css">


</head>

<body class="hold-transition light-skin sidebar-mini theme-deepocean">

<div class="wrapper">
    <div class="row justify-content-center no-gutters">
        <div class="col-xl-4 col-lg-7 col-md-6 col-12">
            <div class="content-top-agile p-10">
                <h2 class="text-primary">Get started with Us</h2>
                <p class="text-black-50">Sign in to start your session</p>
            </div>
            <div class="p-30 rounded10 b-2 b-dashed border-info">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" class="form-control pl-15 bg-transparent plc-black" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" class="form-control pl-15 bg-transparent plc-black" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 text-center">
                            <input class="btn btn-info mt-10" type="submit" name="submit" value="Login">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php
                if(isset($_REQUEST["submit"])){
                    $username=$_REQUEST["username"];
                    $password=$_REQUEST["password"];
                    $user->login($username, $password);
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Purchase Now</a>
                </li>
            </ul>
        </div>
        &copy; 2022
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>

<!-- fullscreen -->
<script src="../assets/vendor_components/screenfull/screenfull.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../assets/vendor_components/jquery-ui/jquery-ui.js"></script>

<!-- popper -->
<script src="../assets/vendor_components/popper/dist/popper.min.js"></script>

<!-- Bootstrap 4.0-->
<script src="../assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>

<!-- date-range-picker -->
<script src="../assets/vendor_components/moment/min/moment.min.js"></script>
<script src="../assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Slimscroll -->
<script src="../assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- FastClick -->
<script src="../assets/vendor_components/fastclick/lib/fastclick.js"></script>

<!-- amchart -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- apexcharts -->
<script src="../assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
<script src="../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>

<!-- toast -->
<script src="../assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>

<!-- VoiceX Admin App -->
<script src="js/template.js"></script>
<script src="js/pages/voice-search.js"></script>

<!-- VoiceX Admin dashboard demo (This is only for demo purposes) -->
<script src="js/pages/dashboard.js"></script>

<!-- VoiceX Admin for demo purposes -->
<script src="js/demo.js"></script>


</body>
</html>



