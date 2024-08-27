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
  </div>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tambah Jenis Kategori Baru</h3>
            <a href="jenis.php" class="btn btn-primary"><i class="bi bi-reply"></i> &nbsp Kembali</a>
          </div>

          <div class="card-body">
            <form action="jenis_act.php" method="post">
              <br>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Jenis</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama_jenis" required="required" placeholder="Masukkan Nama Jenis..">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                  <select class="form-select" name="kategori" required="required">
                    <option selected>- Pilih Kategori Barang -</option>
                    <?php
                    include '../database.php';
                    $data = mysqli_query($mysqli, "SELECT * FROM kategori");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                      <option value="<?php echo $d['id_kategori']; ?>"><?php echo $d['nama_kategori']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>


            </form>
          </div>
        </div>

      </div>
    </div>


  </section>
</main>
<?php include 'footer.php'; ?>