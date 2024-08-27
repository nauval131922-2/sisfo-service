<?php
include "../database.php";

// Ambil parameter dari URL
$id_sparepart = $_GET['id_sparepart'] ?? '';
$id_reparasi = $_GET['id_reparasi'] ?? '';

if ($id_sparepart && $id_reparasi) {
    // Pastikan parameter aman untuk query SQL
    $id_sparepart = mysqli_real_escape_string($mysqli, $id_sparepart);
    $id_reparasi = mysqli_real_escape_string($mysqli, $id_reparasi);

    // Query untuk menghapus data
    $query = "DELETE FROM transaksi_sparepart WHERE id_sparepart = '$id_sparepart' AND id_reparasi = '$id_reparasi'";

    if (mysqli_query($mysqli, $query)) {
        // Redirect ke halaman sebelumnya atau halaman sukses
        header("Location: detail_sparepart_tambah.php?id_reparasi=$id_reparasi");
        exit;
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Parameter tidak lengkap.";
}

mysqli_close($mysqli);
