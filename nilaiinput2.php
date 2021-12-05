<!DOCTYPE html>

<?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
        $kelas = $_POST['inputkelas'];
        $siswa = $_POST['inputsiswa'];
        $matpel = $_POST['inputmatpel'];
        $tugas = $_POST['inputtugas'];
        $uts = $_POST['inpututs'];
        $uas = $_POST['inputuas'];

        mysqli_query($connection, "insert into nilai values('$kelas','$siswa','$matpel','$tugas','$uts','$uas')");
        header("location:nilaiinput.php");
    }
    $siswa = mysqli_query($connection, "select * from siswa");
    $kelas = mysqli_query($connection, "select * from kelas");
    $kelasdetail = mysqli_query($connection, "select * from kelasdetail");
    $matapelajaran = mysqli_query($connection, "select * from matapelajaran");
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
    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
    <div class="col-sm-10">
<select name="inputkelas"class="form-control" id="kelas">

    <option>Kelas</option>
    <?php while($row = mysqli_fetch_array($kelas)) 
    { ?>
    <option value="<?php echo $row["nama_kelas"]?>">
        <?php echo $row["kode_kelas"]?>
        <?php echo $row["nama_kelas"]?>
        <?php echo $row["jurusan"]?>
    </option>
    <?php } ?>

</select>
    </div>
    </div>

    <div class="form-group row">
    <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
    <div class="col-sm-10">
<select name="inputsiswa"class="form-control" id="siswa">

    <option>Siswa</option>
    <?php while($row = mysqli_fetch_array($siswa)) 
    { ?>
    <option value="<?php echo $row["nama_siswa"]?>">
        <?php echo $row["nama_siswa"]?>
    </option>
    <?php } ?>

</select>
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

    <form method="POST">
    <div class="form-group row mb-2">
        <label for="search" class="col-sm-3">Nama Siswa</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
            value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Siswa">
        </div>
        <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

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
        where siswa like '%".$search."%'");
    }else
    {
        $query = mysqli_query($connection, "select * from nilai");
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
        <a href="nilaiinput.php?ubah=<?php echo $row["kode_siswa"]?>"
        class="btn btn-info btn-sm" title="Nilai">

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
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