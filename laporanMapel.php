<!DOCTYPE html>

<?php
include "includes/config.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Matapelajaran</title>
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
                    <h1 class="display-4">Laporan Matapelajaran</h1>
                </div>
            </div>
            <!--penutup jumbotron-->
            <div class="row mb-3">
                <div class="col-md-8">

                    <form method="GET" id="roleForm">
                        <div class="form-group">
                            <div class="col-md-10">
                                Filter:
                                <select class="form-control" required name="filter" id="role" onchange="submitRole()">
                                    <option value="mapel" <?= $_GET['filter'] == "mapel" ? "selected" : ""; ?>>Mata Pelajaran</option>
                                    <option value="kelas" <?= $_GET['filter'] == "kelas" ? "selected" : ""; ?>>Kelas</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>


            </div>


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <?php if ($_GET['filter'] == "mapel") { ?>
                            <th>Kode Matapelajaran</th>
                            <th>Nama Pelajaran</th>

                        <?php } elseif ($_GET['filter'] == "kelas") { ?>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                        <?php } ?>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($_GET['filter'] == "mapel") {
                        $query = mysqli_query($connection, "SELECT * FROM matapelajaran ");
                    } elseif ($_GET['filter'] == "kelas") {
                        $query = mysqli_query($connection, "SELECT * FROM jadwal group by kode_kelas ");
                    }

                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <?php if ($_GET['filter'] == "mapel") { ?>
                                <td><?php echo $row['kode_matpel']; ?></td>
                                <td><?php echo $row['nama_matpel']; ?></td>
                                <td>
                                    <a href="laporanMapelGuru.php?filter=mapel&mapel=<?php echo $row["kode_matpel"] ?>" class="btn btn-primary btn-sm" title="Edit">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                    </a>
                                </td>
                            <?php } elseif ($_GET['filter'] == "kelas") { ?>
                                <td><?php echo $row['kode_kelas']; ?></td>
                                <td><?php echo $row['nama_kelas']; ?></td>
                                <td>
                                    <a href="laporanMapelGuru.php?filter=kelas&kelas=<?php echo $row["kode_kelas"] ?>" class="btn btn-primary btn-sm" title="Edit">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                    </a>
                                </td>
                            <?php  } ?>

                            <!-- untuk icon edit dan delete -->

                        </tr>
                        <?php $nomor = $nomor + 1; ?>
                    <?php } ?>
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