<?php
include '../database.php';
$id = $_GET['id'];

mysqli_query($mysqli, "delete from sparepart where id_sparepart='$id'");


header("location:sparepart.php");
