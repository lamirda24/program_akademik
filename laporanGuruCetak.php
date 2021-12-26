<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
    <title>Print Daftar Kelas</title>
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
                <br>

                <?php
                include 'koneksi.php';
                ?>
                <div class="row">
                    <div class="col-md-5">
                        <h5>Report: Daftar Guru</h5>
                    </div>

                </div>
                <div class="row">
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Mengajar Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                        </thead>

                        <tbody>
                            <?php

                            $query = mysqli_query($koneksi, "SELECT * from guru join jadwal on guru.kode_guru = jadwal.kode_guru group by guru.kode_guru order by guru.nama_guru asc");

                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['kode_guru']; ?></td>
                                    <td><?php echo $row['nama_guru']; ?></td>
                                    <td><?php echo $row['nama_kelas']; ?></td>
                                    <td><?php echo $row['matpel']; ?></td>
                                    <td><?php echo $row['notelp_guru']; ?></td>
                                    <td><?php echo $row['alamat_guru']; ?></td>



                                    <!-- untuk icon edit dan delete -->

                                </tr>
                                <?php $nomor = $nomor + 1; ?>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>
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

    <script>
        window.print();
    </script>

</body>

</html>