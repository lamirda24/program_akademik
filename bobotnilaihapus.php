<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
        mysqli_query($connection, "DELETE FROM bobotnilai WHERE kode_bobotnilai = '$kodealbert'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='bobotnilaiinput.php'</script>";
    }
?>