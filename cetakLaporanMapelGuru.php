<!DOCTYPE html>
<html>

</html>
<?php
include 'koneksi.php';
session_start();


$kodeMapel = $_GET['mapel'];
$query = mysqli_query($koneksi, "SELECT * FROM jadwal where kode_matpel ='$kodeMapel'");
$numrows = mysqli_num_rows($query);
$namamapel  = mysqli_query($koneksi, "SELECT * FROM jadwal where kode_matpel='$kodeMapel' ");
$res = mysqli_fetch_assoc($namamapel);


?>

<head>
    <title>Print Laporan Matapelajaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <img src="./img/budiAgung.jpg" style="height: 150px;">
                    </div>
                    <div class="col-md-10">
                        <center>
                            <div class="row mt-3">
                                <center>

                                    <h4>YAYASAN HAKKA INDONESIA </h4>
                                    <h4> PERGURUAN BUDI AGUNG DKI JAKARTA SMA BUDI AGUNG</h4>
                                    <h6>Jl. Terusan Bandengan Utara No. 95 Blok F2-12, G5,D25-28, Jakarta 14450 -Indonesia</h6>
                                    <h6>Telp: (021) 6696420, 6623678 Fax: 6623687 email: sekolah.budiagung@yahoo.co.id</h6>
                                </center>
                            </div>

                        </center>
                    </div>


                </div>
                <hr>

                <div class="row">
                    <div class="col-md-5 mt-3 mb-3">
                        <h5>Matapelajaran <?= $res['matpel'] ?></h5>


                    </div>

                </div>
                <div class="row">

                    <table style="width: 100%" class="table table-bordered">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th>Guru</th>
                                <th>Hari</th>
                            </tr>
                        </thead>
                        <tbody>

                        <tbody>
                            <?php

                            if ($numrows > 0) {


                                $nomor = 1;
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $row['nama_kelas']; ?></td>
                                        <td><?php echo $row['tahun']; ?></td>
                                        <td><?php echo $row['guru']; ?></td>
                                        <td><?php echo $row['hari']; ?></td>


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

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <i>

                            <?= $_SESSION['role'] ?>:
                            <?=
                            $_SESSION['namauser'] ?>
                        </i>
                    </div>
                    <div class="col-sm-4 offset-md-6">

                        <i>
                            date:
                            <?= date('d F Y'); ?>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>

</body>

</html>