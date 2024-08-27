<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Kategori</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Kategori</li>
      </ol>
    </nav>
  </div>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Kategori</h3>
            <a href="kategori.php" class="btn btn-primary"><i class="bi bi-reply"></i> &nbsp Kembali</a>
          </div>

          <div class="card-body">
            <form action="kategori_update.php" method="post">
              <br>
              <?php
              $id = $_GET['id'];
              $data = mysqli_query($mysqli, "select * from kategori where id_kategori='$id'");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id_kategori" value="<?php echo $d['id_kategori'] ?>">
                    <input type="text" class="form-control" name="nama_kategori" required="required" placeholder="Masukkan Nama Kategori.." value="<?php echo $d['nama_kategori'] ?>">
                  </div>
                </div>

                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
              <?php
              }
              ?>
            </form>
          </div>
        </div>

      </div>
    </div>


  </section>
</main>
<?php include 'footer.php'; ?>