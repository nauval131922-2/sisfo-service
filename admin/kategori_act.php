<?php
include '../database.php';
$nama_kategori  = $_POST['nama_kategori'];

mysqli_query($mysqli, "insert into kategori values (NULL,'$nama_kategori')");
header("location:kategori.php");
