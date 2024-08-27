<?php
include '../database.php';
$id = $_GET['id'];

mysqli_query($mysqli, "delete from jenis where id_jenis='$id'");


header("location:jenis.php");
