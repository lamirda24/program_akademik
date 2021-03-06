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

    mysqli_query($connection, "insert into kelas values('$kode_kelas','$nama_kelas','$jurusan')");
    header("location:kelasinput.php");
}

$siswa = mysqli_query($connection, "Select * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa order by siswa.nama_siswa asc");

$filter = $_GET['filter'];
if (isset($_GET['filter'])) {
    if ($filter == "IPA") {
        $siswa = mysqli_query($connection, "SELECT * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas where jurusan ='IPA' order by siswa.nama_siswa asc");
        // echo "SELECT * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas where jurusan ='IPA' order by siswa.nama_siswa asc";
        // die;
    } elseif ($filter == "All") {
        $siswa = mysqli_query($connection, "Select * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa order by siswa.nama_siswa asc");
        // echo "Select * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa order by siswa.nama_siswa asc";
        // die;
    } elseif ($filter == "IPS") {
        $siswa = mysqli_query($connection, "SELECT * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas where jurusan ='IPS' order by siswa.nama_siswa asc");
        // echo "SELECT * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa join kelas on kelas_detail.kode_kelas = kelas.kode_kelas where jurusan ='IPS' order by siswa.nama_siswa asc";
        // die;
    }
}

// $filter = $_GET['filter'];
// if ($filter == "All") {
// } else {
//     $siswa = mysqli_query($connection, "Select * from siswa join join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa join kelas on kelas_detail.kode_kelas = kelas.kode_kelas where jurusan='$filter 'order by siswa.nama_siswa asc");
// }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Siswa</title>
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

            <div class="col-sm-1">
            </div>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Laporan Siswa</h1>
                </div>
            </div>
            <!--penutup jumbotron-->

            <div class="row">
                <div class="col-md-2">
                    <form method="GET" id="roleForm">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <select class="form-control" required name="filter" id="role" onchange="submitRole()">
                                    <option value="All" <?= $_GET['filter'] == "" ? "selected" : ""; ?>>All</option>
                                    <option value="IPA" <?= $_GET['filter'] == "IPA" ? "selected" : ""; ?>>IPA</option>
                                    <option value="IPS" <?= $_GET['filter'] == "IPS" ? "selected" : ""; ?>>IPS</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 offset-md-4">
                    <form method="POST">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari Nama siswa  ">
                            </div>
                            <input type="submit" name="kirim" class=" btn btn-primary" value="Search">
                            <a href="laporanSiswaCetak.php?filter=<?= $filter ?>" target="_blank" class="btn btn-warning ml-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                </svg> Print
                            </a>
                    </form>

                </div>

            </div>




    </div>


    <table class="table table success">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kelas</th>

            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($_POST["kirim"])) {
                $search = $_POST['search'];
                $query = mysqli_query($connection, "Select * from siswa join kelasdetail on siswa.kode_siswa = kelasdetail.kode_siswa  where siswa.nama_siswa like '%" . $search . "%' order by siswa.nama_siswa asc");
            } else {
                $query = $siswa;
            }
            $rowcount = mysqli_num_rows($query);


            $nomor = 1;
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $row['kode_siswa']; ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['kode_kelas']; ?></td>
                        <!-- untuk icon edit dan delete -->
                        <!-- akhir icon edit delete -->
                    </tr>
                    <?php $nomor = $nomor + 1; ?>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">
                        no data

                    </td>
                </tr>
            <?php }
            ?>
        </tbody>

    </table>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    function submitRole() {
        $('#roleForm').submit();
    }
</script>
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