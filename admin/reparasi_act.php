<?php
session_start(); // Memulai sesi
if (empty($_SESSION['username']) && empty($_SESSION['password']) && empty($_SESSION['admin_id'])) {
    echo "<script> alert('Anda harus login dulu'); window.location= '../login.php'; </script>";
    exit;
}

include "../database.php";

$id_reparasi = $_POST['id_reparasi'];


$admin_nama = $_SESSION['nama'];
$query_admin = "SELECT admin_id FROM admin WHERE admin_nama = '$admin_nama'";
$result_admin = mysqli_query($mysqli, $query_admin);

// Pastikan untuk mendapatkan admin_id dari hasil query
if ($result_admin && mysqli_num_rows($result_admin) > 0) {
    $row_admin = mysqli_fetch_assoc($result_admin);
    $admin_id = $row_admin['admin_id'];
} else {
    echo "<p>Admin tidak ditemukan di database.</p>";
    exit;
}


$pelanggan = $_POST['id_pelanggan'];
$tgl_reparasi = $_POST['tanggal_reparasi'];

mysqli_query($mysqli, "insert into reparasi values ('$id_reparasi','$tgl_reparasi','$pelanggan',$admin_id,'Diproses')");


header("location:reparasi.php");
