<?php
include 'koneksi.php';
$query  = mysqli_query($koneksi, "select * from parameter");
$c  = mysqli_query($koneksi, "select * from kriteria");
$bobot = array();
while ($row = $c->fetch_assoc()) {
    $kriteria[] = $row;
    array_push($bobot, $row['bobot_kriteria']);
}
$siswa = [];
$querySpk = mysqli_query($koneksi, "select * from bobot_spk");
while ($row = $querySpk->fetch_assoc()) {
    $siswa[] = $row;
    $kk1[] = $row['c1'];
    $kk2[] = $row['c2'];
    $kk3[] = $row['c3'];
}
$maxc = ["max1" => max($kk1), "max2" => max($kk2), "max3" => max($kk3)];
$minc = ["min1" => min($kk1), "min2" => min($kk2), "min3" => min($kk3)];

foreach ($siswa as $keys => $s) {
    $totalCount = array();
    $sum = 0;

    foreach ($kriteria as $key => $k) {
        $hasilC1 = $hasilC2 = $hasilC3 = 0;
        $totalHasil = array();
        $idx = "c" . strval(intval($key) + 1);
        $maxIdx = "max" . strval(intval($key) + 1);
        $minIdx = "min" . strval(intval($key) + 1);
        if ($k["atribut_kriteria"] == "Benefit") {
            $hasil = $s[$idx] /  $maxc[$maxIdx];

            array_push($totalHasil, $hasil);
        } else {
            $hasil = $minc[$minIdx] / $s[$idx];

            array_push($totalHasil, $hasil);
        }
        array_push($totalCount, $totalHasil);
    }
    $sum = ($totalCount[0][0] * $bobot[0]) + ($totalCount[1][0] * $bobot[1]) + ($totalCount[2][0] * $bobot[2]);

    mysqli_query($koneksi, "UPDATE spk set hasil_spk='$sum' where kode_siswa='" . $s['kode_siswa'] . "'");
    var_dump($sum);
}

header("location:laporanHasil.php");
