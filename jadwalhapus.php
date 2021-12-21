<?php
include "includes/config.php";
if (isset($_GET['hapus'])) {
    $kodealbert = $_GET["hapus"];

    mysqli_query($connection, "DELETE FROM jadwal WHERE id = '$kodealbert'");
    echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='jadwalinput.php'</script>";
}
