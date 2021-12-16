<!DOCTYPE html>

<?php
include "includes/config.php";
$siswa = mysqli_query($connection, "select * from siswa");
if (isset($_POST['simpan'])) {
    if (isset($_REQUEST['kode_siswa'])) {
        $kode_siswa = $_REQUEST['kode_siswa'];
    } else {
?> <h1>Anda Harus Mengisi Data</h1>
<?php
        die("anda harus memasukkan datanya");
    }
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];

    $qCheck = mysqli_query($connection, "select * from spk where kode_siswa='$kode_siswa'");
    $rowcount = mysqli_num_rows($qCheck);
    if ($rowcount > 0) {
        mysqli_query($connection, "UPDATE  spk  SET c1='$c1',c2='$c2',c3='$c3' WHERE kode_siswa='$kode_siswa'");
    } else {
        mysqli_query($connection, "INSERT INTO spk  VALUES('','$kode_siswa','$c1','$c2','$c3','')");
    }
    header("location:spkInput.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input SPK</title>
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
                            <h1 class="display-4">Input Data Penerima </h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">
                        <div class="form-group row">
                            <label for="kode_siswa" class="col-sm-2 col-form-label">Kode Siswa </label>
                            <div class="col-sm-10">
                                <select name="kode_siswa" class="form-control" id="kode_siswa">
                                    <option>Siswa</option>
                                    <?php while ($row = mysqli_fetch_array($siswa)) { ?>
                                        <option value="<?php echo $row["kode_siswa"] ?>">
                                            <?php echo $row["nama_siswa"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_siswa" class="col-sm-2 col-form-label">Pendapatan Orangtua</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="c1" id="c1" placeholder="Pendatapan Orangtua ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notelp_siswa" class="col-sm-2 col-form-label">Tanggungan Orangtua </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="c2" id="c2" placeholder="Orangtua ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat_siswa" class="col-sm-2 col-form-label">Nilai Rata Rata </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="c3" id="c3" placeholder="Nilai Rata Rata">
                            </div>
                        </div>

                        <div class="col-sm-10">

                            <div class="form-group row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                    <input type="button" class="btn btn-secondary" value="Batal" name="batal">
                                </div>
                            </div>
                            <div class="col-sm-10">

                    </form>
                </div>



            </div>
            <!--penutup class row-->

            <div class="col-sm-1">
            </div>


            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Data Siswa</h1>
                </div>
            </div>
            <!--penutup jumbotron-->


            <div class="form-group row mb-2 ml-2">
                <a class="col-sm-1 btn btn-success" value="Hasil" href="hitungSpk.php">Hasil</a>
            </div>


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Pendapatan Orangtua</th>
                        <th>Tanggungan Orangtua</th>
                        <th>Nilai Rata Rata</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $query = mysqli_query($connection, "select * from spk join siswa on spk.kode_siswa = siswa.kode_siswa");

                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $row['kode_siswa']; ?></td>
                            <td><?php echo $row['nama_siswa']; ?></td>
                            <td><?php echo $row['c1']; ?></td>
                            <td><?php echo $row['c2']; ?></td>
                            <td><?php echo $row['c3']; ?></td>

                            <!-- untuk icon edit dan delete -->
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
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>