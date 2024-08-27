<?php
include "../database.php"; // Pastikan path ini sesuai dengan lokasi file database.php Anda

// Ambil data dari form
$id_transaksi = $_POST['id_transaksi'] ?? '';
$id_sparepart = $_POST['sparepart'] ?? '';
$nama_sparepart = $_POST['nama_sparepart'] ?? '';
$id_reparasi = $_POST['id_reparasi'] ?? '';
$harga = str_replace('.', '', $_POST['harga'] ?? ''); // Remove dots for calculation
$qty = $_POST['qty'] ?? '';
$sub_total = str_replace('.', '', $_POST['sub_total'] ?? ''); // Remove dots for calculation

// Validasi input
if (empty($id_transaksi) || empty($id_sparepart) || empty($nama_sparepart) || empty($id_reparasi) || empty($harga) || empty($qty) || empty($sub_total)) {
    echo "All fields are required.";
    exit;
}

// Escape input values
$id_transaksi = mysqli_real_escape_string($mysqli, $id_transaksi);
$id_sparepart = mysqli_real_escape_string($mysqli, $id_sparepart);
$nama_sparepart = mysqli_real_escape_string($mysqli, $nama_sparepart);
$id_reparasi = mysqli_real_escape_string($mysqli, $id_reparasi);
$harga = mysqli_real_escape_string($mysqli, $harga);
$qty = mysqli_real_escape_string($mysqli, $qty);
$sub_total = mysqli_real_escape_string($mysqli, $sub_total);

// Insert data into transaksi_jasa table
$query = "INSERT INTO transaksi_sparepart (id_transaksi, id_sparepart, nama_sparepart, id_reparasi, harga, qty, sub_total)
          VALUES ('$id_transaksi', '$id_sparepart', '$nama_sparepart', '$id_reparasi', '$harga', '$qty', '$sub_total')";

$result = mysqli_query($mysqli, $query);

if ($result) {
    // Redirect or display success message
    header("Location: detail_sparepart_tambah.php?id_reparasi=$id_reparasi");
    exit;
} else {
    // Display error message
    echo "Failed to insert data: " . mysqli_error($mysqli);
}
