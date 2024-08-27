<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Customer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Customer</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Customer</h3>
            <a href="customer_tambah.php" class="btn btn-primary"><i class="ri-add-circle-line"></i> &nbsp Tambah Customer Baru</a>
          </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>HP</th>
                <th>ALAMAT</th>
                <th width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../database.php';
              $no = 1;
              $data = mysqli_query($mysqli, "SELECT * FROM pelanggan");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d['nama_pelanggan']; ?></td>
                  <td><?php echo $d['email_pelanggan']; ?></td>
                  <td><?php echo $d['hp_pelanggan']; ?></td>
                  <td><?php echo $d['alamat_pelanggan']; ?></td>
                  <td>
                    <a class="btn btn-warning btn-sm" href="customer_edit.php?id=<?php echo $d['id_pelanggan'] ?>"><i class="bi bi-gear"></i></a>
                    <a class="btn btn-danger btn-sm" href="customer_hapus_konfir.php?id=<?php echo $d['id_pelanggan'] ?>"><i class="bi bi-trash"></i></a>
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