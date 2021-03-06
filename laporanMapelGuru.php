<!DOCTYPE html>

<?php
include "includes/config.php";
session_start();

$filter = $_GET['filter'];
if ($filter == "mapel") {

    $kodeMapel = $_GET['mapel'];
    $query = mysqli_query($connection, "SELECT * FROM jadwal where kode_matpel ='$kodeMapel'");
    $numrows = mysqli_num_rows($query);
    $namamapel  = mysqli_query($connection, "SELECT * FROM jadwal where kode_matpel='$kodeMapel' ");
    $res = mysqli_fetch_assoc($namamapel);
} elseif ($filter == "kelas") {
    $kodeKelas = $_GET['kelas'];
    $query = mysqli_query($connection, "SELECT * FROM jadwal where kode_kelas ='$kodeKelas'");
    $numrows = mysqli_num_rows($query);
    $namamapel  = mysqli_query($connection, "SELECT * FROM jadwal where kode_kelas='$kodeKelas' ");
    $res = mysqli_fetch_assoc($namamapel);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Matapelajaran</title>
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
                    <?php if ($filter == "kelas") { ?>
                        <h1 class="display-4">Laporan Matapelajaran Kelas <?= $res['nama_kelas'] ?></h1>

                    <?php } elseif ($filter == "mapel") { ?>
                        <h1 class="display-4">Laporan Matapelajaran <?= $res['matpel'] ?></h1>

                    <?php } ?>
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
                    <?php if ($filter == "kelas") { ?>
                        <a href="cetakLaporanMapelGuru.php?filter=kelas&kelas=<?= $kodeKelas ?>" target="_blank" class="btn btn-warning ml-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg> Print
                        </a>
                    <?php } elseif ($filter == "mapel") { ?>
                        <a href="cetakLaporanMapelGuru.php?filter=mapel&mapel=<?= $kodeMapel ?>" target="_blank" class="btn btn-warning ml-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg> Print
                        </a>
                    <?php } ?>

                </div>


            </div>


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th><?= $filter == "kelas" ? "Mata Pelajaran" : "Kelas" ?></th>
                        <th>Tahun</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>



                    </tr>
                </thead>

                <tbody>
                    <?php

                    if ($numrows > 0) {
                        $nomor = 1;
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $filter == "kelas" ? $row['matpel'] : $row['nama_kelas']; ?></td>
                                <td><?php echo $row['tahun']; ?></td>
                                <td><?php echo $row['guru']; ?></td>
                                <td><?php echo $row['hari']; ?></td>
                                <td><?php echo $row['jammulai']; ?></td>
                                <td><?php echo $row['jamselesai']; ?></td>



                                <!-- untuk icon edit dan delete -->

                            </tr>
                            <?php $nomor = $nomor + 1; ?>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">no data</td>
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