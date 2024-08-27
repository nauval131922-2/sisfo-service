<?php
include '../database.php';

if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];

    // Debug statement untuk memeriksa parameter
    echo "Nama yang diterima: $nama<br>";

    $query = "DELETE FROM detail_reparasi WHERE barang = '$nama'";

    if (mysqli_query($mysqli, $query)) {
        echo "Berhasil menghapus data";
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Parameter nama tidak ditemukan";
}
