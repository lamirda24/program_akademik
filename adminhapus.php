<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM admin WHERE adminID = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='admininput.php'</script>";
    }
?>