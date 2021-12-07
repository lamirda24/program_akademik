<!DOCTYPE html>

<?php
include "includes/config.php";

$kode_kelas = $_GET['kelas'];
$kode_matpel = $_GET['matpel'];
$absensi = mysqli_query($connection, "SELECT absensi.*, siswa.nama_siswa FROM absensi JOIN siswa ON absensi.siswa = siswa.kode_siswa where absensi.kode_kelas='$kode_kelas' AND matpel='$kode_matpel'");

$query = mysqli_query($connection, "SELECT * from kelas where kode_kelas='" . $kode_kelas . "'");
$res = mysqli_fetch_array($query);


$queryMatpel = mysqli_query($connection, "SELECT * from matapelajaran where kode_matpel='" . $kode_matpel . "'");
$result = mysqli_fetch_array($queryMatpel);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");
?>
<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <body>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Hadir Kelas : <?= $res[1] . " " . $res[2] . " " . $res[3] ?></h1>
                    <h2 class="display-5">Mata Pelajaran: <?= $result['nama_matpel'] ?></h2>

                </div>
            </div>
            <!--penutup jumbotron-->
            <div class="row mb-3">

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>


                <div class="col-md-2">
                    <a href="cetakAbsensiKelas.php?kelas=<?= $kode_kelas ?>&matpel=<?= $kode_matpel ?>" target="_blank" class="btn btn-warning ml-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg> Print
                    </a>
                </div>


            </div>


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Kehadiran</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $nomor = 1;
                    while ($row = mysqli_fetch_array($absensi)) {
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['siswa']; ?></td>
                            <td><?php echo $row['nama_siswa'] ?></td>
                            <td><?php echo ($row['kehadiran'] == 1 ? "Hadir" : "Tidak Hadir"); ?></td>
                            <!-- akhir icon edit delete -->
                        </tr>
                        <?php $nomor = $nomor + 1; ?>
                    <?php } ?>
                </tbody>

            </table>

    </div>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
    <!--penutup container fluid-->
</div>
</div>
</div>
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>