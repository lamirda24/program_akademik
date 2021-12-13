<!DOCTYPE html>

<?php
include "includes/config.php";
if (isset($_POST['simpan'])) {
    if (isset($_REQUEST['inputmin'])) {
        $min = $_REQUEST['inputmin'];
    }
    if (!empty($min)) {
        $min = $_REQUEST['inputmin'];
    } else {
?> <h1>Anda Harus Mengisi Data</h1> <?php
                                    die("anda harus memasukkan datanya");
                                }
                                $nama_kriteria = $_POST['inputkriteria'];
                                $max = $_POST['inputmax'];
                                $bobot_kriteria = $_POST['inputbobot'];

                                mysqli_query($connection, "insert into parameter values('$nama_kriteria','$min','$max','$bobot_kriteria')");
                                header("location:parameterinput.php");
                            }
                            $kriteria = mysqli_query($connection, "select * from kriteria");
                            $bobotnilai = mysqli_query($connection, "select * from bobotnilai");
                                    ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Parameter</title>
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

                <div class="col-sm-10"></div>


                <!--penutup jumbotron-->
            </div>

    </div>
    <!--penutup class row-->

    <div class="col-sm-1">
    </div>


    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Daftar Parameter</h1>
        </div>
    </div>
    <!--penutup jumbotron-->
    <div class="mb-3">

        <div class="form-group row mb-2">
            <label for="search" class="col-sm-3">Nama Kriteria: Pendapatan Orang Tua</label>
            <div class="col-sm-6">
            </div>
        </div>


        <table class="table table success">
            <thead class="thead-dark">
                <tr>
                    <th style="width:150px">No</th>

                    <th style="width: 640px;">Kriteria</th>
                    <th style="width:330px;">Min</th>
                    <th style="width:510px">Max</th>
                    <th>Bobot</th>
                </tr>
            </thead>

            <tbody>
                <?php

                $query = mysqli_query($connection, "select * from parameter join kriteria ON kriteria.kode_kriteria = parameter.kode_kriteria where parameter.kode_kriteria = 'KK001'");

                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td><?php echo $row['min']; ?></td>
                        <td><?php echo $row['max']; ?></td>
                        <td><?php echo $row['bobot']; ?></td>
                        <!-- untuk icon edit dan delete -->

                        <!-- akhir icon edit delete -->
                    </tr>
                    <?php $nomor = $nomor + 1; ?>
                <?php } ?>
            </tbody>

        </table>
    </div>


    <div class="mb-3">
        <div class="form-group row mb-2">
            <label for="search" class="col-sm-3">Nama Kriteria: Jumlah Tanggungan Orang Tua</label>
            <div class="col-sm-6">
            </div>
        </div>


        <table class="table table success">
            <thead class="thead-dark">
                <tr>
                    <th style="width:150px">No</th>
                    <th style=" width:640px;">Kriteria</th>
                    <th style="width:330px;">Min</th>
                    <th style="width:510px">Max</th>
                    <th>Bobot</th>

                </tr>
            </thead>

            <tbody>
                <?php

                $query = mysqli_query($connection, "select * from parameter join kriteria ON kriteria.kode_kriteria = parameter.kode_kriteria where parameter.kode_kriteria = 'KK002'");
                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td><?php echo $row['min']; ?></td>
                        <td><?php echo $row['max']; ?></td>
                        <td><?php echo $row['bobot']; ?></td>
                        <!-- untuk icon edit dan delete -->

                    </tr>
                    <?php $nomor = $nomor + 1; ?>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div class="mb-3">
        <div class="form-group row mb-2">
            <label for="search" class="col-sm-3">Nama Kriteria: Nilai Rata Rata</label>
            <div class="col-sm-6">
            </div>
        </div>


        <table class="table table success">
            <thead class="thead-dark">
                <tr>
                    <th style="width:150px">No</th>

                    <th style="width: 640px;">Kriteria</th>
                    <th style="width:330px;">Min</th>
                    <th style="width:510px">Max</th>
                    <th>Bobot</th>

                </tr>
            </thead>

            <tbody>
                <?php

                $query = mysqli_query($connection, "select * from parameter join kriteria ON kriteria.kode_kriteria = parameter.kode_kriteria where parameter.kode_kriteria = 'KK003'");

                $nomor = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td><?php echo $row['min']; ?></td>
                        <td><?php echo $row['max']; ?></td>
                        <td><?php echo $row['bobot']; ?></td>
                        <!-- untuk icon edit dan delete -->

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