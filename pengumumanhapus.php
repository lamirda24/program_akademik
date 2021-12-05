<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM pengumuman WHERE kode_pengumuman = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='pengumumaninput.php'</script>";
    }
?>