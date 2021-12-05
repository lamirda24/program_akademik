<?php
include "includes/config.php";

$kelas = $_GET['kelas'];
$mapel = $_GET['mapel'];
if (isset($_GET['siswa'])) {
    $id = $_GET["siswa"];
    mysqli_query($connection, "DELETE FROM absensi WHERE id='$id'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location=' absensiinput.php?kelas=$kelas&mapel=$mapel'</script>";
}
