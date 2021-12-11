<!DOCTYPE html>

<?php
include "includes/config.php";
$kode_kelas = $_GET['ubah'];
$id = $_GET['id'];
$kode_matpel = $_GET['matpel'];
$jadwal = mysqli_query($connection, "Select * from jadwal where id='$id'");
$resJadwal = mysqli_fetch_row($jadwal);


if (isset($_POST['simpan'])) {
    $matpel = $_POST['inputmatpel'];
    $semester = $_POST['inputsemester'];
    $tahun = $_POST['inputtahun'];
    $guru = $_POST['inputguru'];
    $kelas = $_POST['inputkelas'];
    $hari = $_POST['inputhari'];
    $jammulai = $_POST['inputjammulai'];
    $jamselesai = $_POST['inputjamselesai'];
    $nama_kelas = mysqli_query($connection, "select * from kelas where kode_kelas='$kode_kelas'");
    $resKelas = mysqli_fetch_row($nama_kelas);
    $resKelas = $resKelas[1] . " " . $resKelas[2] . " " . $resKelas[3];
    $resMapel = mysqli_query($connection, "select * from matapelajaran where kode_matpel='$kode_matpel'");
    $nama_matpel = mysqli_fetch_row($resMapel);
    $nama_matpel = $nama_matpel[2];
    $resGuru = mysqli_query($connection, "select * from guru where kode_guru='$guru'");
    $nama_guru = mysqli_fetch_row($resGuru);
    $nama_guru = $nama_guru[1];
    mysqli_query($connection, "update jadwal set kelas='$resKelas', kode_kelas='$kelas', semester='$semester', tahun='$tahun', matpel='$nama_matpel', kode_matpel='$matpel', kode_guru='$guru', guru='$nama_guru', hari='$hari', jammulai='$jammulai', jamselesai='$jamselesai' where id='$id'");
    // print_r($query);
    // print_r("update jadwal set kelas='$resKelas', kode_kelas='$kelas', semester='$semester', tahun='$tahun', matpel='$nama_matpel', kode_matpel='$matpel', kode_guru='$guru', guru='$nama_guru', hari='$hari', jammulai='$jammulai', jamselesai='$jamselesai' where id='$id'");
    // die;
    header("location:jadwalinput.php");
}
$matapelajaran = mysqli_query($connection, "select * from matapelajaran");
$guru = mysqli_query($connection, "select * from guru");
$kelas = mysqli_query($connection, "select * from kelas");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal</title>
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
                            <h1 class="display-4">Edit Jadwal</h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select name="inputkelas" class="form-control" id="kelas">

                                    <option>Kelas</option>
                                    <?php while ($row = mysqli_fetch_array($kelas)) { ?>
                                        <option value="<?php echo $row["kode_kelas"];  ?>" <?= $resJadwal[2] == $row["kode_kelas"] ? "selected" : "" ?>>
                                            <?php echo $row["nama_kelas"] ?>
                                            <?php echo $row["jurusan"] ?>
                                            <?php echo $row["nomor_kelas"] ?>

                                        </option>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="inputsemester" value="">
                                    <option value="Genap" <?= $resJadwal[3] == "Genap" ? "selected" : "" ?>>Genap</option>
                                    <option value="Ganjil" <?= $resJadwal[3] == "Ganjil" ? "selected" : "" ?>>Ganjil</option>
                                </select>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="inputtahun">
                                    <option value="2017" <?= $resJadwal[4] == "2017" ? "selected" : "" ?>>2017</option>
                                    <option value="2018" <?= $resJadwal[4] == "2018" ? "selected" : "" ?>>2018</option>
                                    <option value="2019" <?= $resJadwal[4] == "2019" ? "selected" : "" ?>>2019</option>
                                    <option value="2020" <?= $resJadwal[4] == "2020" ? "selected" : "" ?>>2020</option>
                                    <option value="2021" <?= $resJadwal[4] == "2021" ? "selected" : "" ?>>2021</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matpel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select name="inputmatpel" class="form-control" id="matpel">

                                    <option>Mata Pelajaran</option>
                                    <?php while ($row = mysqli_fetch_array($matapelajaran)) { ?>
                                        <option value="<?php echo $row["kode_matpel"] ?>" <?= $row['kode_matpel'] == $resJadwal[6] ? "selected" : "" ?>>
                                            <?php echo $row["nama_matpel"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="guru" class="col-sm-2 col-form-label">Guru</label>
                            <div class="col-sm-10">
                                <select name="inputguru" class="form-control" id="guru">

                                    <option>Guru</option>
                                    <?php while ($row = mysqli_fetch_array($guru)) { ?>
                                        <option value="<?php echo $row["kode_guru"] ?>" <?= $resJadwal[7] == $row['kode_guru'] ? "selected" : "" ?>>
                                            <?php echo $row["nama_guru"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="inputhari">
                                    <option value="Senin" <?= $resJadwal[9] == "Senin" ? "selected" : "" ?>>Senin</option>
                                    <option value="Selasa" <?= $resJadwal[9] == "Selasa" ? "selected" : "" ?>>Selasa</option>
                                    <option value="Rabu" <?= $resJadwal[9] == "Rabu" ? "selected" : "" ?>>Rabu</option>
                                    <option value="Kamis" <?= $resJadwal[9] == "Kamis" ? "selected" : "" ?>>Kamis</option>
                                    <option value="Jumat" <?= $resJadwal[9] == "Jumat" ? "selected" : "" ?>>Jumat</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jammulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="inputjammulai" id="jammulai" placeholder="Input Min" value="<?= $resJadwal[10] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jamselesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="inputjamselesai" id="jamselesai" placeholder="Input Max " value="<?= $resJadwal[11] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                <input type="button" class="btn btn-secondary" value="Batal" name="batal">
                            </div>
                        </div>
                </div>
                </form>
            </div>

    </div>
    <!--penutup class row-->

    <div class="col-sm-1">
    </div>


    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Daftar Jadwal</h1>
        </div>
    </div>
    <!--penutup jumbotron-->

    <form method="POST">
        <div class="form-group row mb-2">
            <label for="search" class="col-sm-3">Nama Kelas</label>
            <div class="col-sm-6">
                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                echo $_POST['search'];
                                                                                            } ?>" placeholder="Cari Kelas">
            </div>
            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
        </div>
    </form>

    <table class="table table success">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th colspan="3" style="text-align: center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($_POST["kirim"])) {
                $search = $_POST['search'];
                $query = mysqli_query($connection, "select * from jadwal
        where kelas like '%" . $search . "%'");
            } else {
                $query = mysqli_query($connection, "select * from jadwal");
            }
            $nomor = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><?php echo $row['matpel']; ?></td>
                    <td><?php echo $row['guru']; ?></td>
                    <td><?php echo $row['hari']; ?></td>
                    <td><?php echo $row['jammulai']; ?></td>
                    <td><?php echo $row['jamselesai']; ?></td>
                    <!-- untuk icon edit dan delete -->
                    <td>
                        <a href="absensiinput.php?kelas=<?php echo $row["kode_kelas"] ?>&mapel=<?= $row["kode_matpel"] ?>" class=" btn btn-info btn-sm" title="Kehadiran">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </a>
                    </td>

                    <td>
                        <a href="jadwaledit.php?ubah=<?php echo $row["kode_kelas"] ?>&matpel=<?= $row['kode_matpel'] ?>&id=<?= $row['id'] ?>" class="btn btn-success btn-sm" title="Edit">

                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </a>
                    </td>

                    <td>
                        <a href="jadwalhapus.php?hapus=<?php echo $row['kelas'] ?>&hapus2=<?php echo $row['matpel']; ?>" class="btn btn-danger btn-sm" title="Delete">

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