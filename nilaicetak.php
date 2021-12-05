<!DOCTYPE html>
<html>
<head>
	<title>Print Daftar Nilai</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
	<center>
 
		<h2>SMA BUDI AGUNG</h2>
		<h4>DAFTAR NILAI</h4>
 
	</center>
 
	<?php 
	include 'koneksi.php';
	?>
 
	<table  style="width: 100%" class="table table-bordered">
		<tr>
			<th width="1%">No</th>
            <th>Mata Pelajaran</th>
            <th>Tugas</th>
            <th>UTS</th>
            <th>UAS</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($koneksi,"SELECT * FROM nilai");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['matpel']; ?></td>
			<td><?php echo $data['tugas']; ?></td>
			<td><?php echo $data['uts']; ?></td>
            <td><?php echo $data['uas']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
 </div>
 </div>
 </div>
	<script>
		window.print();
	</script>
 
</body>
</html>