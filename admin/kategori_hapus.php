<?php
include '../database.php';
$id = $_GET['id'];

mysqli_query($mysqli, "delete from kategori where id_kategori='$id'");


header("location:kategori.php");
