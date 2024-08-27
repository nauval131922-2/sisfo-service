<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Kategori</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Kategori</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Kategori</h3>
            <a href="kategori_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Tambah Kategori Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>ID KATEGORI</th>
                <th>NAMA KATEGORI</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT * FROM kategori");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td>KT-00<?php echo $d['id_kategori']; ?></td>
                  <td><?php echo $d['nama_kategori']; ?></td>
                  <td>
                    <a class="btn btn-warning btn-sm" href="kategori_edit.php?id=<?php echo $d['id_kategori'] ?>"><i class="bi bi-gear"></i></a>
                    <a class="btn btn-danger btn-sm" href="kategori_hapus.php?id=<?php echo $d['id_kategori'] ?>"><i class="bi bi-trash"></i></a>
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