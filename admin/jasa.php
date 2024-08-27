<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Jasa Reparasi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Layanan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Jasa Reparasi</h3>
            <a href="jasa_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Tambah Jasa Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>ID JASA</th>
                <th>NAMA JASA REPARASI</th>
                <th>HARGA</th>
                <th>KATEGORI</th>
                <th>JENIS</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT a.id_jasa,a.nama_jasa,a.harga_jasa,a.jenis,
                                                      b.id_jenis,b.nama_jenis,b.kategori,
                                                      c.id_kategori,c.nama_kategori
                                                      FROM jasa as a INNER JOIN jenis as b INNER JOIN kategori as c
                                                      ON a.jenis= b.id_jenis AND b.kategori=c.id_kategori
                                                      ORDER BY a.id_jasa ASC");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td>JR-00<?php echo $d['id_jasa']; ?></td>
                  <td><?php echo $d['nama_jasa']; ?></td>
                  <td><?php echo "Rp. " . number_format($d['harga_jasa']) . ",-"; ?></td>
                  <td><?php echo $d['nama_kategori']; ?></td>
                  <td><?php echo $d['nama_jenis']; ?></td>
                  <td>
                    <a class="btn btn-warning btn-sm" href="jasa_edit.php?id=<?php echo $d['id_jasa'] ?>"><i class="bi bi-gear"></i></a>
                    <a class="btn btn-danger btn-sm" href="jasa_hapus.php?id=<?php echo $d['id_jasa'] ?>"><i class="bi bi-trash"></i></a>
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