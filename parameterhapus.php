<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
		$kodealbert2 = $_GET["hapus2"];
        mysqli_query($connection, "DELETE FROM parameter WHERE nama_kriteria = '$kodealbert' and bobot = '$kodealbert2'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='parameterinput.php?ubah=$kodealbert'</script>";
    }
?>