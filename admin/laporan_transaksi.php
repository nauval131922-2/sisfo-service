<?php include 'header.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Laporan Transaksi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active">Laporan Transaksi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">


      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">Laporan Transaksi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width:80%;margin:0 auto;">

          <div class="container">
            <div class="panel">
              <div class="panel-heading">
                <h4>Filter Laporan</h4>
              </div>
              <div class="panel-body">

                <form action="laporan_transaksi.php" method="get">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th>Dari Tanggal</th>
                      <th>Sampai Tanggal</th>
                      <th width="1%"></th>
                    </tr>
                    <tr>
                      <td>
                        <br />
                        <input type="date" name="tgl_dari" class="form-control">
                      </td>
                      <td>
                        <br />
                        <input type="date" name="tgl_sampai" class="form-control">
                        <br />
                      </td>
                      <td>
                        <br />
                        <input type="submit" class="btn btn-primary" value="Filter">
                      </td>
                    </tr>

                  </table>
                </form>

              </div>
            </div>
            <br />

            <?php
            if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])) {

              $dari = $_GET['tgl_dari'];
              $sampai = $_GET['tgl_sampai'];

            ?>
              <div class="panel">
                <div class="panel-heading">
                  <h4>Data Laporan Transaksi dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
                </div>
                <div class="panel-body">

                  <a target="_blank" href="cetak_transaksi.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>

                  <br />
                  <br />
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="1%">No</th>
                      <th>id Transaksi</th>
                      <th>Tanggal</th>
                      <th>Pelanggan</th>
                      <th>Total</th>
                      <th>Bayar</th>
                      <th>Kembali</th>

                    </tr>

                    <?php
                    // koneksi database
                    include '../database.php';



                    // mengambil data pelanggan dari database
                    $data = mysqli_query($mysqli, "select * from transaksi where ket='Lunas' and date(tgl_bayar) > '$dari' and date(tgl_bayar) < '$sampai' ");
                    $no = 1;
                    // mengubah data ke array dan menampilkannya dengan perulangan while
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><a href="transaksi_struk.php?id_transaksi=<?php echo $d['id_transaksi']; ?>" target='_blank'><?php echo $d['id_transaksi']; ?></a></td>
                        <td><?php echo $d['tgl_bayar']; ?></td>
                        <td><?php echo $d['pelanggan']; ?></td>
                        <td><?php echo $d['jumlah_total']; ?></td>
                        <td><?php echo $d['bayar']; ?></td>
                        <td><?php echo $d['kembalian']; ?></td>

                      </tr>
                    <?php
                    }
                    ?>
                  </table>
                  <?php
                  include "../database.php";
                  $jumlahkan = mysqli_query($mysqli, " SELECT SUM(jumlah_total) as total from transaksi where  ket='Lunas' and date(tgl_bayar) > '$dari' and date(tgl_bayar) < '$sampai' ");
                  $t = mysqli_fetch_array($jumlahkan);
                  ?>
                  <table style="width:30%;" align="right">
                    <tr style="font-size:20px;">
                      <td> Total : </td>
                      <td> <strong><span style="color:red;text-decoration:underline">Rp.<?php echo number_format($t['total'])  ?> </strong></span></td>
                    </tr>
                  </table>
                </div>
              </div>
            <?php } ?>

          </div>





          <!-- /.card-body -->
        </div>

      </div>

    </div>
    </div>
  </section>

</main><!-- End #main -->

<?php include 'footer.php' ?>