<!DOCTYPE html>
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
                            <th>Kode Kelas</th>
                            <th>Kode Siswa</th>
                            <th>Nama Siswa</th>
                        </tr>
                        <!-- <?php
                                // $no = 1;
                                // $sql = mysqli_query($koneksi, "SELECT *, b.nama_siswa as nama_siswas FROM kelasdetail a join siswa b on a.kode_siswa = b.kode_siswa where kode_kelas = '" . $_GET['ubah'] . "'");
                                // while ($data = mysqli_fetch_array($sql)) {
                                // 
                                ?>
                        <tr>
                            <!-- <td><?php echo $no++; ?></td>
                        <td><?php echo $data['kode_kelas']; ?></td>
                        <td><?php echo $data['kode_siswa']; ?></td>
                        <td><?php echo $data['nama_siswas']; ?></td> -->
                        </tr>
                        <?php
                        // } -->
                        ?>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>

</body>

</html>