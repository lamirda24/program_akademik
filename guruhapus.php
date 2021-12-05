<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM guru WHERE kode_guru = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='guruinput.php'</script>";
    }
?>