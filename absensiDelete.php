<?php
include "includes/config.php";

$kelas = $_GET['kelas'];
$mapel = $_GET['mapel'];

if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $date = $_GET['date'];
    $query = mysqli_query($connection, "select * from absensi where id='$id'");
    $res = mysqli_fetch_assoc($query);
    if ($res['kehadiran'] == 1) {
        mysqli_query($connection, "UPDATE absensi SET kehadiran = 0 where id='$id'");
    } else {
        mysqli_query($connection, "UPDATE absensi SET kehadiran = 1 where id='$id'");
    }
    echo "<script>alert('DATA BERHASIL DIUPDATE');
            document.location='absensiinput.php?kelas=$kelas&mapel=$mapel'</script>";
}
// siswa=1&kelas=KD001&mapel=KM007