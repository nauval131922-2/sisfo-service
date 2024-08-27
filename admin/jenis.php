<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Jenis Kategori</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Jenis Kategori</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Jenis Kategori</h3>
            <a href="jenis_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Tambah Jenis Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>ID JENIS</th>
                <th>NAMA JENIS KATEGORI</th>
                <th>KATEGORI</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT a.id_jenis,a.kategori,a.nama_jenis,
                                              b.id_kategori,b.nama_kategori
                                              FROM jenis as a INNER JOIN kategori as b
                                              ON a.kategori=b.id_kategori
                                              ORDER BY a.kategori DESC");

              $current_kategori = '';
              $rowspan_count = 0;
              $jenis_data = [];

              while ($d = mysqli_fetch_array($data)) {
                $jenis_data[$d['nama_kategori']][] = $d;
              }

              foreach ($jenis_data as $kategori => $jenis_list) {
                $rowspan_count = count($jenis_list);
                $first_row = true;

                foreach ($jenis_list as $d) {
              ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td>JK-00<?php echo $d['id_jenis']; ?></td>
                    <td><?php echo $d['nama_jenis']; ?></td>
                    <?php if ($first_row) : ?>
                      <td rowspan="<?php echo $rowspan_count; ?>" class="align-middle text-center"><?php echo $kategori; ?></td>
                    <?php endif; ?>
                    <td>
                      <a class="btn btn-warning btn-sm" href="jenis_edit.php?id=<?php echo $d['id_jenis'] ?>"><i class="bi bi-gear"></i></a>
                      <a class="btn btn-danger btn-sm" href="jenis_hapus.php?id=<?php echo $d['id_jenis'] ?>"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
              <?php
                  $first_row = false;
                }
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