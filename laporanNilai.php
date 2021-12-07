<!DOCTYPE html>

<?php
include "includes/config.php";
if (isset($_POST['simpan'])) {
    if (isset($_REQUEST['inputkode'])) {
        $kode_kelas = $_REQUEST['inputkode'];
    }
    if (!empty($kode_kelas)) {
        $kode_kelas = $_REQUEST['inputkode'];
    } else {
?> <h1>Anda Harus Mengisi Data</h1>
<?php
        die("anda harus memasukkan datanya");
    }

    $nama_kelas = $_POST['inputnama'];
    $jurusan = $_POST['jurusan'];
    $nomor_kelas = $_POST['inputnomor'];

    mysqli_query($connection, "insert into kelas values('$kode_kelas','$nama_kelas','$jurusan','$nomor_kelas')");
    header("location:kelasinput.php");
}
$jurusan = mysqli_query($connection, "select * from jurusan");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Daftar Kelas</title>
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
                    <h1 class="display-4">Daftar Kelas</h1>
                </div>
            </div>
            <!--penutup jumbotron-->

            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class="col-sm-3">Nama Kelas</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                        echo $_POST['search'];
                                                                                                    } ?>" placeholder="Cari Kode Kelas">
                    </div>
                    <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                </div>
            </form>

            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($_POST["kirim"])) {
                        $search = $_POST['search'];
                        $query = mysqli_query($connection, "select * from kelas where kode_kelas like '%" . $search . "%'");
                    } else {
                        $query = mysqli_query($connection, "select * from kelas");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['kode_kelas']; ?></td>
                            <td><?php echo $row['nama_kelas'] . " " . $row['jurusan'] . " " . $row['nomor_kelas']; ?></td>

                            <td>
                                <a href="laporanNilaiKelas.php?kelas=<?php echo $row["kode_kelas"] ?>" class="btn btn-primary btn-sm" title="Edit">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
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