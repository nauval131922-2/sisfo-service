<?php
include '../database.php';
$nama_jasa  = $_POST['nama_jasa'];
$harga_jasa  = $_POST['harga_jasa'];
$jenis = $_POST['jenis'];

mysqli_query($mysqli, "insert into jasa values (NULL,'$nama_jasa','$harga_jasa','$jenis')");


header("location:jasa.php");
