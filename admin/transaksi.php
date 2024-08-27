<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Transaksi Masuk</h1>
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
            <h3 class="card-title mb-0">Data Transaksi Masuk</h3>
            <a href="reparasi_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Input Reparasi Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr align="center">
                <th width="1%">NO</th>
                <th>ID REPARASI</th>
                <th>TANGGAL REPARASI</th>
                <th>NAMA PELANGGAN</th>
                <th>PEMBELIAN</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "select * from reparasi inner join pelanggan on reparasi.pelanggan=pelanggan.id_pelanggan where status='Selesai' ");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><a href="reparasi_struk.php?id_reparasi=<?php echo $d['id_reparasi']; ?>"><?php echo $d['id_reparasi']; ?></a></td>
                  <td><?php echo $d['tgl_reparasi']; ?></td>
                  <td><?php echo $d['nama_pelanggan']; ?></td>
                  <td>
                    <a class='btn btn-success' style="color:white;" href="detail_jasa_tambah.php?id_reparasi=<?php echo "$d[id_reparasi]"; ?>">Jasa</a>

                    <a class='btn btn-primary' style="color:white;" href="detail_sparepart_tambah.php?id_reparasi=<?php echo "$d[id_reparasi]"; ?>">Sparepart</a>
                    <a class='btn btn-danger  ' style="color:white;" href="transaksi_pembayaran.php?id_reparasi=<?php echo "$d[id_reparasi]"; ?>">Bayar</a>
                  </td>
                  <td>
                    <button class="btn btn-warning btn-sm" onclick="showModalBatal('<?php echo $d['id_reparasi']; ?>')">Batal</button>
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

<!-- Modal -->
<div class="modal fade" id="batalModal" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="batalModalLabel">Konfirmasi Batal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Anda yakin Barang Ini Batal di Reparasi?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-primary" id="batalButton">Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
  var reparasiId = '';

  function showModalBatal(id) {
    reparasiId = id; // Simpan ID reparasi yang dipilih
    var modal = new bootstrap.Modal(document.getElementById('batalModal'), {
      keyboard: false
    });
    modal.show();
  }

  document.getElementById('batalButton').addEventListener('click', function() {
    window.location.href = 'reparasi_batal.php?id=' + reparasiId;
  });
</script>

<?php include 'footer.php' ?>