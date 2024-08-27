<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php
        if ($_SESSION['hak_akses'] == "Manager") {
        ?>


            <li class="nav-heading">Data Master</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#masterdata-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="masterdata-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="customer.php">
                            <i class="bi bi-circle"></i><span>Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="kategori.php">
                            <i class="bi bi-circle"></i><span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="jenis.php">
                            <i class="bi bi-circle"></i><span>Jenis Kategori</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#layanan-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Layanan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="layanan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="jasa.php">
                            <i class="bi bi-circle"></i><span>Daftar Jasa Reparasi</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#sparepart-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Sparepart</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="sparepart-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="sparepart.php">
                            <i class="bi bi-circle"></i><span>Daftar Sparepart</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

            <li class="nav-heading">Data Reparasi Masuk</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="reparasi.php">
                    <i class="bi bi-person"></i>
                    <span>Input Reparasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="transaksi.php">
                    <i class="bi bi-person"></i>
                    <span>Transaksi</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-heading">Data Transaksi</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="transaksi_selesai.php">
                    <i class="bi bi-person"></i>
                    <span>Data Transaksi</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-heading">Laporan</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Jenis Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="laporan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="laporan_transaksi.php">
                            <i class="bi bi-circle"></i><span>Laporan Transaksi</span>
                        </a>
                    </li>

                    <li>
                        <a href="laporan_jasa.php">
                            <i class="bi bi-circle"></i><span>Laporan Jasa</span>
                        </a>
                    </li>

                    <li>
                        <a href="laporan_sparepart.php">
                            <i class="bi bi-circle"></i><span>Laporan Sparepart</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-heading">Hak Akses</li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#hakakses-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Fasilitas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="hakakses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="pengguna.php">
                            <i class="bi bi-circle"></i><span>Akun Pengguna</span>
                        </a>
                    </li>

                    <li>
                        <a href="under_construction.php">
                            <i class="bi bi-circle"></i><span>Under Construction</span>
                        </a>
                    </li>

                </ul>
            </li>

        <?php
        } else if ($_SESSION['hak_akses'] == "CS") {
        ?>
            <li class="nav-heading">Data Master</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="customer.php">
                    <i class="bi bi-person"></i>
                    <span>Customer</span>
                </a>
            </li>

        <?php
        }
        ?>


    </ul>

</aside><!-- End Sidebar-->