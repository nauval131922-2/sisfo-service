<?php
include '../database.php';

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reparasi = $_POST['id_reparasi'];
    $nama_barang = $_POST['nama_barang'];
    $kerusakan = $_POST['kerusakan'];
    $kelengkapan = $_POST['kelengkapan'];
    $qty = $_POST['qty'];

    $query = "INSERT INTO detail_reparasi (reparasi, barang, kerusakan, kelengkapan, qty) VALUES ('$id_reparasi', '$nama_barang', '$kerusakan', '$kelengkapan', '$qty')";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $response['success'] = true;
    }
}

header("location:reparasi_tambah.php");
