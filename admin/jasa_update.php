<?php
include '../database.php';
$id  = $_POST['id'];
$nama_jasa  = $_POST['nama_jasa'];
$harga_jasa  = $_POST['harga_jasa'];
$jenis = $_POST['jenis'];


mysqli_query($mysqli, "update jasa set nama_jasa='$nama_jasa', harga_jasa='$harga_jasa', jenis='$jenis' where id_jasa='$id'");

header("location:jasa.php");
