<!DOCTYPE html>

<?php
include "includes/config.php";
$role = $_GET['inputrole'];
$namaU = "nama_" . $role;


if (isset($_POST['simpan'])) {
  if (isset($_REQUEST['inputid'])) {
    $adminID = $_REQUEST['inputid'];
  }
  if (!empty($adminID)) {
    $adminID = $_REQUEST['inputid'];
  } else {
?> <h1>Anda Harus Mengisi Data</h1>
<?php
    die("anda harus memasukkan datanya");
  }

  $adminNAMA = $_POST['adminnama'];
  $adminEMAIL = $_POST['inputemail'];
  $adminPASSWORD = md5($_POST['inputpassword']);

  mysqli_query($connection, "insert into akun_user values('','$adminID','$adminNAMA','$adminEMAIL','$adminPASSWORD', '$role')");

  header("location:admininput.php?inputrole=admin");
}

$queryUser = mysqli_query($connection, "SELECT * FROM akun_user");

while ($akun = mysqli_fetch_assoc($queryUser)) {
  $checkNama[] = $akun['nama_user'];
  $checkEmail[] = $akun['email_user'];
}

if (isset($_GET['inputrole'])) {
  $query = mysqli_query($connection, "SELECT * FROM " . $_GET['inputrole'] . "");
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Daftar User</title>
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
              <h1 class="display-4">Input Daftar User</h1>
            </div>
          </div>
          <!--penutup jumbotron-->
          <form method="GET" id="roleForm">
            <div class="form-group row">
              <label for="admintelp" class="col-sm-2 col-form-label">Role</label>
              <div class="col-sm-10">

                <select class="form-control" required name="inputrole" id="role" onchange="submitRole()">
                  <option value="admin" <?= $_GET['inputrole'] == "admin" ? "selected" : ""; ?>>Admin</option>
                  <option value="siswa" <?= $_GET['inputrole'] == "siswa" ? "selected" : ""; ?>>Siswa</option>
                  <option value="guru" <?= $_GET['inputrole'] == "guru" ? "selected" : ""; ?>>Guru</option>
                  <option value="kepsek" <?= $_GET['inputrole'] == "kepsek" ? "selected" : ""; ?>>Kepala Sekolah</option>
                </select>
              </div>
            </div>
          </form>

          <form method="POST">
            <div class="form-group row">
              <label for="adminid" class="col-sm-2 col-form-label">ID User </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputid" id="adminid" placeholder="Input ID " maxlength="6" required="">
              </div>
            </div>

            <div class="form-group row">
              <label for="adminnama" class="col-sm-2 col-form-label">Nama User</label>
              <div class="col-sm-10">
                <select class="form-control" required name="adminnama" id="adminnama">
                  <option value="">Select...</option>
                  <?php while ($rownama = mysqli_fetch_assoc($query)) {
                    if (!in_array($rownama["$namaU"], $checkNama)) { ?>
                      <option value="<?= $rownama["$namaU"]; ?>"> <?= $rownama["$namaU"]; ?></option>
                    <?php } ?>

                  <?php } ?>

                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="adminalamat" class="col-sm-2 col-form-label">Email User</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="inputemail" id="inputemail" placeholder="Input email ">
              </div>
            </div>

            <div class="form-group row">
              <label for="admintelp" class="col-sm-2 col-form-label">Password </label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="inputpassword" id="admintelp" placeholder="Input Password ">
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
          <h1 class="display-4">Daftar User</h1>
        </div>
      </div>
      <!--penutup jumbotron-->

      <form method="POST">
        <div class="form-group row mb-2">
          <label for="search" class="col-sm-3">Nama User</label>
          <div class="col-sm-6">
            <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                        echo $_POST['search'];
                                                                                      } ?>" placeholder="Cari Nama User">
          </div>
          <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
        </div>
      </form>

      <table class="table table success">
        <thead class="thead-dark">
          <tr>
            <th>No</th>
            <th>ID </th>
            <th>Nama </th>
            <th>Email </th>
            <th>Role</th>
            <th colspan="2" style="text-align: center">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          if (isset($_POST["kirim"])) {
            $search = $_POST['search'];
            $query = mysqli_query($connection, "select * from akun_user
        where nama_user like '%" . $search . "%' order by kode_user asc");
          } else {
            $query = mysqli_query($connection, "select * from akun_user  order by kode_user asc");
          }
          $nomor = 1;
          while ($row = mysqli_fetch_array($query)) { ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $row['kode_user']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php echo $row['email_user']; ?></td>
              <td><?php echo $row['role_user']; ?></td>
              <!-- untuk icon edit dan delete -->
              <td>
                <a href="adminedit.php?ubah=<?php echo $row["id"] ?>" class="btn btn-success btn-sm" title="Edit">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
              </td>

              <td>
                <a href="adminhapus.php?hapus=<?php echo $row["id"] ?>" class="btn btn-danger btn-sm" title="Delete">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </a>
              </td>
              <!-- akhir icon edit delete -->
            </tr>
            <?php $nomor = $nomor + 1; ?>
          <?php } ?>
        </tbody>

      </table>

  </div>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    function submitRole() {
      $('#roleForm').submit();
    }
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