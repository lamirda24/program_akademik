<!DOCTYPE html>

<?php
include "includes/config.php";

$kodeKelas = $_GET['kelas'];
$kodeMapel = $_GET['mapel'];
$jurusan = mysqli_query($connection, "select * from jurusan");
$res = mysqli_query($connection, "select * from kelas where kode_kelas = '$kodeKelas'");
$kelas = mysqli_fetch_row($res);
$mapel = mysqli_query($connection, "select * from matapelajaran where kode_matpel= '$kodeMapel'");
$resMapel = mysqli_fetch_row($mapel);
$resSiswa = mysqli_query($connection, "select * from kelasdetail join siswa on kelasdetail.kode_siswa = siswa.kode_siswa where kode_kelas = '$kodeKelas'");


if (isset($_POST['simpan'])) {
    $namaSiswa = $_POST['siswa'];
    $nilaiTugas = $_POST['tugas'];


    mysqli_query($connection, "INSERT INTO `nilai` VALUES ('','$kodeKelas', '$namaSiswa', '$kodeMapel', '$resMapel[2]', '$nilaiTugas', '$nilaiUts', '$nilaiUas')");


    header("location:nilaiMapelKelas.php?kelas=$kodeKelas&mapel=$kodeMapel");
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa</title>
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
            <div>
                <div class="col-sm-1"></div>

                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Nilai <?php echo $resMapel[2] ?></h1>
                        </div>
                    </div>

                    <div>
                        <form method="POST">
                            <div class="form-group row mb-2">
                                <label for="search" class="col-sm-3">Nama Siswa</label>
                                <div class="col-sm-6">
                                    <select name="siswa" class="form-control" id="siswa">
                                        <option>Siswa</option>
                                        <?php while ($siswa = mysqli_fetch_assoc($resSiswa)) { ?>
                                            <option value="<?php echo $siswa["kode_siswa"]; ?>">
                                                <?php echo $siswa["nama_siswa"]; ?>
                                            </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="search" class="col-sm-3">Nilai Tugas</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tugas" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-3">
                                    <input type="submit" class="btn btn-primary right" value="Simpan" name="simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Nilai <?php echo $kelas[1] ?> <?php echo $kelas[2]; ?> - <?php echo $kelas[3] ?> </h1>
                        <h2 class="align-content-center"> Mata Pelajaran <?php echo $resMapel[2] ?> </h2>
                    </div>
                </div>
                <!--penutup jumbotron-->
                <div>
                    <form method="POST">
                        <div class="form-group row mb-2">
                            <label for="search" class="col-sm-3">Nama Siswa</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama Siswa">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>
                </div>

                <div>
                    <table class="table table success">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Rata Rata</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search = $_POST['search'];
                                $query = mysqli_query($connection, "select * from nilai join kelasdetail on nilai.kode_siswa = kelasdetail.kode_siswa join siswa on nilai.kode_siswa = siswa.kode_siswa where nama_siswa like '%" . $search . "%' and kodematpel = '$kodeMapel' AND kelasdetail.kode_kelas = '$kodeKelas'  order by nama_siswa asc ");
                            } else {
                                $query = mysqli_query($connection, "select * from nilai join kelasdetail on nilai.kode_siswa = kelasdetail.kode_siswa join siswa on nilai.kode_siswa = siswa.kode_siswa where kodematpel = '$kodeMapel' AND nilai.kode_kelas = '$kodeKelas' order by nama_siswa asc");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['kode_siswa']; ?></td>
                                    <td><?php echo $row['nama_siswa']; ?></td>
                                    <td><?php echo number_format((($row['nilai_akhir'])), 2, ","); ?></td>
                                    <td>
                                        <a href="nilaihapus.php?kelas=<?= $row['kode_kelas'] ?>&siswa=<?php echo $row['kode_siswa'] ?>&mapel=<?php echo $row['kodematpel']; ?>" class="btn btn-danger btn-sm" title="Delete">

                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <?php $nomor = $nomor + 1; ?>
                                <?php } ?>
                        </tbody>

                    </table>
                </div>

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