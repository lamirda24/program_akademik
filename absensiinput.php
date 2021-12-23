<!DOCTYPE html>

<?php
include "includes/config.php";
$kodeKelas = $_GET['kelas'];
$kodeMatpel = $_GET['mapel'];

if (isset($_POST['simpan'])) {
    $kelas = $_GET['kelas'];
    $kode_siswa = $_REQUEST['siswa'];
    $kehadiran = $_POST['kehadiran'];

    // mysqli_query($connection, "insert into absensi values('','$kelas','$siswa','$kodeMatpel','$kehadiran')");
    header("location:absensiinput.php?kelas=$kodeKelas&mapel=$kodeMatpel");
}

$siswa = mysqli_query($connection, "select * from kelasdetail  join siswa on kelasdetail.kode_siswa = siswa.kode_siswa where kode_kelas='$kodeKelas'");
$datasiswa = [];
while ($row = mysqli_fetch_assoc($siswa)) {
    $data = $row;
    array_push($datasiswa, $data);
}



$kelas = mysqli_query($connection, "select * from kelas where kode_kelas='$kodeKelas'");
$absensi = mysqli_query($connection, "select * from absensi where kelas='" . $_GET['kelas'] . "'");
$mapel = mysqli_query($connection, "select nama_matpel from matapelajaran where kode_matpel='$kodeMatpel'");
$namaMapel = mysqli_fetch_row($mapel);
$namaKelas = mysqli_fetch_row($kelas);
// print_r($namaKelas);
// die;


// $albertedit = mysqli_query($connection, "SELECT * FROM jadwal");
// $rowedit = mysqli_fetch_array($albertedit);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran</title>
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

            <div class="row">
                <div class="col-sm-1">
                </div>

                <div class="col-sm-10">

                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Kehadiran <?= $namaKelas[1] . " " . $namaKelas[2] . " " . $namaKelas[3]; ?> - <?= $namaMapel[0]; ?> </h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">

                        <div class="form-group row">


                            <div class="col-lg-5">
                                <input type="date" class="form-control" name="tanggal">

                            </div>
                        </div>
                        <div class="form-group row">


                            <table class="table table success">
                                <thead class="thead-light">
                                    <?php $i = 1; ?>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th style="width: 150px;">Kode Siswa</th>
                                        <th>Nama Siswa</th>
                                        <th>Kehadiran</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasiswa as $row) { ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>
                                            <td>
                                                <input type="text" name="siswa[]" value="<?= $row['kode_siswa'] ?>" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="text" name="nama[]" value="<?= $row['nama_siswa'] ?>" class="form-control" />
                                            </td>
                                            <td>
                                                <select name="kehadiran[]" class="form-control" id="kehadiran">
                                                    <option value="0">Tidak Hadir</option>
                                                    <option value="1">Hadir</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>


                                </tbody>

                            </table>
                            <div class="col-lg-11 offset-10">
                                <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                <input type="button" class="btn btn-secondary" value="Batal" name="batal">
                            </div>

                        </div>
                        <!--disini-->


                    </form>
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
                                <th colspan="3" style="text-align: center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $query = mysqli_query($connection, "select * from absensi join siswa on siswa.kode_siswa = absensi.siswa where kode_kelas = '$kodeKelas' and matpel = '$kodeMatpel'");
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