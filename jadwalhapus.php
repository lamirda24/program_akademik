<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
		$kodealbert2 = $_GET["hapus2"];
        mysqli_query($connection, "DELETE FROM jadwal WHERE kelas = '$kodealbert' and matpel = '$kodealbert2'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='jadwalinput.php?ubah=$kodealbert'</script>";
    }
?>