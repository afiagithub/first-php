<?php
  ob_start();
  include "inc/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <?php

    if (isset($_POST["login"])) {
      if ( !empty($_POST["email"]) && !empty($_POST["password"]) ) {
        $email      =  mysqli_real_escape_string($db, $_POST["email"]);
        $password   = mysqli_real_escape_string($db, $_POST["password"]);

        $haspassed = sha1($password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$haspassed'";
        $authUser = mysqli_query($db, $sql);

        $countUser = mysqli_num_rows($authUser);

        if ($countUser == 0) {
          $_SESSION["msg"] = "Your email or password is invalid";
        }

        else{

            while ( $row = mysqli_fetch_array( $authUser ) ) {
              $_SESSION["role"]           = $row['role'];

              if( $_SESSION["role"] == 1 || $_SESSION["role"] == 2 ){

                $_SESSION["id"]           = $row['id'];
                $_SESSION["name"]         = $row['name'];
                $_SESSION["email"]        = $row['email'];
                $password                 = $row['password'];
                $phone                    = $row['phone'];
                $address                  = $row['address'];                
                $status                   = $row['status'];
                $image                    = $row['image'];

                if ($email == $_SESSION["email"] && $password == $haspassed) {
                  header("Location: dashboard.php");
                }
                elseif($email != $_SESSION["email"] || $password != $haspassed){
                  $_SESSION["msg"] = "Your email is invalid";
                  header("Location: index.php");
                }
                else{
                  $_SESSION["msg"] = "Your email or password is invalid";
                  header("Location: index.php");
                }
              }
              else{
                $_SESSION["msg"] = "You have successfully logged in User but not allowed in the admin panel";
              }
          }
        }
        
      }
      else
      {
        $_SESSION["msg"] = "Your email or password is empty, Please fill them out...";

      }
    }

  ?>


  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php

          if(!empty($_SESSION["msg"])){
            echo "<div class='alert alert-danger'> " . $_SESSION["msg"] . "</div>";
            unset($_SESSION["msg"]);
          }

        ?>

        <form action="" method="POST">

          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div> -->
            <!-- /.col -->
            <div class="col-4">
              <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <?php
    ob_end_flush();
  ?>
</body>
</html>
