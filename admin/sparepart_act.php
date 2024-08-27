<?php
include '../database.php';
$nama_sparepart  = $_POST['nama_sparepart'];
$harga_sparepart  = $_POST['harga_sparepart'];
$jenis = $_POST['jenis'];

mysqli_query($mysqli, "insert into sparepart values (NULL,'$nama_sparepart','$harga_sparepart','$jenis')");


header("location:sparepart.php");
