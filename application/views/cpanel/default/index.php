<!doctype html>
<html lang="en">
	<head>
		<base href="<?php echo site_url(); ?>" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
		<meta name="author" content="ParkerThemes">
		<link rel="shortcut icon" href="public/cpanel/img/fav.png" />

		<!-- Title -->
		<title>SmartQ Admin Template - Quick Dashboard</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="public/cpanel/css/bootstrap.min.css">
		<!-- Icomoon Font Icons css -->
		<link rel="stylesheet" href="public/cpanel/fonts/style.css">
		<!-- Main css -->
		<link rel="stylesheet" href="public/cpanel/css/main.css">

		<!-- sweetalert css -->
		<link rel="stylesheet" href="public/cpanel/js/sweetalert/sweetalert.css">


		<!-- *************
			************ Vendor Css Files *************
		************ -->
		<!-- DateRange css -->
		<link rel="stylesheet" href="public/cpanel/vendor/daterange/daterange.css" />
		<!-- jQcloud Keywords css -->
		<link rel="stylesheet" href="public/cpanel/vendor/jqcloud/jqcloud.css" />	
		<!-- Data Tables -->
		<link rel="stylesheet" href="public/cpanel/vendor/datatables/dataTables.bs4.css" />
		<link rel="stylesheet" href="public/cpanel/vendor/datatables/dataTables.bs4-custom.css" />
		<link href="public/cpanel/vendor/datatables/buttons.bs.css" rel="stylesheet" />
		<!-- file style Thảo tạo -->
		<link href="public/cpanel/css/style.css" rel="stylesheet" />
		<!-- Jquery -->
		<script src="public/cpanel/js/jquery.min.js"></script>
	</head>

	<body>

		<!-- Loading starts -->
		<div id="loading-wrapper">
			<div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<!-- Loading ends -->

		<!-- Page wrapper start -->
		<div class="page-wrapper">
			<!-- Sidebar wrapper start -->
			<nav id="sidebar" class="sidebar-wrapper">
				<!-- Sidebar brand start  -->
				<?php $this->load->view('cpanel/layout/logo');?>
				<!-- Sidebar brand end  -->
				<!-- Sidebar content start -->
				<?php $this->load->view('cpanel/layout/sidebar');?>
				<!-- Sidebar content end -->
			</nav>
			<!-- Sidebar wrapper end -->
			<!-- Page content start  -->
			<div class="page-content">

				<!-- Header start -->
				<?php $this->load->view('cpanel/layout/header');?>
				<!-- Header end -->

				<!-- Page Main content -->
				<?php
	                if(isset($template) && !empty($template)){
	                    $this->load->view($template, isset($data)?$data:NULL);
	                }
	            ?>
			</div>
			<!-- Page content end -->
		</div>
		<!-- Page wrapper end -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		
		<script src="public/cpanel/js/bootstrap.bundle.min.js"></script>
		<script src="public/cpanel/js/moment.js"></script>


		<!-- *************
			************ Vendor Js Files *************
		************* -->
		<!-- Slimscroll JS -->
		<script src="public/cpanel/vendor/slimscroll/slimscroll.min.js"></script>
		<script src="public/cpanel/vendor/slimscroll/custom-scrollbar.js"></script>

		<!-- Daterange -->
		<script src="public/cpanel/vendor/daterange/daterange.js"></script>
		<script src="public/cpanel/vendor/daterange/custom-daterange.js"></script>

		<!-- Polyfill JS -->
		<script src="public/cpanel/vendor/polyfill/polyfill.min.js"></script>

		<!-- Apex Charts -->
		<script src="public/cpanel/vendor/apex/apexcharts.min.js"></script>
		<script src="public/cpanel/vendor/apex/crm/compare-sales.js"></script>
		<script src="public/cpanel/vendor/apex/crm/compare-sales1.js"></script>

		<!-- Data Tables -->
		<script src="public/cpanel/vendor/datatables/dataTables.min.js"></script>
		<script src="public/cpanel/vendor/datatables/dataTables.bootstrap.min.js"></script>

		<!-- Custom Data tables -->
		<script src="public/cpanel/vendor/datatables/custom/custom-datatables.js"></script>
		<script src="public/cpanel/vendor/datatables/custom/fixedHeader.js"></script>

		<!-- jQcloud Keywords -->
		<script src="public/cpanel/vendor/jqcloud/jqcloud-1.0.4.min.js"></script>
		<script src="public/cpanel/vendor/jqcloud/custom-jqcloud.js"></script>
		<!-- sweetalert JS -->
		<script src="public/cpanel/js/sweetalert/sweetalert.min.js"></script>

		<!-- Main JS -->
		<script src="public/cpanel/js/main.js"></script>
		<!-- cpanel JS --THAO TAO -->
		
	</body>
</html>
