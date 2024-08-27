<?php
include '../database.php';
$id  = $_POST['id'];
$nama_sparepart  = $_POST['nama_sparepart'];
$harga_sparepart  = $_POST['harga_sparepart'];
$jenis = $_POST['jenis'];


mysqli_query($mysqli, "update sparepart set nama_sparepart='$nama_sparepart', harga_sparepart='$harga_sparepart', jenis='$jenis' where id_sparepart='$id'");

header("location:sparepart.php");
