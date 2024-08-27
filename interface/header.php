<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Polytron Service Center</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

</head>

<?php
require_once 'database.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['customer_status'])) {

	// halaman yg dilindungi jika customer belum login
	$lindungi = array('customer.php', 'customer_logout.php');

	// periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
	if (in_array($file, $lindungi)) {
		header("location:index.php");
	}

	if ($file == "checkout.php") {
		header("location:masuk.php?alert=login-dulu");
	}
} else {

	// halaman yg tidak boleh diakses jika customer sudah login
	$lindungi = array('masuk.php', 'daftar.php');

	// periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
	if (in_array($file, $lindungi)) {
		header("location:customer.php");
	}
}
?>

<body>
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex align-items-center">

			<div class="logo me-auto">
				<h1 class="text-light"><a href="index.php"><img src="assets/img/logoskm.png" alt="" class="img-fluid"></a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			</div>

			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li><a class="nav-link scrollto active" href="index.php">Home</a></li>
					<li><a class="nav-link scrollto" href="#about">Tentang</a></li>
					<li><a class="nav-link scrollto" href="#services">Layanan</a></li>
					<li><a class="nav-link scrollto" href="#testimonials">Testimoni</a></li>
					<li><a class="nav-link scrollto " href="login.php">Login Admin</a></li>
					<li class="dropdown"><a href="#"><span>Layanan Service</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="login_pelanggan.php">Login</a></li>
							<li><a href="daftar_pelanggan.php">Daftar</a></li>
						</ul>
					</li>
					<li><a class="nav-link scrollto" href="#team">SKM</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->
</body>