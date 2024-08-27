<?php
include '../database.php';
$nama_jenis  = $_POST['nama_jenis'];
$kategori = $_POST['kategori'];

mysqli_query($mysqli, "insert into jenis values (NULL,'$kategori','$nama_jenis')");


header("location:jenis.php");
