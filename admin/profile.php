<?php include "inc/header.php"; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Your Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <!-- <?php
            echo $_SESSION['id'];
            ?> -->
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Manage All Users</h3>                
                  </div>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <?php

                      if (isset($_GET['do'])) {
                        $do = $_GET['do'];
                      }
                      else
                      {
                        $do = 'manage';
                      }

                      //$do = isset($_GET['do']) : $_GET['do'] ? 'manage';

                      if ($do == 'manage') {
                        ?>

                          <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                  <th scope="col">SL.</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email Address</th>
                                  <th scope="col">Phone No.</th>
                                  <th scope="col">Address</th>
                                  <th scope="col">User Role</th>
                                  <th scope="col">Account Status</th>
                                  <th scope="col">Join Date</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                              <?php
                              $id = $_SESSION['id'];

                                $sql = "SELECT * FROM users WHERE id = '$id'";

                                $allUsers = mysqli_query($db, $sql);

                                $countUser = mysqli_num_rows($allUsers);

                                if( $countUser == 0 ){
                                  echo '

                                  <tr>
                                    <div class="alert alert-info">Sorry!!! No user found in the database...</div>
                                  </tr>

                                  ';
                                }
                                else
                                { $i=0;
                                  while($row = mysqli_fetch_assoc($allUsers)){
                                    $id       = $row['id'];
                                    $name     = $row['name'];
                                    $e        = $row['email'];
                                    $password = $row['password'];
                                    $phone    = $row['phone'];
                                    $address  = $row['address'];
                                    $role     = $row['role'];
                                    $status   = $row['status'];
                                    $image    = $row['image'];
                                    $join_date = $row['join_date'];
                                    $i++;
                                  

                                  ?>

                                  <tr>
                                      <th scope="row"><?php echo $i; ?></th>
                                      <td>
                                        <?php
                                            if( is_null($image) )
                                              { ?>
                                                <img src="dist/img/users/avatar.png" class="pro-picture">

                                              <?php
                                              }
                                              else{?>
                                                <img src="dist/img/users/<?php echo $image; ?>" class="pro-picture">

                                              <?php
                                              }                                          

                                        ?>
                                      </td>                                
                                      <td><?php echo $name; ?></td>
                                      <td><?php echo $e; ?></td>
                                      <td><?php echo $phone; ?></td>
                                      <td><?php echo $address; ?></td>
                                      <td>
                                        <?php
                                          if($role == 1){
                                            echo '<span class="badge badge-success">Admin</span>';
                                          }
                                          elseif ($role == 2) {
                                            echo '<span class="badge badge-primary">Editor</span>';
                                          }
                                          elseif ($role == 3) {
                                            echo '<span class="badge badge-info">User</span>';
                                          }
                                          else
                                          {
                                            echo '<span class="badge badge-danger">Unidentified</span>';
                                          }

                                        ?>
                                          
                                      </td>
                                      <td>
                                        <?php
                                          if($status == 0){
                                            echo '<span class="badge badge-danger">Inactive</span>';
                                          }
                                          elseif ($status == 1) {
                                            echo '<span class="badge badge-success">Active</span>';
                                          }
                                          

                                        ?>                                      
                                      </td>
                                      <td><?php echo $join_date; ?></td>
                                      <td>
                                        <div class="action-bar">
                                          <ul>
                                            <li>
                                              <a href="profile.php?do=edit&id=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
                                            </li>
                                            <li>
                                              <a href="" data-toggle="modal" data-target="#deleteUser<?php echo $id; ?>"><i class="fa fa-trash"></i></a>
                                            </li>
                                          </ul>
                                        </div>
                  <!-- User delete Modal -->
                  <div class="modal fade" id="deleteUser<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this user?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-center">
                          <div class="modal-action-btn">
                            <a href="profile.php?do=delete&id=<?php echo $id; ?>" class="btn btn-danger">Confirm</a>
                            <a href="" data-dismiss="modal" class="btn btn-success">Cancel</a>
                          </div>
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" ><a href="">Confirm</a></button>
                          <button type="button" class="btn btn-success" data-dismiss="modal"><a href="">Cancel</a></button>
                        </div> -->
                      </div>
                    </div>
                  </div>
                                      </td>                               
                                    </tr>
                                    <?php
                                  }
                                }

                                ?>                     
                                
                            </tbody>
                          </table>

                        <?php
                      }


                      elseif ($do == 'edit') {?>
                        <?php

                          if(!empty($_SESSION['msg'])){
                            echo "<div class='alert alert-danger'> " . $_SESSION['msg'] . "</div>";
                            unset($_SESSION['msg']);
                          }

                        ?>
                        <?php
                        if (isset($_GET["id"])) {
                          $userID = $_GET["id"];
                          
                          $sql = "SELECT * FROM users WHERE id = '$userID'";
                          $userData = mysqli_query($db, $sql);

                          while($row = mysqli_fetch_assoc($userData)){
                              $uid       = $row['id'];
                              $name     = $row['name'];
                              $e        = $row['email'];
                              $password = $row['password'];
                              $phone    = $row['phone'];
                              $address  = $row['address'];
                              $role     = $row['role'];
                              $status   = $row['status'];
                              $image    = $row['image'];

                              ?>

                              <form action="profile.php?do=update" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="userId" value="<?php echo $uid; ?>">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label>Full Name</label>
                                      <input type="text" name="name" class="form-control" required="required" value="<?php echo $name; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Email Address</label>
                                      <input type="text" name="email" class="form-control" required="required" value="<?php echo $e; ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" name="password" class="form-control" placeholder="******">
                                    </div>
                                    <div class="form-group">
                                      <label>Re-Type Password</label>
                                      <input type="password" name="repassword" class="form-control" placeholder="******">
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label>Phone</label>
                                      <input type="phone" name="phone" class="form-control" value="<?php echo $phone; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Address</label>
                                      <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label>Role</label>
                                      <select name="role" class="form-control">
                                        <option value="3">Please Select the User Role</option>
                                        <option value="1" <?php if($role == 1 ){ echo 'selected'; } ?> >Admin</option>
                                        <option value="2" <?php if($role == 2 ){ echo 'selected'; } ?> >Editor</option>
                                        <option value="3" <?php if($role == 3 ){ echo 'selected'; } ?> >User</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Status</label>
                                      <select name="status" class="form-control">
                                        <option value="1">Please Select the User Status</option>
                                        <option value="0" <?php if($status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                                        <option value="1" <?php if($status == 1 ){ echo 'selected'; } ?> >Active</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label>Image / Profile Picture</label> <br>
                                      <?php
                                          if( is_null($image) )
                                            { ?>
                                              <img src="dist/img/users/avatar.png" class="pro-picture">

                                            <?php
                                            }
                                            else{?>
                                              <img src="dist/img/users/<?php echo $image; ?>" class="pro-picture">

                                            <?php
                                            }                                          

                                      ?>
                                      <br><br>
                                      <input type="file" name="image" class="form-control-file">
                                    </div>
                                    <div class="form-group">
                                      <input type="submit" name="updateUser" value="Save Changes" class="btn btn-primary btn-block">
                                    </div>
                                  </div>
                                </div>
                              </form>
                              
                              <?php      
                        }
                      }
                    }


                    elseif ($do == 'update') {
                      if (isset($_POST["updateUser"])) {
                        $userId          = $_POST['userId']; 
                        $name         = $_POST['name'];
                        $email        = $_POST['email'];
                        $password     = $_POST['password'];
                        $repassword   = $_POST['repassword'];
                        $phone        = $_POST['phone'];
                        $address      = $_POST['address'];
                        $role         = $_POST['role'];
                        $status       = $_POST['status'];

                        $image        = $_FILES['image']['name'];
                        $imageTmp     = $_FILES['image']['tmp_name'];
                        $imageSize    = $_FILES['image']['size'];
                        $imageType    = $_FILES['image']['type'];



                        //Just the profile content update
                        if ( empty($password) && empty($image) ) {                          
                          $sql = "UPDATE users SET name='$name', email = '$email', phone='$phone', address='$address', role='$role', status='$status' WHERE id = '$userId' ";

                          $updateUser = mysqli_query($db, $sql);

                          if ($updateUser) {
                            header("Location: profile.php?do=manage");
                          }
                          else
                          {
                            die("Something went wrong ". mysqli_error($db));
                          }
                        }

                        //Update content with password and image
                        else if( !empty($password) && !empty($image)){
                          if($password == $repassword){
                            $haspassed = sha1($password);

                            $img_extension = strtolower(end(explode('.', $image)));

                            $def_extens = array("jpeg", "jpg", "png");

                            if( in_array($img_extension, $def_extens) === true && $imageSize <= 2097152){
                              //Identify the existing image
                              $query = "SELECT * FROM users WHERE id = '$userId'";
                              $userImage = mysqli_query($db, $query);

                               while($row = mysqli_fetch_assoc($userImage)){
                                $userImg = $row['image'];
                               }

                               //to delete any file fom the server 
                               unlink("dist/img/users/". $userImg);

                                //add user With image
                                //Change img file name
                                $imgs = rand(1,9999999). '-img'. $image;

                                //Move the img from the temp folder to our project folder
                                move_uploaded_file($imageTmp, "dist/img/users/".$imgs);

                                $sql = "UPDATE users SET name='$name', email='$email', password = '$haspassed', phone='$phone', address='$address', role='$role', status='$status', image = '$imgs' WHERE id = '$userId' ";

                              $updateUser = mysqli_query($db, $sql);

                              if ($updateUser) {
                                header("Location: profile.php?do=manage");
                              }
                              else
                              {
                                die("Something went wrong ". mysqli_error($db));
                              }
                            }
                            else{
                                $_SESSION['msg'] = "Sorry! You've uploaded a wrong file as image OR the image size is too large.";
                                header("Location: profile.php?do=edit");
                              }
                          }

                          
                        }

                        //Update content without password and with image
                        else if( empty($password) && !empty($image)){
                            $img_extension = strtolower(end(explode('.', $image)));

                            $def_extens = array("jpeg", "jpg", "png");

                            if( in_array($img_extension, $def_extens) === true && $imageSize <= 2097152){
                              //Identify the existing image
                              $query = "SELECT * FROM users WHERE id = '$userId'";
                              $userImage = mysqli_query($db, $query);

                               while($row = mysqli_fetch_assoc($userImage)){
                                $userImg = $row['image'];
                               }

                               //to delete any file fom the server 
                               unlink("dist/img/users/". $userImg);

                                //add user With image
                                //Change img file name
                                $imgs = rand(1,9999999). '-img'. $image;

                                //Move the img from the temp folder to our project folder
                                move_uploaded_file($imageTmp, "dist/img/users/".$imgs);

                                $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', role='$role', status='$status', image = '$imgs' WHERE id = '$userId' ";

                              $updateUser = mysqli_query($db, $sql);

                              if ($updateUser) {
                                header("Location: profile.php?do=manage");
                              }
                              else
                              {
                                die("Something went wrong ". mysqli_error($db));
                              }
                            }
                            else{
                                $_SESSION['msg'] = "Sorry! You've uploaded a wrong file as image OR the image size is too large.";
                                header("Location: profile.php?do=edit");
                              }                            
                        }

                        //Update content with password and without image
                        else if( !empty($password) && empty($image)){
                            if($password == $repassword){
                              $haspassed = sha1($password);
                            }
                          
                            $sql = "UPDATE users SET name='$name', email='$email', password = '$haspassed', phone='$phone', address='$address', role='$role', status='$status' WHERE id = '$userId' ";

                            $updateUser = mysqli_query($db, $sql);

                            if ($updateUser) {
                              header("Location: profile.php?do=manage");
                            }
                            else
                            {
                              die("Something went wrong ". mysqli_error($db));
                            }
                        }
                      }
                    }


                    elseif ($do == 'delete') {
                      if (isset($_GET["id"])){
                        $delUser = $_GET["id"];
                        $sql1 = "DELETE FROM users WHERE id = '$delUser'";
                        $removeUser = mysqli_query($db, $sql1);

                        if ($removeUser) {
                          header("Location: profile.php?do=manage");
                        }
                        else
                        {
                          die("Something went wrong ". mysqli_error($db));
                        }
                      }
                    }


                  ?>
                  </div>
                  <!-- /.card-body -->
                </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include "inc/footer.php"; ?>