<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Polytron Service Center</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div align=center><a href="index.php"><img src="assets/img/logoskm.png" width=150px></a></div><br>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Daftar Akun Pelanggan</h5>
                    <p class="text-center small">Masukkan data pribadi kamu untuk membuat akun!</p>
                  </div>

                  <?php
                  if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == "duplikat") {
                      echo "<div class='alert alert-danger text-center'>Maaf email ini sudah digunakan, silahkan gunakan email yang lain.</div>";
                    }
                  }
                  ?>

                  <form form action="daftar_act.php" method="post">
                    <div class="col-12">
                      <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                      <input type="text" name="nama_pelanggan" class="form-control" id="namaPelanggan" required>
                      <div class="invalid-feedback">Masukkan nama pelanggan!</div>
                    </div>

                    <div class="col-12">
                      <label for="emailPelanggan" class="form-label">Email Pelanggan</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email_pelanggan" class="form-control" id="emailPelanggan" required>
                        <div class="invalid-feedback">Masukkan email pelanggan!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="hpPelanggan" class="form-label">Nomor HP Pelanggan</label>
                      <input type="text" name="hp_pelanggan" class="form-control" id="hpPelanggan" required>
                      <div class="invalid-feedback">Masukkan nomor HP pelanggan!</div>
                    </div>

                    <div class="col-12">
                      <label for="alamatPelanggan" class="form-label">Alamat Pelanggan</label>
                      <textarea name="alamat_pelanggan" class="form-control" id="alamatPelanggan" rows="3" required></textarea>
                      <div class="invalid-feedback">Masukkan alamat pelanggan!</div>
                    </div>

                    <div class="col-12">
                      <label for="passwordPelanggan" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input type="password" name="password_pelanggan" class="form-control" id="passwordPelanggan" required>
                        <div class="invalid-feedback">Masukkan password!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Saya setuju dan menerima <a href="#">syarat dan ketentuan</a></label>
                        <div class="invalid-feedback">Anda harus setuju sebelum mengirimkan.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="login_pelanggan.php">Masuk</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Made With <span style="color: #e25555;">&#10084;</span> By M. Khanifan
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>