<!DOCTYPE html>

<?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
        $kelas = $_GET['ubah'];
        $siswa = $_GET['ubah2'];
        $matpel = $_POST['inputmatpel'];
        $tugas = $_POST['inputtugas'];
        $uts = $_POST['inpututs'];
        $uas = $_POST['inputuas'];

        mysqli_query($connection, "insert into nilai values('$kelas','$siswa','$matpel','$tugas','$uts','$uas')");
        header("location:nilaiinput.php?ubah=$kelas&ubah2=$siswa");
    }
    $siswa = mysqli_query($connection, "select * from siswa");
    $kelas = mysqli_query($connection, "select * from kelas");
    $matapelajaran = mysqli_query($connection, "select * from matapelajaran");
    $nilai = mysqli_query($connection, "select * from nilai where kelas='" . $_GET['ubah'] . "'");

    $albertedit = mysqli_query($connection, "SELECT * FROM kelas");
    $rowedit = mysqli_fetch_array($albertedit);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['emailuser']))
        header("location:login.php");
?>
<?php include "header.php";?>

<div class="container-fluid">
<div class="card shadow mb-4">

<body>

<div class="row">
<div class="col-sm-1">
  </div>

  <div class="col-sm-10">

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Input Nilai </h1>
    </div>
    </div> <!--penutup jumbotron-->

  <form method="POST">
  

  <div class="form-group row">
    <label for="kelas" class="col-sm-2 col-form-label">Kode Kelas</label>
    
    <div class="col-sm-10">
	<input type="text" disabled value="<?php echo $_GET['ubah'];?>" class="form-control"/>
</div>
</div>

<div class="form-group row">
    <label for="siswa" class="col-sm-2 col-form-label">Kode Siswa</label>
    
    <div class="col-sm-10">
	<input type="text" disabled value="<?php echo $_GET['ubah2'];?>" class="form-control"/>
</div>
</div>
  
  <!--code drop down-->
  <div class="form-group row">
    <label for="matpel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
    <div class="col-sm-10">
<select name="inputmatpel"class="form-control" id="matpel">
    <option>Mata Pelajaran</option>
    <?php while($row = mysqli_fetch_array($matapelajaran)) 
    { ?>
    <option value="<?php echo $row["nama_matpel"]?>">
        <?php echo $row["nama_matpel"]?>
    </option>
    <?php } ?>
</select>
</div>
</div>

<div class="form-group row">
    <label for="tugas" class="col-sm-2 col-form-label">Tugas </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputtugas" id="tugas" placeholder="0 - 100 " maxlength="3" required="">
    </div>
  </div>

  <div class="form-group row">
    <label for="uts" class="col-sm-2 col-form-label">UTS </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inpututs" id="uts" placeholder="0 - 100 " maxlength="3" required="">
    </div>
  </div>

  <div class="form-group row">
    <label for="uas" class="col-sm-2 col-form-label">UAS </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputuas" id="uas" placeholder="0 - 100 " maxlength="3" required="">
    </div>
  </div>

  <div class="form-group row">
  <div class="col-sm-2">
    </div>
    <div class="col-sm-10">
        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
        <input type="button" class="btn btn-secondary" value="Batal" name="batal">
    </div>
  </div>
</form>
</div>

</div> <!--penutup class row-->

<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Daftar Nilai </h1>
    </div>
    </div> <!--penutup jumbotron-->

<table class="table table success">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Tugas</th>
            <th>UTS</th>
            <th>UAS</th>
            <th colspan="2" style="text-align: center">Action</th>
        </tr>
    </thead>

<tbody>
    <?php
    if(isset($_POST["kirim"]))
    {
        $search = $_POST['search'];
        $query = mysqli_query($connection, "select * from nilai
        where siswa like '%".$search."%' and matpel = '" . $_GET['ubah'] . "'");
    }else
    {
        $query = mysqli_query($connection, "select * from nilai where siswa = '" . $_GET['ubah2'] . "'");
    }
    $nomor = 1;
    while ($row = mysqli_fetch_array($query))
    { ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $row['kelas'];?></td>
            <td><?php echo $row['siswa'];?></td>
            <td><?php echo $row['matpel'];?></td>
            <td><?php echo $row['tugas'];?></td>
            <td><?php echo $row['uts'];?></td>
            <td><?php echo $row['uas'];?></td>
        <!-- untuk icon edit dan delete -->
        <td>
        <a href="nilaiedit.php?ubah=<?php echo $row['kelas']?>&ubah2=<?php echo $row['siswa'];?>"
        class="btn btn-success btn-sm" title="Edit">

        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
        </a>
        </td>

        <td>
        <a href="nilaihapus.php?hapus=<?php echo $row['siswa']?>&hapus2=<?php echo $row['matpel'];?>"
        class="btn btn-danger btn-sm" title="Delete">

        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg>
        </a>
        </td>
<!-- akhir icon edit delete -->
        </tr>
    <?php $nomor = $nomor + 1;?>
    <?php } ?>
</tbody>

</table>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
<!--penutup container fluid-->
</div>
</div>
<?php include "footer.php";?>
<?php 
    mysqli_close($connection);
    ob_end_flush();
?>

</html>