<?php
require '../../Source/connect.php';
$id = $_REQUEST['id'] ?? '';
$d = new Database();
include("../../Source/login.php");
$p = new User();
if (empty($_SESSION["username"]) || empty($_SESSION["password"]) || empty($_SESSION['role'])) {
    echo "<script>
	window.location = '../main-ltr/login.php';
</script>";
} else {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $role = $_SESSION['role'];
    $p->confirm($username, $password, $role);
}
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

    <div class="art-bg">
        <img src="../images/art1.svg" alt="" class="art-img light-img">
        <img src="../images/art2.svg" alt="" class="art-img dark-img">
        <img src="../images/art-bg.svg" alt="" class="wave-img light-img">
        <img src="../images/art-bg2.svg" alt="" class="wave-img dark-img">
    </div>
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo -->
	  <div class="logo-mini">
		  <span class="light-logo"><img src="../images/logo-light.png" alt="logo"></span>
		  <span class="dark-logo"><img src="../images/logo-dark.png" alt="logo"></span>
	  </div>
      <!-- logo-->
      <div class="logo-lg">
		  <span class="light-logo"><img src="../images/logo-light-text.png" alt="logo"></span>
	  	  <span class="dark-logo"><img src="../images/logo-dark-text.png" alt="logo"></span>
	  </div>
    </a>
    <!-- Header Navbar -->
      <nav class="navbar navbar-static-top"></nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full clearfix position-relative">

		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar" style="min-height: 20%">
			<!-- sidebar-->
			<section class="sidebar">
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">

                  <li class="header nav-small-cap"><strong>PERSONAL</strong></li>
                <li>
                  <a href="index.php">
                    <span>Userlist</span>
                  </a>
                </li>
                  <li>
                      <a href="change_pass.php?id=<?= isset($_SESSION['id']) ? $_SESSION['id'] : ''  ?>">
                          <span>Change Password</span>
                      </a>
                  </li>
                  <li>
                      <a href="log_out.php">
                          <span>Log Out</span>
                      </a>
                  </li>
			  </ul>
			</section>
		</aside>
		<!-- Main content -->
		<section class="content">

			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="d-flex align-items-center justify-content-between">
					<div class="d-md-block d-none">
						<h3 class="page-title br-0">Dashboard</h3>
					</div>
					<div class="w-p60">
						<!-- Search Form -->
						<form id="labnol" method="get" action="https://www.google.com/search">
							<div class="form-group mb-0 mr-5">
								<div class="input-group">
									<input type="text" name="q" class="form-control border-white" id="transcript" placeholder="Voice Search" x-webkit-speech>
									<div class="input-group-append">
										<button type="button" onclick="startDictation()" class="tst4 btn btn-rounded btn-white"><img src="../images/Google_mic.png" class="img-fluid w-15" alt=""></button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="right-title w-170">
						<span class="subheader_daterange font-weight-600" id="dashboard_daterangepicker">
							<span class="subheader_daterange-label">
								<span class="subheader_daterange-title"></span>
								<span class="subheader_daterange-date text-primary"></span>
							</span>
							<a href="#" class="btn btn-rounded btn-sm btn-primary">
								<i class="fa fa-angle-down"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="box no-shadow">
                        <div class="box-body">
                            <?php $p->get_admin();
                            ?>

                            <?php $p->get_nv();
                            ?>

                            <?php $p->get_alluser(); ?>
                            <a href="add.php"  class="btn btn-success mt-10 d-block text-center">+ Add New Contact</a>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <div class="col-lg-9 col-md-8">

                    <div class="box">
                        <div class="media-list media-list-divided media-list-hover">
                            <?php
                            $p->user_list();
                            ?>
                        </div>
                    </div>
                    <!-- /. box -->

                </div>
            </div>
        </section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
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

