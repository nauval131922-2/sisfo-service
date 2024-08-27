<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Jasa Reparasi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item active">Jasa Reparasi</li>
      </ol>
    </nav>
  </div>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Edit Jasa Reparasi</h3>
            <a href="jasa.php" class="btn btn-primary"><i class="bi bi-reply"></i> &nbsp Kembali</a>
          </div>

          <div class="card-body">

            <?php
            $id = $_GET['id'];
            $data = mysqli_query($mysqli, "select * from jasa where id_jasa='$id'");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <form action="jasa_update.php" method="post" enctype="multipart/form-data">
                <br>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Nama Jasa</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?php echo $d['id_jasa']; ?>">
                    <input type="text" class="form-control" name="nama_jasa" required="required" placeholder="Masukkan Nama Jasa Reparasi.." value="<?php echo $d['nama_jasa']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Harga Jasa</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga_jasa" required="required" placeholder="Masukkan Harga Jasa Reparasi.." value="<?php echo $d['harga_jasa']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Jenis Kategori</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="jenis" required="required">
                      <option selected>- Pilih Jenis Kategori Barang -</option>
                      <?php
                      include '../database.php';
                      $jenis = mysqli_query($mysqli, "SELECT * FROM jenis");
                      while ($j = mysqli_fetch_array($jenis)) {
                      ?>
                        <option <?php if ($j['id_jenis'] == $d['jenis']) {
                                  echo "selected='selected'";
                                } ?> value="<?php echo $j['id_jenis']; ?>"><?php echo $j['nama_jenis']; ?>
                        </option>
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
            <?php
            }
            ?>
          </div>
        </div>

      </div>
    </div>


  </section>
</main>
<?php include 'footer.php'; ?>