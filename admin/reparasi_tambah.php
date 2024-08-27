<?php include 'header.php'; ?>

<?php
include '../database.php';

date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d");


$query = "select max(id_reparasi) as maxKode from reparasi";
$hasil = mysqli_query($mysqli, $query);
$data = mysqli_fetch_array($hasil);
$id_reparasi = $data['maxKode'];
$no_urut = (int) substr($id_reparasi, 9, 3);


$tahun = substr($date, 0, 4);
$bulan = substr($date, 5, 2);



$no_urut++;
$char = "SV";
$id_reparasi = $char . $tahun . $bulan . sprintf("%03s", $no_urut);
?>

<script>
  $(function() {
    $(".date-picker").datepicker({
      dateFormat: 'dd-mm-yy'
    });
  });
</script>

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
  </div>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-info">

          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tambah Reparasi Baru</h3>
            <a href="reparasi.php" class="btn btn-primary"><i class="bi bi-reply"></i> &nbsp Kembali</a>
          </div>

          <div class="card-body">
            <form action="reparasi_act.php" method="post" enctype="multipart/form-data">

              <div class="row mb-1">
                <div class="col-sm-6">
                  <label class="col-form-label">ID Reparasi</label>
                  <input type="text" class="form-control" id="id_reparasi" name="id_reparasi" value="<?php echo $id_reparasi; ?>" readonly required>
                </div>

                <div class="col-sm-6">
                  <label class="col-form-label">ID Customer</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" placeholder="Pilih Customer.." readonly required>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-pelanggan">
                      Cari Customer
                    </button>
                  </div>
                </div>
              </div>

              <!-- Modal for customer selection -->
              <div class="modal fade" id="modal-pelanggan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Daftar Customer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-bordered" id="customerTable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Customer</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $query = mysqli_query($mysqli, "SELECT * FROM pelanggan ORDER BY nama_pelanggan DESC")
                            or die('Ada kesalahan pada query tampil data barang: ' . mysqli_error($mysqli));

                          while ($data = mysqli_fetch_assoc($query)) {
                            $id_pelanggan = $data['id_pelanggan'];
                            $nama_pelanggan = $data['nama_pelanggan'];
                            $alamat_pelanggan = $data['alamat_pelanggan'];
                            $hp_pelanggan = $data['hp_pelanggan'];
                          ?>

                            <tr>
                              <td class="center"><?php echo $no++; ?></td>
                              <td><?php echo $id_pelanggan; ?></td>
                              <td><?php echo $nama_pelanggan; ?></td>
                              <td><?php echo $alamat_pelanggan; ?></td>
                              <td><?php echo $hp_pelanggan; ?></td>

                              <td class="center">
                                <button type="button" class="pilih_pelanggan btn btn-primary btn-xs" data-id-p="<?php echo $id_pelanggan; ?>" data-nama-p="<?php echo $nama_pelanggan; ?>">
                                  Pilih
                                </button>
                              </td>
                            </tr>

                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-6">
                  <label class="col-form-label">Tanggal Reparasi</label>
                  <input class="form-control date-picker" type="date" data-date-format="dd-mm-yyyy" id="tanggal_reparasi" name="tanggal_reparasi" value="<?php echo date("d-m-Y"); ?>" required>
                </div>


                <div class="col-sm-6">
                  <label class="col-form-label">Nama Customer</label>
                  <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required="required" placeholder="Nama Customer" readonly required>
                </div>
              </div>



              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>
            </form>

            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Detail Reparasi:</h3>
              <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-detail-reparasi"><i class="ri-add-circle-line"></i> &nbsp Tambah</a>
            </div>

            <!-- Tabel Detail Reparasi -->
            <div class="table-responsive">
              <table class="table table-bordered" id="detailReparasiTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Reparasi</th>
                    <th>Nama Barang</th>
                    <th>Kerusakan</th>
                    <th>Kelengkapan</th>
                    <th>Qty</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../database.php';
                  $no = 1;
                  $data = mysqli_query($mysqli, "SELECT * FROM detail_reparasi where reparasi ='$id_reparasi'");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>

                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['reparasi']; ?> </td>
                      <td><?php echo $d['barang']; ?> </td>
                      <td><?php echo $d['kerusakan']; ?> </td>
                      <td><?php echo $d['kelengkapan']; ?> </td>
                      <td><?php echo $d['qty']; ?> </td>
                      <td align="center">
                        <button class='btn btn-warning btn-hapus' data-nama="<?php echo $d['barang']; ?>">Hapus</button>


                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <!-- Modal untuk Tambah Detail Reparasi -->
            <div class="modal fade" id="modal-detail-reparasi" tabindex="-1" aria-labelledby="modalDetailReparasiLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailReparasiLabel">Tambah Detail Reparasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="form-detail-reparasi" action="detail_reparasi_act.php" method="post" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <label for="modal-id-reparasi" class="col-form-label">ID Reparasi</label>
                          <input type="text" class="form-control" id="modal-id-reparasi" name="id_reparasi" value="<?php echo $id_reparasi; ?>" readonly>
                        </div>

                        <div class="col-sm-6">
                          <label for="modal-nama-barang" class="col-form-label">Nama Barang</label>
                          <input type="text" class="form-control" id="modal-nama-barang" name="nama_barang" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <label for="modal-kerusakan" class="col-form-label">Kerusakan</label>
                          <input type="text" class="form-control" id="modal-kerusakan" name="kerusakan" required>
                        </div>
                        <div class="col-sm-6">
                          <label for="modal-kelengkapan" class="col-form-label">Kelengkapan</label>
                          <input type="text" class="form-control" id="modal-kelengkapan" name="kelengkapan" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <label for="modal-qty" class="col-form-label">Qty</label>
                          <input type="number" class="form-control" id="modal-qty" name="qty" required>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <button type="reset" class="btn btn-danger">Bersihkan</button>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  // JavaScript untuk menangani pemilihan pelanggan
  document.addEventListener("DOMContentLoaded", function() {
    // Pilih semua tombol dengan kelas .pilih_pelanggan
    var pilihButtons = document.querySelectorAll(".pilih_pelanggan");
    pilihButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        // Ambil data-id-p dan data-nama-p dari atribut data pada tombol yang diklik
        var idPelanggan = this.getAttribute("data-id-p");
        var namaPelanggan = this.getAttribute("data-nama-p");
        // Isi input field dengan data yang dipilih
        document.getElementById("id_pelanggan").value = idPelanggan;
        document.getElementById("nama_pelanggan").value = namaPelanggan;
        // Tutup modal
        var modal = bootstrap.Modal.getInstance(document.getElementById("modal-pelanggan"));
        modal.hide();
      });
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("detailReparasiTable").addEventListener("click", function(event) {
      if (event.target && event.target.classList.contains("btn-hapus")) {
        // Ambil baris tempat tombol hapus berada
        var row = event.target.closest("tr");
        // Ambil nama barang dari atribut data-nama
        var namaBarang = event.target.getAttribute("data-nama");

        // Konfirmasi sebelum menghapus
        if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
          // Kirim permintaan AJAX untuk menghapus data dari server
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "delete_detail_reparasi.php?nama=" + encodeURIComponent(namaBarang), true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              // Hapus baris dari tabel jika penghapusan berhasil
              row.remove();
            }
          };
          xhr.send();
        }
      }
    });
  });
</script>


<?php include 'footer.php'; ?>