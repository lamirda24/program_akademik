<!DOCTYPE html>

<?php
include "includes/config.php";
$kodeKelas = $_GET['kelas'];
$kodeMatpel = $_GET['mapel'];

if (isset($_POST['simpan'])) {
    $kelas = $_GET['kelas'];
    $kode_siswa = $_REQUEST['siswa'];
    $kehadiran = $_POST['kehadiran'];
    $tanggal = date('Y-m-d');
    $jmlh = count($kode_siswa);
    for ($i = 0; $i < $jmlh; $i++) {
        $result = mysqli_query($connection, "select * from absensi where siswa='$kode_siswa[$i]' and tgl_absen ='$tanggal'");

        $row_cnt = mysqli_num_rows($result);
        echo $row_cnt;;
        if ($row_cnt > 0) {
            // echo "UPDATE  absensi SET kehadiran='$kehadiran' where siswa=$kode_siswa[$i]";
            mysqli_query($connection, "UPDATE  absensi SET kehadiran='$kehadiran' where siswa=$kode_siswa[$i]");
        } else {
            // echo "insert into absensi values('','$kelas','$kode_siswa[$i]','$kodeMatpel','$kehadiran[$i]',$tanggal)";
            mysqli_query($connection, "insert into absensi values('','$kelas','$kode_siswa[$i]','$kodeMatpel','$kehadiran[$i]',$tanggal)");
        }
    }

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
                            <div class="col-md-1">
                                Tanggal:
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>" disabled>

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

                            </div>

                        </div>
                        <!--disini-->


                    </form>
                </div>

            </div>
            <!--penutup class row-->

            <!--  -->

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