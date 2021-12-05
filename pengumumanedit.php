<!DOCTYPE html>

<?php
include "includes/config.php";
$dir = "upload";
$kode_pengumuman = $_GET["ubah"];
$albertedit = mysqli_query($connection, "SELECT * FROM pengumuman
WHERE kode_pengumuman = '$kode_pengumuman'");
$pdf = "";
$rowedit = mysqli_fetch_array($albertedit);
if (isset($_POST['simpan'])) {
  if (isset($_REQUEST['inputkode'])) {
    $kode_pengumuman = $_REQUEST['inputkode'];
    $judul_pengumuman = $_POST['inputjudul'];
    $tanggal_pengumuman = $_POST['inputtanggal'];
    $isi_pengumuman = $_POST['inputisi'];
    if ($file_type == "application/pdf") {
      if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
        $pdf =  basename($_FILES['file']['name']);
      } else {
        $pdf = $rowedit['5'];
      }
    }
    mysqli_query($connection, "update pengumuman set judul_pengumuman='$judul_pengumuman', tanggal_pengumuman='$tanggal_pengumuman',isi_pengumuman='$isi_pengumuman',filePdf='$pdf'
    WHERE kode_pengumuman = '$kode_pengumuman'");
  }
  if (!empty($kode_pengumuman)) {
    $kode_pengumuman = $_REQUEST['inputkode'];
  } else {
?> <h1>Anda Harus Mengisi Data</h1>
<?php
    die("anda harus memasukkan datanya");
  }
  header("location:pengumumaninput.php");
}
//untuk menampilkan data pada form edit

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Daftar pengumuman</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
ob_start();
session_start();
if (!isset($_SESSION['emailuser']))
  header("location:login.php");
?>
<?php include "header.php"; ?>

<div class="container-fluid">
  <div class="card shadow mb-4">

    <body>

      <div class="row">
        <div class="col-sm-1">
        </div>

        <div class="col-sm-10">

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Edit Data pengumuman </h1>
            </div>
          </div>
          <!--penutup jumbotron-->

          <form method="POST" name='f1' enctype="multipart/form-data">
            <div class="form-group row">
              <label for="kode_pengumuman" class="col-sm-2 col-form-label">Kode pengumuman</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputkode" id="suppplierid" readonly value="<?php echo $rowedit["kode_pengumuman"] ?>" maxlength="6" required="">
              </div>
            </div>

            <div class="form-group row">
              <label for="judul_pengumuman" class="col-sm-2 col-form-label">judul pengumuman</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputjudul" id="judul_pengumuman" value="<?php echo $rowedit["judul_pengumuman"] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_pengumuman" class="col-sm-2 col-form-label">Nomor Telepon</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="inputtanggal" id="tanggal_pengumuman" value="<?php echo $rowedit["tanggal_pengumuman"] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="isi_pengumuman" class="col-sm-2 col-form-label">isi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputisi" id="isi_pengumuman" value="<?php echo $rowedit["isi_pengumuman"] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="file" class="col-sm-2 col-form-label">Upload .pdf</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="file" id="file" style="height:auto">
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

      </div>
      <!--penutup class row-->

      <div class="col-sm-1">
      </div>


      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Daftar pengumuman </h1>
        </div>
      </div>
      <!--penutup jumbotron-->

      <form method="POST">
        <div class="form-group row mb-2">
          <label for="search" class="col-sm-3">judul pengumuman</label>
          <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                        echo $_POST['search'];
                                                                                      } ?>" placeholder="Cari judul pengumuman">
          </div>
          <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
        </div>
      </form>

      <table class="table table success">
        <thead class="thead-dark">
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>judul</th>
            <th>Tanggal</th>
            <th>isi</th>
            <th colspan="2" style="text-align: center">Action</th>
            <th>Preview</th>
          </tr>
        </thead>

        <tbody>
          <?php
          if (isset($_POST["kirim"])) {
            $search = $_POST['search'];
            $query = mysqli_query($connection, "select * from pengumuman
        where judul_pengumuman like '%" . $search . "%'");
          } else {
            $query = mysqli_query($connection, "select * from pengumuman");
          }
          $nomor = 1;
          while ($row = mysqli_fetch_array($query)) { ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $row['kode_pengumuman']; ?></td>
              <td><?php echo $row['judul_pengumuman']; ?></td>
              <td><?php echo $row['tanggal_pengumuman']; ?></td>
              <td><?php echo $row['isi_pengumuman']; ?></td>
              <!-- untuk icon edit dan delete -->

              <td>
                <a href="pengumumanedit.php?ubah=<?php echo $row["kode_pengumuman"] ?>" class="btn btn-success btn-sm" title="Edit">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
              </td>

              <td>
                <a href="pengumumanhapus.php?hapus=<?php echo $row["kode_pengumuman"] ?>" class="btn btn-danger btn-sm" title="Delete">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </a>
              </td>
              <td>
                <?php if ($row['filePdf'] != "") {

                ?>
                  <a href="<?= $dir . "/" . $row['filePdf'] ?>" target="_blank" class="btn btn-primary btn-sm" title="View">
                    <?= $row['filePdf']; ?>
                  </a>
                <?php } else {
                  echo "-";
                } ?>
              </td>
              <!-- akhir icon edit delete -->
            </tr>
            <?php $nomor = $nomor + 1; ?>
          <?php } ?>
        </tbody>

      </table>

  </div>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script type=" text/javascript" src="js/bootstrap.min.js"></script>
  <script type=" text/javascript">
    $(".preview").click(function() {
      $('.frame-preview').toggle();
    })
  </script>
  </body>
  <!--penutup container fluid-->
</div>
</div>
<?php include "footer.php"; ?>
<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>