<!DOCTYPE html>

<?php
session_start();
include "includes/config.php";


if ($_SESSION['role'] == "siswa") {

    $kode_siswa = $_SESSION['kodeuser'];
    $qKelas = mysqli_query($connection, "SELECT * FROM kelasdetail where kode_siswa='$kode_siswa'");
    $resKelas = mysqli_fetch_assoc($qKelas);
    $kode_kelas = $resKelas['kode_kelas'];
    $q = mysqli_query($connection, "SELECT * FROM nilai where kelas='$kode_kelas' and siswa='$kode_siswa'");

    $q1 = mysqli_query($connection, "SELECT nama_siswa from siswa where kode_siswa='$kode_siswa'");
    $nama_siswa = mysqli_fetch_row($q1);
} else {

    $kode_kelas = $_GET['kelas'];
    $kode_siswa = $_GET['siswa'];
    $q = mysqli_query($connection, "SELECT * FROM nilai join siswa on nilai.kode_siswa = siswa.kode_siswa where kode_kelas='$kode_kelas' and nilai.kode_siswa='$kode_siswa'");
    $q1 = mysqli_query($connection, "SELECT nama_siswa from siswa where kode_siswa='$kode_siswa'");
    $nama_siswa = mysqli_fetch_row($q1);
}

// echo "SELECT * FROM nilai join siswa on nilai.kode_siswa = siswa.kode_siswa where kode_kelas='$kode_kelas' and nilai.kode_siswa='$kode_siswa'";


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
ob_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");
?>
<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <body>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Nilai Murid: <?= $nama_siswa[0] ?> </h1>
                </div>
            </div>
            <!--penutup jumbotron-->
            <div class="row">

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
                <div class="col-xl-2 mb-2">
                    <?php if ($_SESSION['kodeuser'] != "siswa") : ?>
                        <a href="printNilaiKelas.php?kelas=<?php echo $kode_kelas ?>&siswa=<?= $kode_siswa ?>" class="btn btn-warning btn-sm" title="Print">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg> Print
                        </a>
                    <?php endif; ?>
                </div>


            </div>


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Matpel</th>
                        <th>Rata Rata</th>

                    </tr>
                </thead>

                <tbody>
                    <?php

                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($q)) {
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['kode_kelas']; ?></td>
                            <td><?php echo $row['matpel']; ?></td>

                            <td><?php echo number_format((($row['nilai_akhir'])), 2, ","); ?></td>






                            <!-- untuk icon edit dan delete -->



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