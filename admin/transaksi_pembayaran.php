<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password']) && empty($_SESSION['admin_id'])) {
    echo "<script> alert('Anda harus login dulu'); window.location= '../login.php'; </script>";
    exit;
}

include "../database.php";

// Mendapatkan ID Transaksi
$query = "SELECT MAX(id_transaksi) AS maxKode FROM transaksi";
$hasil = mysqli_query($mysqli, $query);
$data = mysqli_fetch_array($hasil);
$id_transaksi = $data['maxKode'];

$no_urut = (int) substr($id_transaksi, 3, 3);
$id_reparasi = $_GET['id_reparasi'];

$no_urut++;
$char = "TR";
$id_transaksi = $char . $id_reparasi;

// Mendapatkan admin_id
$admin_nama = $_SESSION['nama'];
$query_admin = "SELECT admin_id FROM admin WHERE admin_nama = '$admin_nama'";
$result_admin = mysqli_query($mysqli, $query_admin);

// Mengambil data pelanggan
$transaksi = mysqli_query($mysqli, "SELECT * FROM reparasi INNER JOIN pelanggan ON reparasi.pelanggan=pelanggan.id_pelanggan WHERE id_reparasi='$id_reparasi'");
$t = mysqli_fetch_array($transaksi);

// Menghitung total jasa
$jumlahkan_jasa = mysqli_query($mysqli, "SELECT SUM(sub_total) AS total FROM transaksi_jasa WHERE id_reparasi='$id_reparasi'");
$t_jasa = mysqli_fetch_array($jumlahkan_jasa);
$jumlah_total_jasa = $t_jasa['total'];

// Menghitung total sparepart
$jumlahkan_sparepart = mysqli_query($mysqli, "SELECT SUM(sub_total) AS total FROM transaksi_sparepart WHERE id_reparasi='$id_reparasi'");
$t_sparepart = mysqli_fetch_array($jumlahkan_sparepart);
$jumlah_total_sparepart = $t_sparepart['total'];

// Total keseluruhan
$jumlah_total = $jumlah_total_jasa + $jumlah_total_sparepart;
?>


<!DOCTYPE html>
<html>

<head>
    <title>POLYTRON SERVICE CENTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/img/favicon.png" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 10px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .form-control-plaintext {
            border: none;
            font-size: 14px;
        }

        .btn-primary {
            font-size: 14px;
        }

        .text-danger {
            color: red;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .form-control-plaintext {
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="col-md-12">
            <?php
            // menangkap id yang dikirim melalui url
            $id_reparasi = $_GET['id_reparasi'];
            ?>

            <div class="text-center mb-2">
                <h3>PT. SARANA KENCANA MULYA</h3>
            </div>

            <a href="transaksi.php" class="btn btn-primary mb-2"><i class="bi bi-reply"></i> Kembali</a>

            <form method="POST" action="proses_transaksi_pembayaran.php">
                <table class="table table-bordered mb-2">
                    <?php
                    include "../database.php";
                    $idtransaksi = mysqli_query($mysqli, "select * from transaksi where id_reparasi='$_GET[id_reparasi]' ");
                    $it = mysqli_fetch_array($idtransaksi);
                    ?>
                    <input type="hidden" class="form-control" value="<?php echo $it['id_transaksi']; ?>" name="id_transaksi" readonly="">
                    <input type="hidden" class="form-control" value="<?php echo $_SESSION['nama']; ?>" name="admin_nama">

                    <tr>
                        <th width="20%">Id Reparasi </th>
                        <th>:</th>
                        <td><input type="text" readonly class="form-control-plaintext" value="<?php echo $t['id_reparasi']; ?>" name="id_reparasi"></td>
                    </tr>
                    <tr>
                        <th width="20%">Tgl. Bayar</th>
                        <th>:</th>
                        <td><input type="text" class="form-control-plaintext" value="<?php echo date('d F Y'); ?>" name="tgl_bayar"></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>:</th>
                        <td><input type="text" readonly class="form-control-plaintext" value="<?php echo $t['nama_pelanggan']; ?>" name="nama_pelanggan"></td>
                    </tr>
                </table>

                <div class="form-group row mb-2">
                    <label for="total" class="col-sm-2 col-form-label" style="font-size:18px;">Jumlah Total</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" readonly class="form-control" id="total" name="jumlah_total" style="font-size:18px; color:red; font-weight:bold;" value="<?php echo $jumlah_total; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="bayar" class="col-sm-2 col-form-label" style="font-size:18px;">Bayar</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" id="bayar" onkeyup="sum();" required name="bayar" style="font-size:18px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="kembalian" class="col-sm-2 col-form-label" style="font-size:18px;">Kembalian</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" readonly class="form-control" id="kembalian" name="kembalian" style="font-size:18px; font-weight:bold;">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" style="font-size:14px;"> <i class="bi bi-money"></i>&nbsp; Proses </button>
            </form>

            <div class="text-center mt-2 mb-2" style="font-size:18px;">- - Detail Pembelian - -</div>

            <h5 class="text-left">Daftar Jasa:</h5>
            <table class="table table-bordered table-striped mb-2">
                <tr>
                    <th>No</th>
                    <th>Nama Jasa</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                </tr>

                <?php
                $jasa = mysqli_query($mysqli, "SELECT * FROM transaksi_jasa WHERE id_reparasi='$id_reparasi'");
                $no = 1;
                while ($j = mysqli_fetch_array($jasa)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $j['nama_jasa']; ?></td>
                        <td><?php echo $j['qty']; ?></td>
                        <td><?php echo $j['sub_total']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <table align="right" class="mb-4" style="font-size:15px;">
                <?php
                $jumlahkan = mysqli_query($mysqli, "SELECT SUM(sub_total) AS total FROM transaksi_jasa WHERE id_reparasi='$id_reparasi'");
                $t = mysqli_fetch_array($jumlahkan);
                ?>
                <tr style="font-weight:bold;" align="right">
                    <td width="90%">Total: <span style="color:red;">(Rp.) &nbsp; </span></td>
                    <td width="10%"><input type="text" style="border:none; text-decoration:underline; color:red;" value="<?php echo $t['total'] ?>" class="sub_total"></td>
                </tr>
            </table>

            <h5 class="text-left">Daftar Sparepart:</h5>
            <table class="table table-bordered table-striped mb-2">
                <tr>
                    <th>No</th>
                    <th>Nama Sparepart</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                </tr>

                <?php
                $sparepart = mysqli_query($mysqli, "SELECT * FROM transaksi_sparepart WHERE id_reparasi='$id_reparasi'");
                $no = 1;
                while ($s = mysqli_fetch_array($sparepart)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $s['nama_sparepart']; ?></td>
                        <td><?php echo $s['qty']; ?></td>
                        <td><?php echo $s['sub_total']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <table align="right" class="mb-4" style="font-size:15px;">
                <?php
                $jumlahkan = mysqli_query($mysqli, "SELECT SUM(sub_total) AS total FROM transaksi_sparepart WHERE id_reparasi='$id_reparasi'");
                $t = mysqli_fetch_array($jumlahkan);
                ?>
                <tr style="font-weight:bold;" align="right">
                    <td width="90%">Total: <span style="color:red;">(Rp.) &nbsp; </span></td>
                    <td width="10%"><input type="text" style="border:none; text-decoration:underline; color:red;" value="<?php echo $t['total'] ?>" class="sub_total"></td>
                </tr>
            </table>

        </div>
    </div>

    <script>
        function sum() {
            var total = document.getElementById('total').value;
            var bayar = document.getElementById('bayar').value;
            var kembalian = parseFloat(bayar) - parseFloat(total);
            if (!isNaN(kembalian)) {
                document.getElementById('kembalian').value = kembalian.toFixed(0);
            }
        }
    </script>
</body>

</html>