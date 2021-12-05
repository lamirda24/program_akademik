<!DOCTYPE html>

<?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
        if(isset($_REQUEST['inputmin']))
        {
            $min = $_REQUEST['inputmin'];
        }
        if(!empty($min))
        {
            $min = $_REQUEST['inputmin'];
        }
        else 
        {
            ?> <h1>Anda Harus Mengisi Data</h1> <?php
            die ("anda harus memasukkan datanya");
        }
        $nama_kriteria = $_POST['inputkriteria'];
        $max = $_POST['inputmax'];
        $bobot_kriteria = $_POST['inputbobot'];

        mysqli_query($connection, "insert into parameter values('$nama_kriteria','$min','$max','$bobot_kriteria')");
        header("location:parameterinput.php");
    }
    $kriteria = mysqli_query($connection, "select * from kriteria");
    $bobotnilai = mysqli_query($connection, "select * from bobotnilai");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Parameter</title>
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
        <h1 class="display-4">Input Parameter</h1>
    </div>
    </div> <!--penutup jumbotron-->

  <form method="POST">
  <div class="form-group row">
    <label for="nama_kriteria" class="col-sm-2 col-form-label">Kriteria</label>
    <div class="col-sm-10">
<select name="inputkriteria"class="form-control" id="nama_kriteria">

    <option>Kriteria</option>
    <?php while($row = mysqli_fetch_array($kriteria)) 
    { ?>
    <option value="<?php echo $row["nama_kriteria"]?>">
        <?php echo $row["nama_kriteria"]?>
    </option>
    <?php } ?>

</select>
    </div>
    </div>

  <div class="form-group row">
    <label for="min" class="col-sm-2 col-form-label">Min</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputmin" id="min" placeholder="Input Min">
    </div>
  </div>

  <div class="form-group row">
    <label for="max" class="col-sm-2 col-form-label">Max </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="inputmax" id="max" placeholder="Input Max ">
    </div>
  </div>

  <div class="form-group row">
    <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
    <div class="col-sm-10">
<select name="inputbobot"class="form-control" id="bobot">

    <option>Bobot</option>
    <?php while($row = mysqli_fetch_array($bobotnilai)) 
    { ?>
    <option value="<?php echo $row["bobot"]?>">
        <?php echo $row["bobot"]?>
    </option>
    <?php } ?>

</select>

  <div class="form-group row">
    <div class="col-sm-10">
        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
        <input type="button" class="btn btn-secondary" value="Batal" name="batal">
    </div>
  </div>

</form>
</div>

</div> <!--penutup class row-->

<div class="col-sm-1">
  </div>


  <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Daftar Parameter</h1>
    </div>
    </div> <!--penutup jumbotron-->

<form method="POST">
    <div class="form-group row mb-2">
        <label for="search" class="col-sm-3">Nama Kriteria</label>
        <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search"
            value="<?php if(isset($_POST['search'])) {echo $_POST['search'];}?>" placeholder="Cari Kriteria">
        </div>
        <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

<table class="table table success">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Min</th>
            <th>Max</th>
            <th>Bobot</th>
            <th colspan="2" style="text-align: center">Action</th>
        </tr>
    </thead>

<tbody>
    <?php
    if(isset($_POST["kirim"]))
    {
        $search = $_POST['search'];
        $query = mysqli_query($connection, "select * from parameter
        where nama_kriteria like '%".$search."%'");
    }else
    {
        $query = mysqli_query($connection, "select * from parameter");
    }
    $nomor = 1;
    while ($row = mysqli_fetch_array($query))
    { ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $row['nama_kriteria'];?></td>
            <td><?php echo $row['min'];?></td>
            <td><?php echo $row['max'];?></td>   
            <td><?php echo $row['bobot'];?></td>  
        <!-- untuk icon edit dan delete -->
        <td>
        <a href="parameteredit.php?ubah=<?php echo $row["nama_kriteria"]?>"
        class="btn btn-success btn-sm" title="Edit">

        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
        </a>
        </td>

        <td>
        <a href="parameterhapus.php?hapus=<?php echo $row['nama_kriteria']?>&hapus2=<?php echo $row['bobot'];?>"
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