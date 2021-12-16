<?php
include 'koneksi.php';
$query  = mysqli_query($koneksi, "select * from parameter");
$c  = mysqli_query($koneksi, "select * from kriteria");
$bobot = array();
while ($row = $c->fetch_assoc()) {
    $krit[] = $row;
    array_push($bobot, $row['bobot_kriteria']);
}
$querySpk = mysqli_query($koneksi, "select * from spk");
$numrows = mysqli_num_rows($querySpk);
while ($row = $querySpk->fetch_assoc()) {
    $rows[] = $row;
}
while ($res = $query->fetch_assoc()) {
    $kriteria[] = $res;
}

foreach ($rows as $res) {
    $kode_siswa = $res['kode_siswa'];
    $c1 = $res['c1'];
    $c2 = $res['c2'];
    $c3 = $res['c3'];


    $bobotC1 = 0;
    $bobotC2 = 0;
    $bobotC3 = 0;
    foreach ($kriteria as $row) {
        // print_r($row['kode_kriteria'] == 'KK001');
        if ($row['kode_kriteria'] == "KK001") {
            if ($c1 <= $row['max'] && $c1 > $row['min']) {
                $bobotC1 = $row['bobot'];
            }
        }

        if ($row['kode_kriteria'] == "KK002") {
            if ($c2 == $row['min']) {
                $bobotC2 = $row['bobot'];
            }
        }
        if ($row['kode_kriteria'] == "KK003") {
            if ($c3 <= $row['max'] && $c3 > $row['min']) {
                $bobotC3 = $row['bobot'];
            }
        }
    }
    $qcheck = mysqli_query($koneksi, "select * from bobot_spk where kode_siswa ='" . $res['kode_siswa'] . "'");
    $rowcount = mysqli_num_rows($qcheck);
    if ($rowcount > 0) {
        mysqli_query($koneksi, "UPDATE  bobot_spk SET c1='$bobotC1', c2='$bobotC2',c3='$bobotC3' where kode_siswa='$kode_siswa'");
    } else {
        mysqli_query($koneksi, "INSERT INTO `bobot_spk` (`id`, `kode_siswa`, `c1`, `c2`, `c3`) VALUES (NULL, '$kode_siswa', '$bobotC1', '$bobotC2', '$bobotC3')");
    }
}



$bobot_spk = mysqli_query($koneksi, "select * from bobot_spk");
while ($row = $bobot_spk->fetch_assoc()) {
    $bspk[] = $row;
    $kk1[] = $row['c1'];
    $kk2[] = $row['c2'];
    $kk3[] = $row['c3'];
}
$ks = 1;
header("location:hitungHasilSpk.php");
