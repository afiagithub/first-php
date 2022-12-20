<?php include "inc/header.php"; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage All Posts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Posts</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">

              <div class="card-header">
                <h3 class="card-title">Manage All Posts</h3>                
              </div><!-- /.card-header -->

              <div class="card-body">
                <?php

                  if (isset($_GET['do'])) {
                    $do = $_GET['do'];
                  }
                  else
                  {
                    $do = 'manage';
                  }

                  if ($do == 'manage'){?>
                      <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                              <th scope="col">SL.</th>
                              <th scope="col">Title</th>
                              <th scope="col">Thumbnail</th>
                              <th scope="col">Category</th>
                              <th scope="col">Author Name</th>
                              <th scope="col">Status</th>
                              <th scope="col">Publish Date</th>
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                          <?php

                            $sql = "SELECT * FROM post ORDER BY id DESC";

                            $allPosts = mysqli_query($db, $sql);

                            $countPost = mysqli_num_rows($allPosts);

                            if( $countPost == 0 ){
                              echo '

                              <tr>
                                <div class="alert alert-info">Sorry!!! No post found in the database...</div>
                              </tr>

                              ';
                            }
                            else{ 
                              $i=0;
                              while($row = mysqli_fetch_assoc($allPosts)){
                                $pid           = $row['id'];
                                $title        = $row['title'];
                                $description  = $row['description'];
                                $image        = $row['image'];
                                $category_id  = $row['category_id'];
                                $author_id    = $row['author_id'];
                                $tags         = $row['tags'];
                                $status       = $row['status'];
                                $p_date       = $row['p_date'];
                                $i++;
                              

                              ?>

                              <tr>
                                  <th scope="row"><?php echo $i; ?></th>
                                  <th scope="row"><?php echo $title; ?></th>
                                  <td>
                                    <?php
                                        if( is_null($image) )
                                          { ?>
                                            <img src="dist/img/posts/avatar.png" class="pro-picture">

                                          <?php
                                          }
                                          else{?>
                                            <img src="dist/img/posts/<?php echo $image; ?>" class="pro-picture">

                                          <?php
                                          }                                          

                                    ?>
                                  </td>                                
                                  <td>
                                    <?php
                                        $allCat = explode(",", $category_id);
                                        foreach ($allCat as $catid ) {
                                            $sql2 = "SELECT * FROM categories WHERE id = '$catid'";
                                            $catName = mysqli_query($db, $sql2);

                                            while ($row = mysqli_fetch_assoc($catName)) {
                                                $id = $row['id'];
                                                $cat_title = $row['cat_title'];
                                                ?>

                                                <span><?php echo $cat_title . ' '; ?></span>

                                            <?php
                                            }
                                        }
                                    ?>
                                      
                                  </td>
                                  <td>
                                    <?php
                                      $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                      $authName = mysqli_query($db, $sql);

                                      while ($row = mysqli_fetch_array($authName)) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        echo $name;
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
                                  <td><?php echo $p_date; ?></td>
                                  <td>
                                    <div class="action-bar">
                                      <ul>
                                        <li>
                                          <a href="post.php?do=edit&id=<?php echo $pid; ?>"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li>
                                          <a href="" data-toggle="modal" data-target="#deletePost<?php echo $pid; ?>"><i class="fa fa-trash"></i></a>
                                        </li>
                                      </ul>
                                    </div>
                          <!-- User delete Modal -->
                          <div class="modal fade" id="deletePost<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this post?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-center">
                                  <div class="modal-action-btn">
                                    <a href="post.php?do=delete&id=<?php echo $pid; ?>" class="btn btn-danger">Confirm</a>
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
                  
                  elseif($do == 'add'){?>
                    <?php

                      if(!empty($_SESSION['msg'])){
                        echo "<div class='alert alert-danger'> " . $_SESSION['msg'] . "</div>";
                        unset($_SESSION['msg']);
                      }

                    ?> 

                    <form action="post.php?do=store" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required="required">
                          </div>
                          
                          <div class="form-group">
                            <label>Meta Tags [Separate each tags with a comma (,) ]</label>
                            <input type="text" name="tags" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                              <option value="1">Please Select the User Status</option>
                              <option value="0">Inactive</option>
                              <option value="1">Active</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Image / Thumbnail Picture</label>
                            <input type="file" name="image" class="form-control-file">
                          </div>

                        </div>

                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Category / Sub-category</label>
                            <!-- category_id -->
                              <?php

                                $sql = "SELECT * FROM categories WHERE status = 1 AND is_parent = 0 ORDER BY cat_title ASC";
                                $priCat = mysqli_query($db, $sql);

                                while ($row = mysqli_fetch_assoc($priCat)) {
                                  $pid = $row['id'];
                                  $pricat_title = $row['cat_title'];
                                  ?>

                                  <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="category_id[]" value="<?php echo $pid; ?>"> 
                                    <label class="form-check-label"><?php echo $pricat_title; ?></label>
                                  </div>

                                  <?php

                                    $sql2 = "SELECT * FROM categories WHERE status = 1 AND is_parent = '$pid' ORDER BY cat_title ASC";
                                    $subCat = mysqli_query($db, $sql2);

                                    while ($row = mysqli_fetch_assoc($subCat)) {
                                    $sid = $row['id'];
                                    $subcat_title = $row['cat_title'];
                                    ?>
                                    <div class="form-group form-check" style="margin-left: 25px;">
                                      <input type="checkbox" class="form-check-input" name="category_id[]" value="<?php echo $sid; ?>"> 
                                      <label class="form-check-label"><?php echo $subcat_title; ?></label>
                                    </div>

                                    <?php
                                  }
                                }
                              ?>
                          </div>                          
                        </div>

                        <div class="col-lg-7">
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" placeholder="Write the post" rows="15"></textarea>
                          </div>

                        </div>

                        <div class="col-lg-5">                          
                          <div class="form-group">
                            <input type="submit" name="addPost" value="Publish New Post" class="btn btn-primary btn-block">
                          </div>
                        </div>
                      </div>
                    </form>

                    <?php
                  }


                  elseif($do == 'store'){
                    if(isset($_POST['addPost'])){
                      $category_id  = $_POST['category_id'];
                      $allCatID     = implode(",", $category_id);


                      $title        = mysqli_real_escape_string($db, $_POST['title']);;
                      
                      $author_id    = $_SESSION["id"];
                      $description  = mysqli_real_escape_string($db, $_POST['description']);
                      $status       = $_POST['status'];
                      $tags         = mysqli_real_escape_string($db, $_POST['tags']);
                      $image        = $_FILES['image']['name'];
                      $imageTmp     = $_FILES['image']['tmp_name'];
                      $imageSize    = $_FILES['image']['size'];
                      $imageType    = $_FILES['image']['type'];


                      if(!empty($image)){
                        //add user With image
                        $img_extension = strtolower(end(explode('.', $image)));

                        $def_extens = array("jpeg", "jpg", "png");

                        if( in_array($img_extension, $def_extens) === true && $imageSize <= 2097152){
                          //Change img file name
                          $img = rand(1,9999999). '-img'. $image;

                          //Move the img from the temp folder to our project folder
                          move_uploaded_file($imageTmp, "dist/img/posts/".$img);

                          $sql = "INSERT INTO post (title, description, category_id, author_id, tags, status, image, p_date) VALUES('$title', '$description', '$allCatID', '$author_id', '$tags', '$status', '$img', now())";
                          $addpost = mysqli_query($db, $sql);

                          if( $addpost )
                          {
                            header("Location: post.php?do=manage");
                          }
                          else{
                            die("Something went wrong!!".mysqli_error($db));
                          }
                        }
                        else{
                          $_SESSION['msg'] = "Something is wrong!";
                          header("Location: post.php?do=add");
                        }
                      }
                    }
                    
                  }


                  elseif($do == 'edit'){
                    
                    if(!empty($_SESSION['msg'])){
                      echo "<div class='alert alert-danger'> " . $_SESSION['msg'] . "</div>";
                      unset($_SESSION['msg']);
                    }                    

                    if (isset($_GET["id"])) {
                    $updateID = $_GET["id"];
                    //echo $updatePost;
                    
                    $sql = "SELECT * FROM post WHERE id = '$updateID'";
                    $postData = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_assoc($postData)){
                        $pid          = $row['id'];
                        $title        = $row['title'];
                        $description  = $row['description'];
                        $image        = $row['image'];
                        $category_id  = $row['category_id'];
                        $author_id    = $row['author_id'];
                        $tags         = $row['tags'];
                        $status       = $row['status'];
                        $p_date       = $row['p_date'];
                        ?>

                        <form action="post.php?do=update" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="postID" value="<?php echo $pid; ?>">
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required="required" value="<?php echo $title; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label>Meta Tags [Separate each tags with a comma (,) ]</label>
                                <input type="text" name="tags" class="form-control" value="<?php echo $tags; ?>">
                              </div>
                              <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                  <option value="1">Please Select the User Status</option>
                                  <option value="0" <?php if($status == 0) { echo 'selected'; }?> >Inactive</option>
                                  <option value="1" <?php if($status == 1) { echo 'selected'; }?> >Active</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <?php
                                    if( is_null($image) )
                                      { ?>
                                        <p>Not Uploaded</p>

                                      <?php
                                      }
                                      else{?>
                                        <img src="dist/img/posts/<?php echo $image; ?>" class="pro-picture">

                                      <?php
                                      }
                                ?>
                                <label>Image / Thumbnail Picture</label>
                                <input type="file" name="image" class="form-control-file">
                              </div>

                            </div>

                            <div class="col-lg-2">
                              <div class="form-group">
                                <label>Category / Sub-category</label>
                                <!-- category_id -->
                                  <?php

                                    $sql = "SELECT * FROM categories WHERE status = 1 AND is_parent = 0 ORDER BY cat_title ASC";
                                    $priCat = mysqli_query($db, $sql);

                                    while ($row = mysqli_fetch_assoc($priCat)) {
                                      $pid = $row['id'];
                                      $pricat_title = $row['cat_title'];
                                      ?>

                                      <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="category_id[]" value="<?php echo $pid; ?>"> 
                                        <label class="form-check-label"><?php echo $pricat_title; ?></label>
                                      </div>

                                      <?php

                                        $sql2 = "SELECT * FROM categories WHERE status = 1 AND is_parent = '$pid' ORDER BY cat_title ASC";
                                        $subCat = mysqli_query($db, $sql2);

                                        while ($row = mysqli_fetch_assoc($subCat)) {
                                        $sid = $row['id'];
                                        $subcat_title = $row['cat_title'];
                                        ?>
                                        <div class="form-group form-check" style="margin-left: 25px;">
                                          <input type="checkbox" class="form-check-input" name="category_id[]" value="<?php echo $sid; ?>"> 
                                          <label class="form-check-label"><?php echo $subcat_title; ?></label>
                                        </div>

                                        <?php
                                      }
                                    }
                                  ?>
                              </div>                          
                            </div>

                            <div class="col-lg-7">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="15"><?php echo $description; ?></textarea>
                              </div>

                            </div>

                            <div class="col-lg-5">                          
                              <div class="form-group">
                                <input type="submit" name="updatePost" value="Update Post" class="btn btn-primary btn-block">
                              </div>
                            </div>
                          </div>
                        </form>

                        <?php
                      }
                    }
                  }

                  elseif($do == 'update'){
                    if (isset($_POST["updatePost"])) {
                      $category_id  = $_POST['category_id'];
                      $allCatID     = implode(",", $category_id);


                      $postID       = $_POST['postID'];
                      $title        = mysqli_real_escape_string($db, $_POST['title']);;
                      
                      $author_id    = $_SESSION["id"];
                      $description  = mysqli_real_escape_string($db, $_POST['description']);
                      $status       = $_POST['status'];
                      $tags         = mysqli_real_escape_string($db, $_POST['tags']);
                      $image        = $_FILES['image']['name'];
                      $imageTmp     = $_FILES['image']['tmp_name'];
                      $imageSize    = $_FILES['image']['size'];
                      $imageType    = $_FILES['image']['type'];

                      if(!empty($image)){
                           // check for size and format
                            $img_extension = strtolower(end(explode('.', $image)));

                            $def_extens = array("jpeg", "jpg", "png");

                            if( in_array($img_extension, $def_extens) === true && $imageSize <= 2097152){
                              //Check and delete the old image
                              $query = "SELECT * FROM post WHERE id = '$postID'";
                              $readImage = mysqli_query($db, $query);

                              while($row = mysqli_fetch_assoc($readImage)){
                                $postImg = $row['image'];
                              }

                              //to delete any file fom the server 
                              unlink("dist/img/posts/". $postImg);
                              //Change img file name
                              $img = rand(1,9999999). '-img'. $image;

                              //Move the img from the temp folder to our project folder
                              move_uploaded_file($imageTmp, "dist/img/posts/".$img);

                              $sql = "UPDATE post SET title='$title', description='$description', image='$img', category_id='$allCatID', author_id='$author_id', tags= '$tags', status='$status'WHERE id = '$postID' ";

                              $updatePost = mysqli_query($db, $sql);

                              if ($updatePost) {
                                header("Location: post.php?do=manage");
                              }
                              else
                              {
                                die("Something went wrong ". mysqli_error($db));
                              }
                        }
                        else{
                          $_SESSION['msg'] = "Picture size or format is wrong (Format has to be either jpeg, jpg or png)!";
                          header("Location: post.php?do=edit&id=$postID");
                        }
                      }
                      else{
                        $sql = "UPDATE post SET title='$title', description='$description', category_id='$allCatID', author_id='$author_id', tags= '$tags', status='$status'WHERE id = '$postID' ";

                        $updatePost = mysqli_query($db, $sql);

                        if ($updatePost) {
                          header("Location: post.php?do=manage");
                        }
                        else
                        {
                          die("Something went wrong ". mysqli_error($db));
                        }
                      }
                    }
                    
                  }
                  elseif($do = 'delete'){
                    
                  }                     
                ?>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div><!-- /container-wrapper -->

<?php include "inc/footer.php"; ?>