<?php
  ob_start();
  include "inc/db.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>
  <body class="hold-transition register-page">

    <?php
      if (isset($_POST["register"])) {
          if ( !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["repassword"]) ){
            $name         =  mysqli_real_escape_string($db, $_POST["name"]);            
            $email        =  mysqli_real_escape_string($db, $_POST["email"]);
            $password     = mysqli_real_escape_string($db, $_POST["password"]);
            $repassword   = mysqli_real_escape_string($db, $_POST["repassword"]);

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $readUser = mysqli_query($db, $sql);

            $countUser = mysqli_num_rows($readUser);

            if ($countUser == 0) {
              if( $password == $repassword ){

                $passStrength = strlen($password);

                if($passStrength < 6){
                  $_SESSION["msg"] = "OOpps! Your password has to be atleast 6 characters.";
                }
                else{
                    $haspassed = sha1($password);

                  $sql = "INSERT INTO users(name, email, password, join_date) VALUES('$name', '$email', '$haspassed', now() )";
                  $regUser = mysqli_query($db, $sql);

                  if($regUser){
                    $_SESSION["success_msg"] = "We have registered your account succesfully";
                    //header("Location: register.php");
                  }
                }                
              }
              else{
                $_SESSION["msg"] = "Password doesn't match";
              }
            }
            else{
              $_SESSION["msg"] = "The user is already a member";
            }
        }
        else{
          $_SESSION["msg"] = "Your data is invalid";
        }
      }
    ?>


    <div class="register-box">
      <div class="register-logo">
        <a href="#"><b>Admin</b>LTE</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register a new membership</p>

          <?php

            if(!empty($_SESSION["msg"])){
              echo "<div class='alert alert-danger'> " . $_SESSION["msg"] . "</div>";
              unset($_SESSION["msg"]);
            }
            elseif(!empty($_SESSION["success_msg"])){
              echo "<div class='alert alert-success'> " . $_SESSION["success_msg"] . "</div>";
              unset($_SESSION["success_msg"]);
              header("refresh:3;url=index.php");
            }

          ?>

          <form action="" method="POST">
            <div class="input-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Full name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="repassword" class="form-control" placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                  <label for="agreeTerms">
                   I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <input type="submit" name="register" class="btn btn-primary btn-block" value="Register">
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google+
            </a>
          </div>

          <a href="index.php" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

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
