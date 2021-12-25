<!DOCTYPE html>

<?php
include "includes/config.php";
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");

$kodeKelas = $_GET['kelas'];
$kodeMatpel = $_GET['mapel'];
$tgl = $_GET['date'];

$query = mysqli_query($connection, "select * from absensi join siswa on absensi.siswa  = siswa.kode_siswa where kode_kelas='$kodeKelas' and matpel='$kodeMatpel' and tgl_absen='$tgl'");
// echo "select * from absensi join siswa on absensi.kode_siswa  = siswa.kode_siswa where kode_kelas='$kodeKelas' and matpel='$kodeMatpel' and tgl_absen='$tgl'";
// die;





?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>


<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <body>

            <div class="row">
                <div class="col-sm-1">
                </div>



            </div>
            <!--penutup class row-->

            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Daftar Kehadiran</h1>
                            <h3> Tanggal <?= date("d F Y", strtotime($_GET['date'])) ?></h3>
                        </div>
                    </div>

                    <!--penutup jumbotron-->

                    <a href="cetakAbsensiKelas.php?date=<?= $tgl ?>&kelas=<?= $kodeKelas  ?>&matpel=<?= $kodeMatpel ?>" target="_blank" class="btn btn-warning mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg> Print
                    </a>
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
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['kode_siswa']; ?></td>
                                    <td><?php echo $row['nama_siswa']; ?></td>
                                    <?php if ($row['kehadiran'] == 1) { ?>
                                        <td>Hadir</td>
                                    <?php } else { ?>
                                        <td>Tidak Hadir</td>
                                    <?php }
                                    ?>
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
<?php include "footer.php"; ?>
</div>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>