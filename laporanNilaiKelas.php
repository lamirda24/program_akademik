<!DOCTYPE html>

<?php
include "includes/config.php";
$kode_kelas = $_GET['kelas'];
$q = mysqli_query($connection, "SELECT * FROM kelas where kode_kelas='$kode_kelas'");
$resq = mysqli_fetch_row($q);


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai</title>
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

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Murid <?= $resq[1] . " " . $resq[2] . " " . $resq[3] ?> </h1>
                </div>
            </div>
            <!--penutup jumbotron-->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-2 offset-md-2">Nama Siswa</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                        echo $_POST['search'];
                                                                                                    } ?>" placeholder="Cari Nama siswa">
                    </div>
                    <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                </div>
            </form>
            <div class="col-md-12">


                <table class="table table success">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: auto;">No</th>
                            <th>Kode</th>
                            <th>Nama</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (isset($_POST["kirim"])) {
                            $search = $_POST['search'];
                            $query = mysqli_query($connection, "select * from kelasdetail where nama_siswa like '%" . $search . "%' and kode_kelas ='$kode_kelas'");
                        } else {
                            $query = mysqli_query($connection, "select * from kelasdetail where kode_kelas ='$kode_kelas'");
                        }
                        $nomor = 1;
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $row['kode_siswa']; ?></td>
                                <td><?php echo $row['nama_siswa']; ?></td>

                                <!-- untuk icon edit dan delete -->
                                <td>
                                    <a href="nilaiKelasSiswa.php?kelas=<?php echo $row["kode_kelas"] ?>&siswa=<?= $row["kode_siswa"] ?>" class=" btn btn-success btn-sm" title="Edit">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                    </a>
                                    <a href="printNilaiKelas.php?kelas=<?php echo $row["kode_kelas"] ?>&siswa=<?= $row["kode_siswa"] ?>" class=" ml-2 btn btn-warning btn-sm" title="Edit">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                        </svg>
                                    </a>
                                </td>


                                <!-- akhir icon edit delete -->
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
</div>
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>