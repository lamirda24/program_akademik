<?php
include 'koneksi.php';
$query  = mysqli_query($koneksi, "select * from parameter");
$c  = mysqli_query($koneksi, "select * from kriteria");
while ($row = $c->fetch_assoc()) {
    $krit[] = $row;
}


$querySpk = mysqli_query($koneksi, "select * from spk");
$numrows = mysqli_num_rows($querySpk);
while ($row = $querySpk->fetch_assoc()) {
    $rows[] = $row;
}
while ($res = $query->fetch_assoc()) {
    $kriteria[] = $res;
}
// var_dump($rows);
// die;



// this will loop throwhile($row = $result->fetch_array())
// {
//     $rows[] = $row;
// }

// this will loop through $rows array and provide each column result
// 
// foreach ($rows as $row)
//  {
//      echo $row["id"];
//      echo $row["title"];
//      echo $row["description"];
//      echo $row["content"];
//  }gh $rows array and provide each column result

echo "<pre>";
$i = 1;
// echo $row['kode_kriteria'];
// while ($res = mysqli_fetch_assoc($querySpk)) {
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
            // echo "<pre>";
            // var_dump($c1  . "<=" . $row['max']);

            // var_dump($c1  <= $row['max']);
        }

        if ($row['kode_kriteria'] == "KK002") {
            if ($c2 == $row['min']) {
                $bobotC2 = $row['bobot'];
            }
        }
        if ($row['kode_kriteria'] == "KK003") {
            if ($c3 < $row['max'] && $c3 > $row['min']) {
                $bobotC3 = $row['bobot'];
            }
        }
        // echo $res['kode_siswa'] . " / " . $bobotC1 . $bobotC2 . $bobotC3;
        // echo "<br>";


    }
    $qcheck = mysqli_query($koneksi, "select * from bobot_spk where kode_siswa ='" . $res['kode_siswa'] . "'");
    $rowcount = mysqli_num_rows($qcheck);
    if ($rowcount > 0) {
        mysqli_query($koneksi, "UPDATE  bobot_spk SET c1='$bobotC1', c2='$bobotC2',c3='$bobotC3' where kode_siswa='$kode_siswa'");
        echo $res['kode_siswa'] . " / " . $bobotC1 . $bobotC2 . $bobotC3;
    } else {
        mysqli_query($koneksi, "INSERT INTO `bobot_spk` (`id`, `kode_siswa`, `c1`, `c2`, `c3`) VALUES (NULL, '$kode_siswa', '$bobotC1', '$bobotC2', '$bobotC3')");

        echo $res['kode_siswa'] . " / " . $bobotC1 . $bobotC2 . $bobotC3;
    }
    // $qcheck = mysqli_query($koneksi, "select * from bobot_spk where kode_siswa ='" . $res['kode_siswa'] . "'");
    // $rowcount = mysqli_num_rows($qcheck);
    // if ($rowcount > 0) {
    //     mysqli_query($koneksi, "UPDATE  bobot_spk SET c1='$bobotC1', c2='$bobotC2',c3='$bobotC3' where kode_siswa='$kode_siswa'");
    //     echo $res['kode_siswa'] . " / " . $bobotC1 . $bobotC2 . $bobotC3;
    // } else {
    //     mysqli_query($koneksi, "INSERT INTO `bobot_spk` (`id`, `kode_siswa`, `c1`, `c2`, `c3`) VALUES (NULL, '$kode_siswa', '$bobotC1', '$bobotC2', '$bobotC3')");

    //     echo $res['kode_siswa'] . " / " . $bobotC1 . $bobotC2 . $bobotC3;
    // }
    // $i++;
    // }

}
// kenapa nilainya sama pas keapdetnya


$bobot_spk = mysqli_query($koneksi, "select * from bobot_spk");
while ($row = $bobot_spk->fetch_assoc()) {
    $bspk[] = $row;
    $kk1[] = $row['c1'];
    $kk2[] = $row['c2'];
    $kk3[] = $row['c3'];
}
// // var_dump(max($kk2));

// die;
$hasil = [];
$ks = 1;

foreach ($krit as $k) {
    // echo "<pre>";
    $sum = 0;
    $h1 = 0;
    $h2 = 0;
    $h3 = 0;
    $hh1 = 0;
    $hh2 = 0;
    $hh3 = 0;
    $totalh1 = 0;
    $totalh2 = 0;
    $totalh3 = 0;

    foreach ($bspk as $bs) {
        if ($bs['kode_siswa'] == "KS00" . $ks) {
            // var_dump($bs);
            // print($k['kode_kriteria']);
            if ($k['kode_kriteria'] == "KK001") {
                if ($k['atribut_kriteria'] == "Benefit") {
                    $max1 = max($kk1);
                    $h1 = $bs['c1'] / $max1;
                } else {
                    $max1 = min($kk1);
                    $h1 = $max1 / $bs['c1'];
                }
                // echo "<pre>";
                // echo $h1;
                $hh1 = $h1 * $k['bobot_kriteria'];
                // echo $hh1;
            } else if ($k['kode_kriteria'] == "KK002") {
                // echo "k2";
                if ($k['atribut_kriteria'] == "Benefit") {
                    $max2 = max($kk2);
                    $h2 = $bs['c2'] / $max2;
                } else {
                    $max2 = min($kk2);
                    $h2 = $max2 / $bs['c2'];
                }
                $hh2 = $h2 * $k['bobot_kriteria'];
                // echo $hh2;
                // // die;
            } else if ($k['kode_kriteria'] == "KK003") {
                if ($k['atribut_kriteria'] == "Benefit") {
                    $max3 = max($kk3);
                    $h3 = $bs['c3'] / $max3;
                } else {
                    $max3 = min($kk3);
                    $h3 = $max3 / $bs['c3'];
                }
                $hh3 = $h3 * $k['bobot_kriteria'];
            }
            $totalh1 += $hh1;
            $totalh2 += $hh2;
            $totalh3 += $hh3;
        }
    }
    $sum = $totalh1 + $totalh2 + $totalh3;
    var_dump(" sum : " . $sum);
}
// var_dump($hasil);



die;
