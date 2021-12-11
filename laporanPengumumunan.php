<!DOCTYPE html>

<?php
include "includes/config.php";

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
                    <h1 class="display-4">Laporan Pengumuman</h1>
                </div>
            </div>
            <!--penutup jumbotron-->


            <table class="table table success">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>judul</th>
                        <th>Tanggal</th>
                        <th>Isi</th>
                        <th>Pdf</th>


                    </tr>
                </thead>

                <tbody>
                    <?php

                    $query = mysqli_query($connection, "select * from pengumuman");

                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['kode_pengumuman']; ?></td>
                            <td><?php echo $row['judul_pengumuman']; ?></td>
                            <td><?php echo $row['tanggal_pengumuman']; ?></td>
                            <td><?php echo $row['isi_pengumuman']; ?></td>
                            <!-- untuk icon edit dan delete -->
                            <td>
                                <?php if ($row['filePdf'] != "") {
                                    $dir = "upload";
                                ?>
                                    <a href="<?= $dir . "/" . $row['filePdf'] ?>" target="_blank" class="btn btn-primary btn-sm" title="View">
                                        <?= $row['filePdf']; ?>
                                    </a>
                                <?php } else {
                                    echo "-";
                                } ?>
                            </td>
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