<!DOCTYPE html>
<html>

</html>
<?php
include 'koneksi.php';
session_start();


$query = mysqli_query($koneksi, "select * from spk join siswa on spk.kode_siswa = siswa.kode_siswa join kelasdetail on kelasdetail.kode_siswa = siswa.kode_siswa join kelas on kelasdetail.kode_kelas = kelas.kode_kelas order by spk.hasil_spk DESC ");


?>

<head>
	<title>Print Hasil SPK</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<img src="./img/budiAgung.jpg" style="height: 150px;">
					</div>
					<div class="col-md-10">
						<center>
							<div class="row mt-3">
								<center>

									<h4>YAYASAN HAKKA INDONESIA </h4>
									<h4> PERGURUAN BUDI AGUNG DKI JAKARTA SMA BUDI AGUNG</h4>
									<h6>Jl. Terusan Bandengan Utara No. 95 Blok F2-12, G5,D25-28, Jakarta 14450 -Indonesia</h6>
									<h6>Telp: (021) 6696420, 6623678 Fax: 6623687 email: sekolah.budiagung@yahoo.co.id</h6>
								</center>
							</div>

						</center>
					</div>


				</div>
				<hr>

				<div class="row">
					<div class="col-md-5 mt-3 mb-3">
						<h5>Hasil Seleksi Penerima Beasiswa</h5>


					</div>

				</div>
				<div class="row">

					<table style="width: 100%" class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Kode Siswa</th>
							<th>Nama</th>
							<th>Kelas</th>
							<th>Alamat Siswa</th>
							<th>Nomor Telepon</th>
							<th>Hasil Akhir</th>


						</tr>
						<?php
						$no = 1;
						while ($row = mysqli_fetch_array($query)) {
						?><tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $row['kode_siswa']; ?></td>
								<td><?php echo $row['nama_siswa']; ?></td>
								<td><?php echo $row['nama_kelas'] . " " . $row['jurusan'] . " " . $row['nomor_kelas'] ?></td>
								<td><?php echo $row['alamat_siswa']; ?></td>
								<td><?php echo $row['notelp_siswa']; ?></td>
								<td><?php echo round($row['hasil_spk'], 2); ?></td>

							</tr>
						<?php
						}
						?>
					</table>
				</div>
				<div class="row">
					<div class="col-sm-2">
						<i>

							<?= $_SESSION['role'] ?>:
							<?=
							$_SESSION['namauser'] ?>
						</i>
					</div>
					<div class="col-sm-4 offset-md-6">

						<i>
							date:
							<?= date('d F Y'); ?>
						</i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.print();
	</script>

</body>

</html>