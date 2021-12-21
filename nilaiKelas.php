<!DOCTYPE html>

<?php
session_start();
include "includes/config.php";
$kodeuser = $_SESSION['kodeuser'];
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
                                                                                                    } ?>" placeholder="Cari Nama Kelas">
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
                        <th>Jurusan</th>
                        <th>Nomor</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($_POST["kirim"])) {
                        if ($_SESSION['role'] == "guru") {
                            $search = $_POST['search'];
                            $query = mysqli_query($connection, "select * from jadwal  join kelas on jadwal.kode_kelas = kelas.kode_kelas where nama_kelas like '%" . $search . "%' and kode_guru='$kodeuser'");
                        } else {

                            $search = $_POST['search'];
                            $query = mysqli_query($connection, "select * from kelas where nama_kelas like '%" . $search . "%'");
                        }
                    } else {
                        if ($_SESSION['role'] == "guru") {
                            $query = mysqli_query($connection, "select * from jadwal  join kelas on jadwal.kode_kelas = kelas.kode_kelas where kode_guru='$kodeuser'");
                        } else {
                            $query = mysqli_query($connection, "select * from kelas");
                        }
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['kode_kelas']; ?></td>
                            <td><?php echo $row['nama_kelas']; ?></td>
                            <td><?php echo $row['jurusan']; ?></td>
                            <td><?php echo $row['nomor_kelas']; ?></td>
                            <!-- untuk icon edit dan delete -->
                            <td>
                                <a href="nilaiKelasDetail.php?kelas=<?php echo $row["kode_kelas"] ?>" class="btn btn-success btn-sm" title="Edit">

                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
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