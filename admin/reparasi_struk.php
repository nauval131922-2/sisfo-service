<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Polytron Service Center</title>
	<link href="assets/img/favicon.png" rel="icon">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f8f8f8;
		}

		.container {
			max-width: 800px;
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
		}

		.header-table {
			width: 100%;
			margin-bottom: 20px;
		}

		.logo-cell {
			width: 30%;
			vertical-align: top;
			padding-right: 20px;
		}

		.info-cell {
			width: 70%;
			vertical-align: top;
			padding-left: 20px;
		}

		.info-table th {
			text-align: left;
			width: 40%;
			padding: 5px 0;
			color: #333;
		}

		.info-table td {
			width: 60%;
			padding: 5px 0;
			color: #666;
		}

		.detail-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		.detail-table th,
		.detail-table td {
			border: 1px solid #ddd;
			padding: 10px;
			text-align: left;
			color: #333;
		}

		.detail-table th {
			background-color: #f0f0f0;
		}

		.footer-text {
			margin-top: 20px;
			text-align: center;
			font-style: italic;
			color: #888;
		}

		.button-row {
			margin-top: 20px;
			display: flex;
			justify-content: space-between;
		}

		.btn {
			background-color: #007bff;
			color: white;
			padding: 10px 20px;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s;
		}

		.btn:hover {
			background-color: #0056b3;
		}

		img.logo {
			width: 100px;
			height: auto;
		}
	</style>
</head>

<body>

	<?php
	include '../database.php';
	?>
	<br>
	<div class="container">

		<div class="col-md-8 col-md-offset-1">

			<table class="header-table">
				<tr>
					<td class="logo-cell">
						<img src="../assets/img/logoskm.png" class="logo" alt="Logo">
						<p style="font-size: 12px; font-family: Arial, sans-serif;">Jl. KHR. Asnawi Bakalan Krapyak Kudus
							Telepon: 081-222-333-444</p>
					</td>
					<td class="info-cell">
						<?php
						$id = $_GET['id_reparasi'];
						$query = mysqli_query($mysqli, "SELECT a.id_reparasi, a.tgl_reparasi, a.pelanggan, a.admin, a.status,
                                                        b.id_pelanggan, b.nama_pelanggan, b.alamat_pelanggan, b.hp_pelanggan
                                                        FROM reparasi as a INNER JOIN pelanggan as b
                                                        ON a.pelanggan=b.id_pelanggan WHERE id_reparasi='$id'");
						while ($s = mysqli_fetch_array($query)) {
						?>
							<table class="info-table">
								<tr>
									<th>ID Reparasi</th>
									<td>: &nbsp; <?php echo $s['id_reparasi']; ?></td>
								</tr>
								<tr>
									<th>Tgl. Reparasi</th>
									<td>: &nbsp; <?php echo $s['tgl_reparasi']; ?></td>
								</tr>
								<tr>
									<th>Pelanggan</th>
									<td>: &nbsp; <?php echo $s['nama_pelanggan']; ?></td>
								</tr>
								<tr>
									<th>Alamat</th>
									<td>: &nbsp; <?php echo $s['alamat_pelanggan']; ?></td>
								</tr>
							</table>
						<?php } ?>
					</td>
				</tr>
			</table>

			<h4>Detail Reparasi:</h4>
			<table class="detail-table">
				<tr>
					<th>No</th>
					<th>Barang</th>
					<th>Kerusakan</th>
					<th>Kelengkapan</th>
					<th>Qty</th>
				</tr>
				<?php
				$no = 0;
				$detail = mysqli_query($mysqli, "select * from detail_reparasi where reparasi='$id'");
				while ($d = mysqli_fetch_array($detail)) {
					$no++;
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $d['barang']; ?></td>
						<td><?php echo $d['kerusakan']; ?></td>
						<td><?php echo $d['kelengkapan']; ?></td>
						<td><?php echo $d['qty']; ?></td>
					</tr>
				<?php } ?>
			</table>

			<p class="footer-text">
				"Terima kasih telah mempercayakan Jasa Reparasi pada kami".
			</p>

			<div class="button-row">
				<a class="btn" href="reparasi.php">Kembali</a>
				<a href="reparasi_cetak.php?id_reparasi=<?php echo $_GET['id_reparasi']; ?>" target="_blank" class="btn"><i class="fas fa-print"></i> CETAK</a>
			</div>

		</div>

	</div>

</body>

</html>