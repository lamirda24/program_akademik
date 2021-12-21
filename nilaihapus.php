<?php
include "includes/config.php";
if (isset($_GET['siswa'])) {
    $kode_siswa = $_GET["siswa"];
    $kode_mapel = $_GET["mapel"];
    $kode_kelas = $_GET['kelas'];
    mysqli_query($connection, "DELETE FROM nilai WHERE kode_siswa = '$kode_siswa' and kodematpel = '$kode_mapel'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='nilaiMapelKelas.php?kelas=$kode_kelas&mapel=$kode_mapel'</script>";
}
