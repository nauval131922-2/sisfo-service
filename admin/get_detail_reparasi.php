<?php
include '../database.php';

$id_reparasi = $_GET['id_reparasi'];
$data = [];

$query = "SELECT * FROM detail_reparasi WHERE reparasi = '$id_reparasi'";
$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
