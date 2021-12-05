<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM kelas WHERE kode_kelas = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='kelasinput.php'</script>";
    }
?>