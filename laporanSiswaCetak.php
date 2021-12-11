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
                        <h5>Report: Daftar Siswa</h5>
                    </div>

                </div>
                <div class="row">
                    <table style="width: 100%" class="table table-bordered">
                        <tr>
                            <th width="1%">No</th>
                            <th>Kode Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Kode Kelas</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>

                        </tr>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa  join kelas on kelasdetail.kode_kelas = kelas.kode_kelas order by siswa.nama_siswa asc");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>

                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $data['kode_siswa']; ?>
                                </td>
                                <td>
                                    <?= $data['nama_siswa']; ?>
                                </td>
                                <td>
                                    <?= $data['nama_kelas'] . " " . $data['jurusan'] . " " . $data['nomor_kelas']; ?>
                                </td>
                                <td>
                                    <?= $data['notelp_siswa']; ?>
                                </td>
                                <td>
                                    <?= $data['alamat_siswa']; ?>
                                </td>
                            </tr>
                        <?php }

                        ?>
                        <tr>

                        </tr>
                        <?php
                        // }
                        ?>
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