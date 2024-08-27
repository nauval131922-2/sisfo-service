<?php include 'header.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Sparepart</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Data Transaksi</li>
                <li class="breadcrumb-item active">Detail Sparepart</li>
            </ol>
        </nav>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!--row -->
            <!-- .card -->
            <div class="card ">
                <div class="card-header">
                    <ul class="navbar-nav ml-auto">
                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item">
                            <a href="transaksi.php" class="nav-link">

                                <p><button class="btn btn-warning"><i class="bi bi-reply"></i></i></i><b> Kembali </b></button></p>

                            </a>
                        </li>
                </div>


                <!-- /.card-header -->
                <div class="card-body" style="width:90%;margin:0 auto;"><br>
                    <!-- Form servis -->
                    <h2 align="Center" class="m-0 text-dark">Sparepart Yang Di Beli </h2><br>

                    <?php include "../database.php";

                    $data = mysqli_query($mysqli, "select * from reparasi inner join pelanggan on reparasi.pelanggan=pelanggan.id_pelanggan where id_reparasi='$_GET[id_reparasi]'");
                    $d = mysqli_fetch_array($data);
                    ?>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">id Reparasi :</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" value="<?php echo $d['id_reparasi']; ?>" name="id_reparasi" readonly="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal Reparasi :</label>
                        <div class="col-sm-5">
                            <input type="text" readonly="" class="form-control" name="tanggal_reparasi" value="<?php echo $d['tgl_reparasi']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama Pelanggan :</label>
                        <div class="col-sm-5">
                            <input type="text" readonly="" class="form-control" name="nama_pelanggan" value="<?php echo $d['nama_pelanggan']; ?>">
                        </div>
                    </div>
                    <br>

                    <!-- / Form Servis -->

                    <div class="card ">
                        <!-- Sub Card -->
                        <div class="card " style="border:none;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Input Sparepart</h3>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="detail_sparepart_act.php">

                                    <?php
                                    include "../database.php";
                                    $idtransaksi = mysqli_query($mysqli, "select * from transaksi where id_reparasi='$_GET[id_reparasi]' ");
                                    $it = mysqli_fetch_array($idtransaksi);
                                    ?>

                                    <input type="hidden" class="form-control" value="<?php echo $it['id_transaksi']; ?>" name="id_transaksi" readonly="">

                                    <input type="hidden" class="form-control" value="<?php echo $d['id_reparasi']; ?>" name="id_reparasi" readonly="">
                                    <br>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Jenis Kategori</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" id="jenis" name="jenis">
                                                <option selected>- Pilih Jenis Kategori -</option>
                                                <?php
                                                include "../database.php";
                                                $tampil = mysqli_query($mysqli, "SELECT * FROM jenis ");
                                                while ($d = mysqli_fetch_array($tampil)) {
                                                    echo "<option value='$d[id_jenis]'> $d[nama_jenis] </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Pilih Sparepart </label>
                                        <div class="col-sm-5">
                                            <select class="form-control" id="sparepart" name="sparepart">
                                                <option selected>- Pilih Jenis Sparepart -</option>
                                                <?php
                                                include "../database.php";
                                                $tampil = mysqli_query($mysqli, "SELECT * FROM sparepart ");
                                                while ($d = mysqli_fetch_array($tampil)) {
                                                    echo "<option value='$d[id_sparepart]' data-nama='$d[nama_sparepart]' data-harga='$d[harga_sparepart]'> $d[nama_sparepart] - $d[harga_sparepart]</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!-- Nama Jasa -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Nama Sparepart</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" required id="nama_sparepart" name="nama_sparepart">
                                        </div>
                                    </div>

                                    <!-- Harga -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" required id="harga" name="harga" onkeyup="calculateSubtotal();">
                                        </div>
                                    </div>

                                    <!-- Qty -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">QTY</label>
                                        <div class="col-sm-5">
                                            <input type="number" class="form-control" required id="qty" name="qty" onkeyup="calculateSubtotal();">
                                        </div>
                                    </div>

                                    <!-- Sub Total -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sub Total</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" required id="sub_total" name="sub_total">
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-outline-success"> Pilih Sparepart </button>
                                        </div>

                                    </div>


                                </form>
                            </div>


                        </div>


                        <div class="card-body">


                            <table class="table" id="tabel_jasa">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Sparepart </th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php include "../database.php";
                                    $no = 0;
                                    $data = mysqli_query($mysqli, "select * from transaksi_sparepart where id_reparasi='$_GET[id_reparasi]' ");
                                    while ($d = mysqli_fetch_array($data)) {
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?php echo "$no"; ?> </td>
                                            <td><?php echo "$d[nama_sparepart]"; ?> </td>
                                            <td><?php echo "$d[qty]"; ?> </td>
                                            <td><?php echo "$d[sub_total]"; ?> </td>
                                            <td>
                                                <button class='btn btn-warning btn-sm' onclick="showModalHapus('<?php echo $d['id_sparepart']; ?>', '<?php echo $d['id_reparasi']; ?>')">Hapus</button>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                <tbody>
                            </table>
                            <br>

                            <?php
                            include "../database.php";
                            $jumlahkan = mysqli_query($mysqli, " SELECT SUM(sub_total) as total from transaksi_sparepart where id_reparasi='$_GET[id_reparasi]'");
                            $t = mysqli_fetch_array($jumlahkan);
                            ?>
                            <table style="width:30%;" align="right">
                                <tr style="font-size:20px;">
                                    <td><strong> Total : </strong></td>
                                    <td> <strong><span style="color:red;text-decoration:underline">Rp.<?php echo number_format($t['total'])  ?> </span></strong></td>
                                </tr>
                            </table>


                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- / Sub Card -->

                </div>


                <!-- /Form Edit -->
            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.card -->


        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->


    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary" id="hapusButton">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sparepartSelect = document.getElementById('sparepart');
        const namaSparepartInput = document.getElementById('nama_sparepart');
        const hargaInput = document.getElementById('harga');
        const qtyInput = document.getElementById('qty');
        const subTotalInput = document.getElementById('sub_total');

        sparepartSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const namaSparepart = selectedOption.getAttribute('data-nama');
            const harga = selectedOption.getAttribute('data-harga').replace(/\./g, ''); // Remove dots for calculation

            namaSparepartInput.value = namaSparepart;
            hargaInput.value = harga;
            calculateSubtotal();
        });

        function formatRupiah(angka) {
            const number_string = angka.replace(/[^,\d]/g, '').toString();
            const split = number_string.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function calculateSubtotal() {
            const harga = parseInt(hargaInput.value.replace(/\./g, ''), 10) || 0;
            const qty = parseInt(qtyInput.value, 10) || 0;
            const subTotal = harga * qty;

            subTotalInput.value = formatRupiah(subTotal.toString());
        }

        // Initialize harga input with format
        hargaInput.addEventListener('keyup', calculateSubtotal);
        qtyInput.addEventListener('keyup', calculateSubtotal);
    });
</script>

<script>
    var reparasiId = '';
    var sparepartId = '';

    function showModalHapus(sparepartIdParam, reparasiIdParam) {
        sparepartId = sparepartIdParam;
        reparasiId = reparasiIdParam; // Simpan ID reparasi yang dipilih
        var modal = new bootstrap.Modal(document.getElementById('hapusModal'), {
            keyboard: false
        });
        modal.show();
    }

    document.getElementById('hapusButton').addEventListener('click', function() {
        window.location.href = 'detail_sparepart_hapus.php?id_sparepart=' + sparepartId + '&id_reparasi=' + reparasiId;
    });
</script>

<?php include 'footer.php'; ?>