<?php
include '../database.php';
$id  = $_POST['id_kategori'];
$nama_kategori  = $_POST['nama_kategori'];

mysqli_query($mysqli, "update kategori set nama_kategori='$nama_kategori' where id_kategori='$id'");
header("location:kategori.php");
