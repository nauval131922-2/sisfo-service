<?php
// menghubungkan dengan koneksi
include 'database.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($mysqli, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['admin_id'];
	$_SESSION['nama'] = $data['admin_nama'];
	$_SESSION['username'] = $data['admin_username'];
	$_SESSION['status'] = "login";
	$_SESSION['hak_akses']     = $data['hak_akses'];

	header("location:admin/");
} else {
	header("location:login.php?alert=gagal");
}
