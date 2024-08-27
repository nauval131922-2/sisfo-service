<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Transaksi Selesai</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Transaksi</li>
        <li class="breadcrumb-item active">Transaksi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Transaksi Selesai</h3>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr align="center">
                <th width="1%">NO</th>
                <th>ID TRANSAKSI</th>
                <th>ID REPARASI</th>
                <th>TANGGAL REPARASI</th>
                <th>NAMA PELANGGAN</th>
                <th>KETERANGAN</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT a.id_transaksi, a.id_reparasi, a.tgl_bayar, a.pelanggan, a.jumlah_total, a.admin_id, a.ket,
                                                    b.id_reparasi,
                                                    c.admin_id, c.admin_nama
                                                    FROM transaksi as a INNER JOIN reparasi as b INNER JOIN admin as c
                                                    ON a.id_reparasi=b.id_reparasi AND a.admin_id=c.admin_id");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><a href="transaksi_struk.php?id_transaksi=<?php echo $d['id_transaksi']; ?>"><?php echo $d['id_transaksi']; ?></a></td>
                  <td><?php echo $d['id_reparasi']; ?></td>
                  <td><?php echo $d['tgl_bayar']; ?></td>
                  <td><?php echo $d['pelanggan']; ?></td>
                  <td><?php echo $d['ket']; ?></td>
                  <td>
                    <a class='btn btn-primary' style="color:white;" href="transaksi_cetak.php?id_transaksi=<?php echo "$d[id_transaksi]"; ?>">Cetak</a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->


        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php include 'footer.php' ?>