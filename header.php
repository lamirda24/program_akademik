<?php error_reporting(0);
session_start();
if (!isset($_SESSION['kodeuser'])) {
    header("location:login.php");
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMA Budi Agung</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img src="">
                <div class="sidebar-brand-text mx-3">SMA BUDI AGUNG
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-3">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-address-card" style="color:#ffffff"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php if ($_SESSION['role'] == "admin") : ?>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-umbrella-beach" style="color:#ffffff"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Daftar Table :</h6>
                            <a class="collapse-item" href="siswainput.php">Data Siswa</a>
                            <a class="collapse-item" href="guruinput.php">Data Guru</a>
                            <a class="collapse-item" href="kelasinput.php">Data Kelas</a>
                            <a class="collapse-item" href="matpelinput.php">Data Mata Pelajaran</a>
                            <a class="collapse-item" href="pengumumaninput.php">Data Pengumuman</a>
                            <a class="collapse-item" href="admininput.php?inputrole=admin">Data User</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION['role'] == "admin") : ?>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-book" style="color:#ffffff"></i>
                        <span>SPK Beasiswa</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Daftar Menu :</h6>
                            <a class="collapse-item" href="kriteriainput.php">Data Kriteria</a>
                            <a class="collapse-item" href="parameterinput.php">Data Parameter</a>
                            <a class="collapse-item" href="bobotnilaiinput.php">Data Bobot</a>
                            <a class="collapse-item" href="spkInput.php">Pengajuan Beasiswa</a>



                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] == "siswa") : ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-book" style="color:#ffffff"></i>
                        <span>SPK Beasiswa</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Daftar Menu :</h6>
                            <a class="collapse-item" href="spkInput.php">Pengajuan Beasiswa</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION['role'] == "admin") { ?>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-map-marked-alt" style="color:#ffffff"></i>
                        <span>Transaction</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Daftar Table :</h6>
                            <a class="collapse-item" href="jadwalinput.php">Jadwal</a>
                            <a class="collapse-item" href="nilaiKelas.php">Nilai</a>
                            <a class="collapse-item" href="daftarabsensi.php">Absensi</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == "guru") { ?>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-map-marked-alt" style="color:#ffffff"></i>
                        <span>Transaction</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Daftar Table :</h6>
                            <a class="collapse-item" href="nilaiKelas.php">Nilai</a>
                            <a class="collapse-item" href="daftarabsensi.php">Absensi</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitie" aria-expanded="true" aria-controls="collapseUtilitie">
                    <i class="far fa-file-alt" style="color:#ffffff"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseUtilitie" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Daftar Table :</h6>
                        <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "kepsek") : ?>
                            <a class="collapse-item" href="laporanSeluruhSiswa.php?filter=All">Laporan Siswa</a>
                            <a class="collapse-item" href="laporansiswa.php">Laporan Kelas</a>
                            <a class="collapse-item" href="<?= $_SESSION['role'] == 'siswa' ? 'nilaiKelasSiswa.php' : 'laporanNilai.php' ?>">Laporan Nilai</a>
                            <a class="collapse-item" href="laporanGuru.php">Laporan Guru</a>
                            <a class="collapse-item" href="laporanPengumumunan.php">Laporan Pengumuman</a>
                            <a class="collapse-item" href="laporanSpk.php">Laporan Hasil</a>
                            <a class="collapse-item" href="laporanAbsensi.php">Laporan Absensi</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == "guru") : ?>
                            <a class="collapse-item" href="<?= $_SESSION['role'] == 'siswa' ? 'nilaiKelasSiswa.php' : 'laporanNilai.php' ?>">Laporan Nilai</a>
                            <a class="collapse-item" href="laporanPengumumunan.php">Laporan Pengumuman</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] == "siswa") : ?>
                            <a class="collapse-item" href="<?= $_SESSION['role'] == 'siswa' ? 'nilaiKelasSiswa.php' : 'laporanNilai.php' ?>">Laporan Nilai</a>
                            <a class="collapse-item" href="laporanPengumumunan.php">Laporan Pengumuman</a>
                            <a class="collapse-item" href="laporanSpk.php">Laporan Hasil</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout (<?php echo $_SESSION['namauser']; ?>)
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->