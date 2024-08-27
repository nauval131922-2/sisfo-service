<?php include 'header.php'; ?>


<main id="main" class="main">

  <div class="pagetitle">
    <h1>Reparasi Masuk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Reparasi</li>
        <li class="breadcrumb-item active">Reparasi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Reparasi Masuk</h3>
            <a href="reparasi_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Input Reparasi Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>ID REPARASI</th>
                <th>TANGGAL MASUK</th>
                <th>ID PELANGGAN</th>
                <th>ADMIN</th>
                <th>STATUS</th>
                <th width="15%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT a.id_reparasi, a.tgl_reparasi, a.pelanggan, a.admin, a.status,
                                                    b.id_detailreparasi, b.reparasi, b.barang, b.kerusakan, b.kelengkapan, b.qty,
                                                    c.id_pelanggan, c.nama_pelanggan, c.email_pelanggan, c.hp_pelanggan, c.alamat_pelanggan,
                                                    d.admin_id, d.admin_nama
                                                    FROM reparasi as a INNER JOIN detail_reparasi as b INNER JOIN pelanggan as c INNER JOIN admin as d
                                                    ON a.pelanggan=c.id_pelanggan AND a.admin=d.admin_id AND b.reparasi=a.id_reparasi
                                                    WHERE a.status='Diproses' GROUP BY a.id_reparasi ASC");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><a href="reparasi_struk.php?id_reparasi=<?php echo $d['id_reparasi']; ?>"><?php echo $d['id_reparasi']; ?></a></td>
                  <td><?php echo $d['tgl_reparasi']; ?></td>
                  <td>CST-00<?php echo $d['id_pelanggan']; ?></td>
                  <td><?php echo $d['admin_nama']; ?></td>
                  <td><?php echo $d['status']; ?></td>
                  <td>
                    <button class="btn btn-primary btn-sm" onclick="showModal('<?php echo $d['id_reparasi']; ?>')">Selesai</button>
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
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Selesai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Anda yakin Barang Ini Telah Selesai?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Belum</button>
        <button type="button" class="btn btn-primary" id="confirmButton">Selesai</button>
      </div>
    </div>
  </div>
</div>

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

  function showModal(id) {
    reparasiId = id; // Simpan ID reparasi yang dipilih
    var modal = new bootstrap.Modal(document.getElementById('confirmModal'), {
      keyboard: false
    });
    modal.show();
  }

  document.getElementById('confirmButton').addEventListener('click', function() {
    window.location.href = 'reparasi_selesai.php?id=' + reparasiId;
  });
</script>

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