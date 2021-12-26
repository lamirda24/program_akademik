<!DOCTYPE html>
<html>

</html>
<?php
include 'koneksi.php';
session_start();
$kode_kelas = $_GET['kelas'];
$query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_kelas='$kode_kelas'");
$resQ = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
$res = mysqli_fetch_assoc($resQ);
$rowcount = mysqli_num_rows($query);



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
                        <h5>Jadwal Kelas <?= $res["nama_kelas"] . " " . $res['jurusan'] . " " . $res['nomor_kelas'] ?></h5>


                    </div>

                </div>
                <div class="row">

                    <table style="width: 100%" class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Matapelajaran</th>
                            <th>Semester</th>
                            <th>Tahun</th>
                            <th>Guru</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                        <?php
                        $no = 1;

                        if ($rowcount > 0) {


                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['matpel']; ?></td>
                                    <td><?php echo $row['semester']; ?></td>
                                    <td><?php echo $row['tahun']; ?></td>
                                    <td><?php echo $row['guru']; ?></td>
                                    <td><?php echo $row['hari']; ?></td>
                                    <td><?php echo $row['jammulai']; ?></td>
                                    <td><?php echo $row['jamselesai']; ?></td>


                                    <!-- akhir icon edit delete -->
                                </tr>

                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8">no data</td>
                                <!-- akhir icon edit delete -->
                            </tr>
                        <?php } ?>
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