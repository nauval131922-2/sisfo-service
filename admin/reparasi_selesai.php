<?php
session_start(); // Memulai sesi
if (empty($_SESSION['username']) && empty($_SESSION['password']) && empty($_SESSION['admin_id'])) {
    echo "<script> alert('Anda harus login dulu'); window.location= '../login.php'; </script>";
    exit;
}

include "../database.php";

// Periksa apakah id_reparasi telah diteruskan melalui URL
if (!isset($_GET['id'])) {
    echo "<p>ID reparasi tidak ditemukan.</p><a href='reparasi.php'>Kembali ke halaman Reparasi</a>";
    exit;
}

$id_reparasi = $_GET['id'];

// Mendapatkan id transaksi terbaru
date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d");


$query = "select max(id_transaksi) as maxKode from transaksi";
$hasil = mysqli_query($mysqli, $query);
$data = mysqli_fetch_array($hasil);
$id_transaksi = $data['maxKode'];
$no_urut = (int) substr($id_transaksi, 9, 3);


$tahun = substr($date, 0, 4);
$bulan = substr($date, 5, 2);



$no_urut++;
$char = "TR";
$id_transaksi = $char . $tahun . $bulan . sprintf("%03s", $no_urut);

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


// Update status reparasi
$edit = mysqli_query($mysqli, "UPDATE reparasi SET status='Selesai' WHERE id_reparasi='$id_reparasi'");

if ($edit) {
    // Insert data transaksi baru
    $transaksi = mysqli_query($mysqli, "INSERT INTO transaksi (id_transaksi, id_reparasi, admin_id) VALUES ('$id_transaksi', '$id_reparasi', '$admin_id')");

    if ($transaksi) {
        header("Location: transaksi.php");
        exit;
    } else {
        echo "<p>Gagal menyimpan transaksi: " . mysqli_error($mysqli) . "</p><a href='reparasi.php'>Coba Lagi</a>";
    }
} else {
    echo "<p>Gagal mengupdate status reparasi: " . mysqli_error($mysqli) . "</p><a href='reparasi.php'>Coba Lagi</a>";
}
