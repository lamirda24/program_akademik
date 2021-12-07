<!DOCTYPE html>
<html>

</html>
<?php
include 'koneksi.php';
session_start();
$kode_kelas = $_GET['kelas'];
$kode_siswa = $_GET['siswa'];
$q = mysqli_query($koneksi, "SELECT * FROM nilai where kelas='$kode_kelas' and siswa='$kode_siswa'");
$resq = mysqli_fetch_array($q);
$q1 = mysqli_query($koneksi, "SELECT nama_siswa from siswa where kode_siswa='$kode_siswa'");
$nama_siswa = mysqli_fetch_row($q1);
$q2 = mysqli_query($koneksi, "SELECT * FROM kelas where kode_kelas='$kode_kelas'");
$resq2 = mysqli_fetch_row($q2);


?>

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

                <div class="row">
                    <div class="col-md-5 mt-3 mb-3">
                        <h5><?= $nama_siswa[0] ?></h5>
                        <h5> Kelas : <?= $resq2[1] . " " . $resq2[2] . " " . $resq2[3] ?></h5>

                    </div>

                </div>
                <div class="row">

                    <table style="width: 100%" class="table table-bordered">
                        <tr>
                            <th width="1%">No</th>

                            <th>Kode</th>
                            <th>Matpel</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Rata Rata</th>

                        </tr>


                        <?php
                        $nomor = 1;
                        while ($row = mysqli_fetch_array($q)) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $row['kodematpel']; ?></td>
                                <td><?php echo $row['matpel']; ?></td>
                                <td><?php echo $row['tugas']; ?></td>
                                <td><?php echo $row['uts']; ?></td>
                                <td><?php echo $row['uas']; ?></td>
                                <td><?php echo number_format((($row['uas'] + $row['uts'] + $row['tugas']) / 3), 2, ","); ?></td>
                            </tr>
                        <?php $nomor = $nomor + 1;
                        } ?>
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