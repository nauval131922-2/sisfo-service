<?php
include "../database.php";

// Ambil parameter dari URL
$id_jasa = $_GET['id_jasa'] ?? '';
$id_reparasi = $_GET['id_reparasi'] ?? '';

if ($id_jasa && $id_reparasi) {
    // Pastikan parameter aman untuk query SQL
    $id_jasa = mysqli_real_escape_string($mysqli, $id_jasa);
    $id_reparasi = mysqli_real_escape_string($mysqli, $id_reparasi);

    // Query untuk menghapus data
    $query = "DELETE FROM transaksi_jasa WHERE id_jasa = '$id_jasa' AND id_reparasi = '$id_reparasi'";

    if (mysqli_query($mysqli, $query)) {
        // Redirect ke halaman sebelumnya atau halaman sukses
        header("Location: detail_jasa_tambah.php?id_reparasi=$id_reparasi");
        exit;
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Parameter tidak lengkap.";
}

mysqli_close($mysqli);
