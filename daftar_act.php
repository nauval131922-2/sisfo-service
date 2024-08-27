<?php
include 'database.php';
$nama  = $_POST['nama_pelanggan'];
$email = $_POST['email_pelanggan'];
$hp = $_POST['hp_pelanggan'];
$alamat = $_POST['alamat_pelanggan'];
$password = md5($_POST['password_pelanggan']);

$cek_email = mysqli_query($mysqli, "select * from pelanggan where email_pelanggan='$email'");
if (mysqli_num_rows($cek_email) > 0) {
	header("location:daftar_pelanggan.php?alert=duplikat");
} else {
	mysqli_query($mysqli, "insert into pelanggan values (NULL,'$nama','$email','$hp','$alamat','$password')");
	header("location:login_pelanggan.php?alert=terdaftar");
}
