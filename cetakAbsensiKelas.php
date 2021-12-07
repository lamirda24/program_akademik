<!DOCTYPE html>
<html>

</html>
<?php
include 'koneksi.php';
session_start();

$kode_kelas = $_GET['kelas'];
$kode_matpel = $_GET['matpel'];
$absensi = mysqli_query($koneksi, "SELECT absensi.*, siswa.nama_siswa FROM absensi JOIN siswa ON absensi.siswa = siswa.kode_siswa where absensi.kode_kelas='$kode_kelas' AND matpel='$kode_matpel'");

$query = mysqli_query($koneksi, "SELECT * from kelas where kode_kelas='" . $kode_kelas . "'");
$res = mysqli_fetch_array($query);


$queryMatpel = mysqli_query($koneksi, "SELECT * from matapelajaran where kode_matpel='" . $kode_matpel . "'");
$result = mysqli_fetch_array($queryMatpel);

$detail = mysqli_query($koneksi, "SELECT * from jadwal where kode_matpel='" . $kode_matpel . "' and kode_matpel='" . $kode_matpel . "' ");
$results = mysqli_fetch_array($detail);



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
                        <h5>Absensi Kelas <?= $res[1] . " " . $res[2] . " " . $res[3] ?></h5>
                        <h5> Mata Pelajaran : <?= $result["nama_matpel"] ?></h5>
                        <h5> Hari: <?= $results["hari"] ?> / Jam: <?= $results["jammulai"] . " - " . $results["jamselesai"] ?> </h5>

                    </div>

                </div>
                <div class="row">

                    <table style="width: 100%" class="table table-bordered">
                        <tr>
                            <th width="1%">No</th>
                            <th>Kode Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Kehadiran</th>

                        </tr>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_array($absensi)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['siswa']; ?></td>
                                <td><?php echo $row['nama_siswa'] ?></td>
                                <td><?php echo ($row['kehadiran'] == 1 ? "Hadir" : "Tidak Hadir"); ?></td>
                                <!-- akhir icon edit delete -->
                            </tr>
                        <?php
                        }
                        ?>
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