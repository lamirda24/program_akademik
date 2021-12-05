<!DOCTYPE html>

<?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
        if(isset($_REQUEST['inputkode']))
        {
            $kode_guru = $_REQUEST['inputkode'];
        }
        if(!empty($kode_guru))
        {
            $kode_guru = $_REQUEST['inputkode'];
        }
        else 
        {
            ?> <h1>Anda Harus Mengisi Data</h1> <?php
            die ("anda harus memasukkan datanya");
        }
        
        $nama_guru = $_POST['inputnama'];
        $notelp_guru = $_POST['inputnotelp'];
        $alamat_guru = $_POST['inputalamat'];

        mysqli_query($connection, "update guru set nama_guru='$nama_guru', notelp_guru='$notelp_guru',alamat_guru='$alamat_guru'
        WHERE kode_guru = '$kode_guru'");
        header("location:guruinput.php");
    }
    //untuk menampilkan data pada form edit
    $kode_guru = $_GET ["ubah"];
    $albertedit = mysqli_query($connection, "SELECT * FROM guru
    WHERE kode_guru = '$kode_guru'");
    $rowedit = mysqli_fetch_array($albertedit);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Daftar guru</title>
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
        <h1 class="display-4">Edit Data Guru </h1>
    </div>
    </div> <!--penutup jumbotron-->

  <form method="POST" name='f1'>
  <div class="form-group row">
    <label for="kode_guru" class="col-sm-2 col-form-label">Kode Guru</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputkode" id="suppplierid" readonly value ="<?php echo $rowedit["kode_guru"]?>" maxlength="6" required="">
    </div>
  </div>

  <div class="form-group row">
    <label for="nama_guru" class="col-sm-2 col-form-label">Nama Guru</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputnama" id="nama_guru" value ="<?php echo $rowedit["nama_guru"]?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="notelp_guru" class="col-sm-2 col-form-label">Nomor Telepon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputnotelp" id="notelp_guru" value ="<?php echo $rowedit["notelp_guru"]?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="alamat_guru" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputalamat" id="alamat_guru" value ="<?php echo $rowedit["alamat_guru"]?>">
    </div>
  </div>

  <div class="col-sm-10">

  <div class="form-group row">
  <div class="col-sm-2">
    </div>
    <div class="col-sm-10">
        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
        <input type="button" class="btn btn-secondary" value="Batal" name="batal">
    </div>
  </div>

  <div class="col-sm-10">

</form>
</div>

</div> <!--penutup class row-->

<div class="col-sm-1">
  </div>


  <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Daftar Guru </h1>
    </div>
    </div> <!--penutup jumbotron-->

<form method="POST">
    <div class="form-group row mb-2">
        <label for="search" class="col-sm-3">Nama Guru</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
            value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Nama Guru">
        </div>
        <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

<table class="table table success">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th colspan="2" style="text-align: center">Action</th>
        </tr>
    </thead>

<tbody>
    <?php
    if(isset($_POST["kirim"]))
    {
        $search = $_POST['search'];
        $query = mysqli_query($connection, "select * from guru
        where nama_guru like '%".$search."%'");
    }else
    {
        $query = mysqli_query($connection, "select * from guru");
    }
    $nomor = 1;
    while ($row = mysqli_fetch_array($query))
    { ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $row['kode_guru'];?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['notelp_guru'];?></td>
            <td><?php echo $row['alamat_guru'];?></td>
        <!-- untuk icon edit dan delete -->
        <td>
        <a href="guruedit.php?ubah=<?php echo $row["kode_guru"]?>"
        class="btn btn-success btn-sm" title="Edit">

        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
        </a>
        </td>

        <td>
        <a href="guruhapus.php?hapus=<?php echo $row["kode_guru"]?>"
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