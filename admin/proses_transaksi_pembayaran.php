<?php
include "../database.php";

$todaydate = date("Y-m-d", time());
$sqlDate   = date('Y-m-d', strtotime($todaydate));
$id_transaksi = $_POST['id_transaksi'];
$id_reparasi = $_POST['id_reparasi'];

if ($_POST["kembalian"] < 0) {
    echo "<script> alert('Biaya Pembayaran Kurang');window.location='transaksi_pembayaran.php?id_reparasi=$id_reparasi'; </script>";
} else {
    // Prepare the SQL query
    $transaksi_query = "
        UPDATE transaksi 
        SET 
            tgl_bayar = '$sqlDate',
            pelanggan = '{$_POST['nama_pelanggan']}',
            jumlah_total = '{$_POST['jumlah_total']}',
            bayar = '{$_POST['bayar']}',
            kembalian = '{$_POST['kembalian']}',
            admin_id = (SELECT admin_id FROM admin WHERE admin_nama = '{$_POST['admin_nama']}'),
            ket = 'Lunas' 
        WHERE id_reparasi = '$id_reparasi'
    ";

    // Execute the query and check for errors
    if (mysqli_query($mysqli, $transaksi_query)) {
        $ubahstatus_query = "
            UPDATE reparasi 
            SET status = 'Dibayar' 
            WHERE id_reparasi = '$id_reparasi'
        ";

        if (mysqli_query($mysqli, $ubahstatus_query)) {
            header("Location: transaksi_struk.php?id_transaksi=$id_transaksi");
            exit();
        } else {
            echo "<p>Gagal mengupdate tabel reparasi: " . mysqli_error($mysqli) . "</p>
            <a href='transaksi.php'>Coba Lagi</a>";
        }
    } else {
        echo "<p>Gagal mengupdate tabel transaksi: " . mysqli_error($mysqli) . "</p>
        <a href='transaksi.php'>Coba Lagi</a>";
    }
}
