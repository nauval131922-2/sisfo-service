<?php
include '../database.php';
$id  = $_POST['id'];
$nama_jenis  = $_POST['nama_jenis'];
$kategori = $_POST['kategori'];


mysqli_query($mysqli, "update jenis set kategori='$kategori', nama_jenis='$nama_jenis' where id_jenis='$id'");

header("location:jenis.php");
