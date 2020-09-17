<!doctype html>
<html lang="en">
	<head>
		<base href="<?php echo site_url(); ?>" />
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
		<meta name="author" content="ParkerThemes">
		<link rel="shortcut icon" href="img/fav.png" />

		<!-- Title -->
		<title><?php echo $title;?></title>
		
		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="public/cpanel/css/bootstrap.min.css" />

		<!-- Master CSS -->
		<link rel="stylesheet" href="public/cpanel/css/main.css" />

	</head>

	<body class="authentication">

		<!-- Container start -->
		<div class="container">
			
			<form action="index.html">
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="javascript:void(0)" class="login-logo">
									<img src="public/cpanel/img/logo.png" alt="SmartQ Admin Dashboard" />
								</a>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Email Address" />
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Password" />
								</div>
								<div class="forgot-pwd">
									<a class="link" href="forgot-pwd.html">Forgot password?</a>
								</div>
								<hr>
								<div class="actions mb-4">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="remember_pwd">
										<label class="custom-control-label" for="remember_pwd">Remember me</label>
									</div>
									<button type="submit" class="btn btn-primary">Login</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
		<!-- Container end -->
	</body>
</html>