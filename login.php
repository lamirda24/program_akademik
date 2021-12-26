<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include "includes/config.php";
    ob_start();
    session_start();

    if (isset($_POST["submitlogin"])) {
        $emailuser = $_POST["useremail"];
        $passuser = MD5($_POST["pass"]);
        $sql_login = mysqli_query($connection, "SELECT * FROM akun_user WHERE email_user = '$emailuser' AND password_user = '$passuser'");

        if (mysqli_num_rows($sql_login) > 0) {

            $user = mysqli_fetch_assoc($sql_login);
            $role =  $user['role_user'];

            $query = mysqli_query($connection, "SELECT * FROM $role WHERE email_$role = '$emailuser'");
            $akun = mysqli_fetch_assoc($query);


            $_SESSION['kodeuser'] = $akun['kode_' . $role . ''];
            $_SESSION['namauser'] = $akun['nama_' . $role . ''];
            $_SESSION['emailuser'] = $akun['email_' . $role . ''];
            $_SESSION['role'] = $role;


            header("location:index.php");
        } else { ?>
            <script>
                alert("Password atau email salah!")
                <?php
                header("location:login.php");

                ?>
            </script>
    <?php die;
        }
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMA BUDI AGUNG Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="background-image: url('img/logo 3.jpeg');">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <img class="col-lg-6 d-none d-lg-block bg-login-image" src="img/logo 2.jpg">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="useremail" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>

                                        <!--    <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->

                                        <input type="submit" name="submitlogin" class="btn btn-primary btn-user btn-block" value="Login">

                                        <a class="btn btn-primary btn-user btn-block" href="forget.php">Forget Password</a>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

<?php
mysqli_close($connection);
ob_end_flush();
?>

</html>