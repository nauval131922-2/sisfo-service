<?php
include '../database.php';
$id = $_GET['id'];

mysqli_query($mysqli, "delete from jasa where id_jasa='$id'");


header("location:jasa.php");
