<!DOCTYPE html>

<?php
$kode_kelas = $_GET['kelas'];
include "includes/config.php";
$query = mysqli_query($connection, "SELECT * FROM jadwal WHERE kode_kelas='$kode_kelas'");
$rowcount = mysqli_num_rows($query);



?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jadwal</title>
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

            <div class="col-sm-1">
            </div>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Laporan Jadwal <?= $res['nama_kelas'] ?> </h1>
                </div>
            </div>
            <!--penutup jumbotron-->
            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3"></label>
                    <div class="col-sm-11">

                    </div>
                    <a href="cetakLaporanJadwal.php?kelas=<?= $kode_kelas ?>" target="_blank" class="btn btn-warning btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg> Print
                    </a>
                </div>
            </form>




            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Matapelajaran</th>
                        <th>Semester</th>
                        <th>Tahun</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $nomor = 1;
                    if ($rowcount > 0) {


                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $row['matpel']; ?></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td><?php echo $row['tahun']; ?></td>
                                <td><?php echo $row['guru']; ?></td>
                                <td><?php echo $row['hari']; ?></td>

                                <td><?php echo $row['jammulai']; ?></td>
                                <td><?php echo $row['jamselesai']; ?></td>


                                <!-- akhir icon edit delete -->
                            </tr>
                            <?php $nomor = $nomor + 1; ?>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="7">no data</td>
                            <!-- akhir icon edit delete -->
                        </tr>
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