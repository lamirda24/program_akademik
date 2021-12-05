<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM matapelajaran WHERE kode_matpel = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='matpelinput.php'</script>";
    }
?>