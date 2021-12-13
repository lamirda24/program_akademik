<!DOCTYPE html>

<?php
include "includes/config.php";
if (isset($_POST['simpan'])) {
    if (isset($_REQUEST['inputkode'])) {
        $kode_kriteria = $_REQUEST['inputkode'];
    }
    if (!empty($kode_kriteria)) {
        $kode_kriteria = $_REQUEST['inputkode'];
    } else {
?> <h1>Anda Harus Mengisi Data</h1> <?php
                                    die("anda harus memasukkan datanya");
                                }
                                $nama_kriteria = $_POST['inputnama'];
                                $bobot_kriteria = $_POST['inputbobot'];
                                $atribut_kriteria = $_POST['inputatribut'];

                                mysqli_query($connection, "update kriteria set nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria', atribut_kriteria='$atribut_kriteria'
        WHERE kode_kriteria = '$kode_kriteria'");
                                header("location:kriteriainput.php");
                            }
                            $atribut = mysqli_query($connection, "select * from atribut");

                            //untuk menampilkan data pada form edit
                            $kode_kriteria = $_GET["ubah"];
                            $albertedit = mysqli_query($connection, "SELECT * FROM kriteria
    WHERE kode_kriteria = '$kode_kriteria'");
                            $rowedit = mysqli_fetch_array($albertedit);
                                    ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Kriteria</title>
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

            <div class="row">
                <div class="col-sm-1">
                </div>

                <div class="col-sm-10">

                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Edit Kriteria</h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">
                        <div class="form-group row">
                            <label for="kode_kriteria" class="col-sm-2 col-form-label">Kode Kriteria </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputkode" id="kode_kriteria" readonly value="<?php echo $rowedit["kode_kriteria"] ?>" maxlength="6" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputnama" id="nama_kriteria" value="<?php echo $rowedit["nama_kriteria"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bobot_kriteria" class="col-sm-2 col-form-label">Bobot Kriteria </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputbobot" id="bobot_kriteria" value="<?php echo $rowedit["bobot_kriteria"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="atribut_kriteria" class="col-sm-2 col-form-label">Atribut Kriteria</label>
                            <div class="col-sm-10">
                                <select name="inputatribut" class="form-control" id="atribut_kriteria">
                                    <option>Atribut</option>
                                    <?php while ($row = mysqli_fetch_array($atribut)) { ?>
                                        <option value="<?php echo $row["nama_atribut"] ?>">
                                            <?php echo $row["nama_atribut"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-9 mt-3 ml-2">
                                <div class="form-group row">
                                    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                    <input type="button" class="btn btn-secondary" value="Batal" name="batal">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

    </div>
    <!--penutup class row-->

    <div class="col-sm-1">
    </div>


    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Daftar Kriteria</h1>
        </div>
    </div>
    <!--penutup jumbotron-->

    <form method="POST">
        <div class="form-group row mb-2">
            <label for="search" class="col-sm-3">Nama Kriteria</label>
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                echo $_POST['search'];
                                                                                            } ?>" placeholder="Cari Kriteria">
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
                <th>Atribut</th>
                <th>Bobot</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($_POST["kirim"])) {
                $search = $_POST['search'];
                $query = mysqli_query($connection, "select * from kriteria
        where nama_kriteria like '%" . $search . "%'");
            } else {
                $query = mysqli_query($connection, "select * from kriteria");
            }
            $nomor = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['kode_kriteria']; ?></td>
                    <td><?php echo $row['nama_kriteria']; ?></td>
                    <td><?php echo $row['atribut_kriteria']; ?></td>
                    <td><?php echo $row['bobot_kriteria']; ?></td>
                    <!-- untuk icon edit dan delete -->
                    <td>
                        <a href="kriteriaedit.php?ubah=<?php echo $row["kode_kriteria"] ?>" class="btn btn-success btn-sm" title="Edit">

                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </a>
                    </td>

                    <td>
                        <a href="kriteriahapus.php?hapus=<?php echo $row["kode_kriteria"] ?>" class="btn btn-danger btn-sm" title="Delete">

                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
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
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>