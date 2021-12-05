<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM siswa WHERE kode_siswa = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='siswainput.php'</script>";
    }
?>