<?php
session_start();
ob_start();
include '../database.php';

$id = $_GET['id_transaksi'];



// Query transaksi
$struk_query = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi='$id'");
if (!$struk_query) {
	die("Query error: " . mysqli_error($mysqli));
}
$struk = mysqli_fetch_array($struk_query);

// Query detail jasa
$detail_jasa_query = mysqli_query($mysqli, "SELECT * FROM transaksi_jasa WHERE id_transaksi='$id'");
if (!$detail_jasa_query) {
	die("Query error: " . mysqli_error($mysqli));
}

// Query detail jasa
$detail_sparepart_query = mysqli_query($mysqli, "SELECT * FROM transaksi_sparepart WHERE id_transaksi='$id'");
if (!$detail_sparepart_query) {
	die("Query error: " . mysqli_error($mysqli));
}

// Query total
$total_query = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi='$id'");
if (!$total_query) {
	die("Query error: " . mysqli_error($mysqli));
}
$total_data = mysqli_fetch_array($total_query);
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

		.header-table,
		.info-table,
		.detail-table {
			width: 100%;
			border-collapse: collapse;
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

	<style>
		.subtotal-table th,
		.subtotal-table td {
			padding: 5px;
			text-align: right;
			color: #333;
		}

		.subtotal-table th {
			width: 50%;
			text-align: right;
		}

		.subtotal-table td {
			width: 50%;
		}
	</style>

</head>

<body>
	<div class="container">
		<div class="col-md-5 col-md-offset-1">
			<table class="header-table">

				<td class="logo-cell">
					<img src="../assets/img/logoskm.png" class="logo" alt="Logo">
					<p style="font-size: 12px;">Jl. KHR. Asnawi Bakalan Krapyak Kudus - Telepon: 081-222-333-444</p>
				</td>
				<td class="info-cell">
					<?php if ($struk) : ?>
						<table class="info-table">
							<tr>
								<th>No Transaksi</th>
								<td>: &nbsp; <?php echo htmlspecialchars($id); ?></td>
							</tr>
							<tr>
								<th>No Reparasi</th>
								<td>: &nbsp; <?php echo htmlspecialchars($struk['id_reparasi']); ?></td>
							</tr>
							<tr>
								<th>Tgl. Bayar</th>
								<td>: &nbsp; <?php echo htmlspecialchars($struk['tgl_bayar']); ?></td>
							</tr>
							<tr>
								<th>Pelanggan</th>
								<td>: &nbsp; <?php echo htmlspecialchars($struk['pelanggan']); ?></td>
							</tr>
						</table>
					<?php else : ?>
						<p>Data transaksi tidak ditemukan.</p>
					<?php endif; ?>
				</td>
				</tr>
			</table>
			<hr>

			<h4>Detail Jasa:</h4>
			<table class="detail-table">
				<tr>
					<th style="width: 5%;">No</th>
					<th style="width: 50%;">Nama Jasa</th>
					<th style="width: 10%;">Harga</th>
					<th style="width: 5%;">Qty</th>
					<th style="width: 10%;">Sub Total</th>
				</tr>
				<?php if ($detail_jasa_query && mysqli_num_rows($detail_jasa_query) > 0) : ?>
					<?php $no = 1; ?>
					<?php while ($d = mysqli_fetch_array($detail_jasa_query)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo htmlspecialchars($d['nama_jasa']); ?></td>
							<td><?php echo htmlspecialchars($d['harga']); ?></td>
							<td><?php echo htmlspecialchars($d['qty']); ?></td>
							<td><?php echo htmlspecialchars($d['sub_total']); ?></td>
						</tr>
					<?php endwhile; ?>
				<?php else : ?>
					<tr>
						<td colspan="5">Data jasa tidak ditemukan.</td>
					</tr>
				<?php endif; ?>
			</table>


			<h4>Detail Sparepart:</h4>
			<table class="detail-table">
				<tr>
					<th style="width: 5%;">No</th>
					<th style="width: 50%;">Nama Sparepart</th>
					<th style="width: 10%;">Harga</th>
					<th style="width: 5%;">Qty</th>
					<th style="width: 10%;">Sub Total</th>
				</tr>
				<?php if ($detail_sparepart_query && mysqli_num_rows($detail_sparepart_query) > 0) : ?>
					<?php $no = 1; ?>
					<?php while ($d = mysqli_fetch_array($detail_sparepart_query)) : ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo htmlspecialchars(substr($d['nama_sparepart'], 0, 25)); ?></td>
							<td><?php echo htmlspecialchars($d['harga']); ?></td>
							<td><?php echo htmlspecialchars($d['qty']); ?></td>
							<td><?php echo htmlspecialchars($d['sub_total']); ?></td>
						</tr>
					<?php endwhile; ?>
				<?php else : ?>
					<tr>
						<td colspan="5">Data sparepart tidak ditemukan.</td>
					</tr>
				<?php endif; ?>
			</table>


			<table class="subtotal-table" align="right">
				<tr>
					<th>Sub Total</th>
					<td><?php echo "Rp. " . htmlspecialchars($total_data['jumlah_total']); ?></td>
				</tr>
			</table>


			<br>

			<table border="0">
				<?php if ($total_data) : ?>
					<tr>
						<th width="20%">Total &nbsp; </th>
						<th width="10%"> &nbsp;: &nbsp; </th>
						<td><b><?php echo "Rp. " . htmlspecialchars($total_data['jumlah_total']); ?></b></td>
					</tr>
					<tr>
						<th width="20%">Bayar &nbsp; </th>
						<th width="10%"> &nbsp;: &nbsp; </th>
						<td><b><?php echo "Rp. " . htmlspecialchars($total_data['bayar']); ?></b></td>
					</tr>
					<tr>
						<th width="20%">Pengembalian &nbsp; </th>
						<th width="10%"> &nbsp;: &nbsp; </th>
						<td><b><?php echo "Rp. " . htmlspecialchars($total_data['kembalian']); ?></b></td>
					</tr>
				<?php else : ?>
					<tr>
						<td colspan="3">Data total tidak ditemukan.</td>
					</tr>
				<?php endif; ?>
			</table>

			<p class="footer-text">"Terima kasih telah mempercayakan Jasa Reparasi pada kami".</p>

			<div class="button-row">
				<a href="transaksi_selesai.php" class="btn btn-primary mb-2"><i class="bi bi-reply"></i> Kembali</a>
				<a href="transaksi_cetak.php?id_transaksi=<?php echo htmlspecialchars($id); ?>" class="btn">CETAK</a>
			</div>
		</div>
	</div>
</body>

</html>