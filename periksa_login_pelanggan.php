<?php
// menghubungkan dengan koneksi
include 'database.php';

// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = md5($_POST['password']);

$login = mysqli_query($mysqli, "SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['id_pelanggan'];
	$_SESSION['nama'] = $data['nama_pelanggan'];
	$_SESSION['email'] = $data['email_pelanggan'];
	$_SESSION['status'] = "login";
	$_SESSION['admin_id'] = $admin_id;
	$_SESSION['admin_nama'] = $admin_nama;

	header("location:index.php");
} else {
	header("location:login_pelanggan.php?alert=gagal");
}
