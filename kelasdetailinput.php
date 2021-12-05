<!DOCTYPE html>

<?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
        $kode_kelas = $_GET['ubah'];
        $kode_siswa = $_POST['inputkodesiswa'];
        $nama_siswa = $_POST['inputnama'];

        mysqli_query($connection, "insert into kelasdetail values('$kode_kelas','$kode_siswa','$nama_siswa')");
        header("location:kelasdetailinput.php?ubah=$kode_kelas");
    }
    $siswa = mysqli_query($connection, "select * from siswa");
    $kelas = mysqli_query($connection, "select * from kelas");
    $kelasdetail = mysqli_query($connection, "select * from kelasdetail where kode_kelas='" . $_GET['ubah'] . "'");

    $albertedit = mysqli_query($connection, "SELECT * FROM kelas");
    $rowedit = mysqli_fetch_array($albertedit);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas</title>
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
        <h1 class="display-4">Detail Kelas </h1>
    </div>
    </div> <!--penutup jumbotron-->

  <form method="POST">
  

  <div class="form-group row">
    <label for="kode_kelas" class="col-sm-2 col-form-label">Kode Kelas</label>
    
    <div class="col-sm-10">
	<input type="text" disabled value="<?php echo $_GET['ubah'];?>" class="form-control"/>
</div>
</div>
  
  <!--code drop down-->
  <div class="form-group row">
    <label for="kode_siswa" class="col-sm-2 col-form-label">Kode Siswa</label>
    <div class="col-sm-10">
<select name="inputkodesiswa"class="form-control" id="kodebarang">
    <option>Kode Siswa</option>
    <?php while($row = mysqli_fetch_array($siswa)) 
    { ?>
    <option value="<?php echo $row["kode_siswa"]?>  <?php echo $row['nama_siswa'];?>">
        <?php echo $row["kode_siswa"]?>
        <?php echo $row["nama_siswa"]?>
    </option>
    <?php } ?>
</select>
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
        <h1 class="display-4">Daftar Siswa </h1>
    </div>
    </div> <!--penutup jumbotron-->

    <form method="POST">
    <div class="form-group row mb-2">
        <label for="search" class="col-sm-3">Kode Kelas</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
            value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Kode Kelas">
        </div>
        <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

<table class="table table success">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Siswa</th>
            <th colspan="1" style="text-align: center">Action</th>
        </tr>
    </thead>

<tbody>
    <?php
    if(isset($_POST["kirim"]))
    {
        $search = $_POST['search'];
        $query = mysqli_query($connection, "select * from kelasdetail
        where kode_kelas like '%".$search."%' and kode_kelas = '" . $_GET['ubah'] . "'");
    }else
    {
        $query = mysqli_query($connection, "select * from kelasdetail where kode_kelas = '" . $_GET['ubah'] . "'");
    }
    $nomor = 1;
    while ($row = mysqli_fetch_array($query))
    { ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $row['kode_kelas'];?></td>
            <td><?php echo $row['kode_siswa'];?></td>


        <!-- untuk icon edit dan delete 
        <td>
        <a href="nilaiinput.php?ubah=<?php echo $row["kode_kelas"]?>&ubah2=<?php echo $row['kode_siswa'];?>"
        class="btn btn-info btn-sm" title="Nilai">

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
        </svg>
        </a>
        </td>

        <td>
        <a href="nilaicetak.php?ubah=<?php echo $row["kode_kelas"]?>&ubah2=<?php echo $row['kode_siswa'];?>"
        class="btn btn-warning btn-sm" title="Cetak">

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg>
        </a>
        </td>

    -->

        <td>
        <a href="kelasdetailhapus.php?hapus=<?php echo $row['kode_kelas']?>&hapus2=<?php echo $row['kode_siswa'];?>"
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