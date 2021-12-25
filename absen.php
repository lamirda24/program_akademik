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
                                    <td>
                                        <a href="absensiDelete.php?siswa=<?php echo $row['id'] ?>&kelas=<?= $kodeKelas ?>&mapel=<?= $kodeMatpel ?>" class="btn btn-danger btn-sm" title="Delete">

                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </td>
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
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>