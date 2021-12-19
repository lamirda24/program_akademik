<!DOCTYPE html>

<?php
include "includes/config.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
    header("location:login.php");

$sess = $_SESSION['kodeuser'];

?>
<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <body>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Data Calon Penerima Beasiswa</h1>
                </div>
            </div>
            <!--penutup jumbotron-->
            <div class="row mb-3">

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">

                </div>


                <div class="col-md-2">
                    <a href="hitungSpk.php" class="btn btn-success ml-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg> Seleksi
                    </a>
                </div>


            </div>
            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Siswa</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Alamat Siswa</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($_SESSION['role'] != "siswa") {
                        $query = mysqli_query($connection, "select * from spk join siswa on spk.kode_siswa = siswa.kode_siswa join kelasdetail on kelasdetail.kode_siswa = siswa.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas ");
                    } else {
                        $query = mysqli_query($connection, "select * from spk join siswa on spk.kode_siswa = siswa.kode_siswa join kelasdetail on kelasdetail.kode_siswa = siswa.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas where spk.kode_siswa='$sess'");
                    }

                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $row['kode_siswa']; ?></td>
                            <td><?php echo $row['nama_siswa']; ?></td>
                            <td><?php echo $row['nama_kelas'] . " " . $row['jurusan'] . " " . $row['nomor_kelas'] ?></td>
                            <td><?php echo $row['alamat_siswa']; ?></td>
                            <td><?php echo $row['notelp_siswa']; ?></td>
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
</div>
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>