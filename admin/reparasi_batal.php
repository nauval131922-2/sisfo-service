<?php
session_start(); // Memulai sesi
include "../database.php";

// Periksa apakah id_reparasi telah diteruskan melalui URL
if (!isset($_GET['id'])) {
    echo "<p>ID reparasi tidak ditemukan.</p><a href='reparasi.php'>Kembali ke halaman Reparasi</a>";
    exit;
}

$id_reparasi = $_GET['id'];

// Update status reparasi
$edit = mysqli_query($mysqli, "UPDATE reparasi SET status='Batal' WHERE id_reparasi='$id_reparasi'");

header("Location: reparasi.php");
