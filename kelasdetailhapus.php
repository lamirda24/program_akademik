<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodealbert = $_GET["hapus"];
		$kodealbert2 = $_GET["hapus2"];
        mysqli_query($connection, "DELETE FROM kelasdetail WHERE kode_kelas = '$kodealbert' and kode_siswa = '$kodealbert2'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
            document.location='kelasdetailinput.php?ubah=$kodealbert'</script>";
    }
