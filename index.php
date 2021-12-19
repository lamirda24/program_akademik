<!DOCTYPE html>

<?php
ob_start();
session_start();
if (!isset($_SESSION['kodeuser'])) {
    header("location:login.php");
}
include "includes/config.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>

<body>
    <?php include "header.php"; ?>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome Back</h1>
            <h3 class="display-8">
                <?php
                echo date("l, ") . date("d-m-Y") . "<br>";
                ?>
            </h3>
        </div>
    </div>

    <?php if ($_SESSION['role'] != "siswa") : ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                                    $sql = "select count(*) as a from siswa ";
                                                                                    $a = mysqli_query($connection, $sql);
                                                                                    echo mysqli_fetch_object($a)->a;
                                                                                    ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                                    $sql = "select count(*) as a from guru ";
                                                                                    $a = mysqli_query($connection, $sql);
                                                                                    echo mysqli_fetch_object($a)->a;
                                                                                    ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                                    $sql = "select count(*) as a from kelas ";
                                                                                    $a = mysqli_query($connection, $sql);
                                                                                    echo mysqli_fetch_object($a)->a;
                                                                                    ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Mata Pelajaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                                    $sql = "select count(*) as a from matapelajaran ";
                                                                                    $a = mysqli_query($connection, $sql);
                                                                                    echo mysqli_fetch_object($a)->a;
                                                                                    ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    include "footer.php";
    ?>

</body>

</html>