<!DOCTYPE html>

<?php
session_start();

include "includes/config.php";
if ($_SESSION['role'] == "guru" || $_SESSION['role'] == "admin") {

    $kodeuser = $_SESSION['kodeuser'];
    $kode_kelas = $_GET['kelas'];
    $kode_mapel = $_GET['mapel'];
    $query = mysqli_query($connection, "select * from absensi join kelas on absensi.kode_kelas = kelas.kode_kelas where absensi.kode_kelas='$kode_kelas' and matpel='$kode_mapel' group by tgl_absen");
    $queryK = mysqli_query($connection, "Select * from kelas where kode_kelas ='$kode_kelas'");
    $queryM = mysqli_query($connection, "Select * from matapelajaran where kode_matpel ='$kode_mapel'");
    $resM = mysqli_fetch_assoc($queryM);
    $res = mysqli_fetch_assoc($queryK);
} else {
    header("location:index.php");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Jadwal</title>
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

            <div class="row">
                <div class="col-sm-1">
                </div>

            </div>
            <!--penutup class row-->

            <div class="col-sm-1"></div>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Absensi kelas <?= $res['nama_kelas'] ?>
                        <?= $res['jurusan'] ?>
                        <?= $res['nomor_kelas'] ?></h1>
                    <h2>Matapelajaran : <?= $resM['nama_matpel'] ?></h2>
                </div>
            </div>
            <!--penutup jumbotron-->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Kelas</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                        echo $_POST['search'];
                                                                                                    } ?>" placeholder="Cari Kelas">
                    </div>
                    <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                </div>
            </form>

            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td>
                                <?= $nomor++ ?>
                            </td>
                            <td>
                                <?= date('d F Y', strtotime($row['tgl_absen'])); ?>

                            </td>
                            <!-- untuk icon edit dan delete -->
                            <td>
                                <a href="absenListLaporan.php?kelas=<?php echo $row["kode_kelas"] ?>&mapel=<?= $row['matpel'] ?>&date=<?= $row['tgl_absen'] ?>" class="btn btn-info btn-sm" title="List Absensi">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </a>
                                <!-- <a href="cetakAbsensiKelas.php?kelas=<?= $kode_kelas ?>&matpel=<?= $row['kode_matpel'] ?>" target="_blank" class="btn btn-warning btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                    </svg>
                                </a> -->
                            </td>

                        </tr>


                        <?php $nomor = $nomor + 1; ?>
                    <?php } ?>
                </tbody>

            </table>

    </div>
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