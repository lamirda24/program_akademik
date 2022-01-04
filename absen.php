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

$query = mysqli_query($connection, "select *,absensi.id as kode_absen from absensi join siswa on absensi.siswa  = siswa.kode_siswa where kode_kelas='$kodeKelas' and matpel='$kodeMatpel' and tgl_absen='$tgl'");
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
                            <h1 class="display-4">Daftar Kehadiran Siswa </h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <table class="table table success">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Kehadiran</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nomor = 1;
                            while ($row = mysqli_fetch_assoc($query)) { ?>
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
                                    <td>
                                        <a href="absensiDelete.php?id=<?php echo $row['kode_absen'] ?>&kelas=<?= $kodeKelas ?>&mapel=<?= $kodeMatpel ?>&date=<?= $tgl ?>" class="btn btn-info btn-sm" title="Delete">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                                <path d="M7.5 1v7h1V1h-1z" />
                                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <!-- akhir icon edit delete -->
                                </tr>
                                <?php $nomor = $nomor + 1; ?>
                            <?php
                            } ?>
                        </tbody>

                    </table>

                </div>

                <script type="text/javascript" src="js/bootstrap.min.js"></script>
        </body>
        <!--penutup container fluid-->
    </div>
</div>
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>