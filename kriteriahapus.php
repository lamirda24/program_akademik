<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM kriteria WHERE kode_kriteria = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='kriteriainput.php'</script>";
    }
?>