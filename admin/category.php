<?php include "inc/header.php"; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage All Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <!-- Left Side -->
            <div class="col-md-6">
              <?php
                  if (isset($_GET["delpid"])){
                    $delCat = $_GET["delpid"];
                    $sql = "DELETE FROM categories WHERE id = '$delCat'";
                    $removeCat = mysqli_query($db, $sql);

                    if ($removeCat) {
                      header("Location: category.php");
                    }
                    else
                    {
                      die("Something went wrong ". mysqli_error($db));
                    }
                  }
              ?>

              <?php
                  if (isset($_GET["delid"])){
                    $delCat = $_GET["delid"];
                    $sql = "DELETE FROM categories WHERE id = '$delCat'";
                    $removeCat = mysqli_query($db, $sql);

                    if ($removeCat) {
                      header("Location: category.php");
                    }
                    else
                    {
                      die("Something went wrong ". mysqli_error($db));
                    }
                  }
              ?>

              <?php
                if(isset($_GET['cid'])){
                  $cat_id = $_GET['cid'];
                  ?>
                    
                    <div class="card card-primary">

                      <div class="card-header">
                        <h3 class="card-title">Update Category/Subcategory</h3>                
                      </div><!-- /.card-header -->

                      <div class="card-body">
                        <?php
                          $sql = "SELECT * FROM categories WHERE id='$cat_id'";
                          $readData = mysqli_query($db, $sql);

                          while ($row = mysqli_fetch_array($readData)) {
                            $id           = $row['id'];
                            $cat_title    = $row['cat_title'];
                            $is_parent    = $row['is_parent'];
                            $description  = $row['description'];
                            $status       = $row['status'];
                            ?>

                            <!-- Update Category form Starts -->
                            <form action="" method="POST">
                              <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="cat_title" class="form-control" required="required" placeholder="Write down the category title" value="<?php echo $cat_title; ?>">
                              </div>

                              <div class="form-group">
                                <label>Parent Category [ is any (Optional) ]</label>
                                <select class="form-control" name="is_parent">
                                  <option>Please select the parent category</option>
          <?php
            $sql = "SELECT * FROM categories WHERE is_parent = 0 ORDER BY cat_title ASC";

            $parentCat = mysqli_query($db, $sql);

            while ($row = mysqli_fetch_assoc($parentCat)) {
              $pid = $row['id'];
              $cat_title = $row['cat_title']; ?>

              <option value="<?php echo $pid; ?>" <?php if( $pid == $is_parent) { echo 'selected'; } ?> >
                <?php echo $cat_title; ?></option>
            
            <?php
            }
          ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Description [ Optional ]</label>
                                <textarea class="form-control" rows="4" name="description" placeholder="Write Short description"><?php echo $description; ?></textarea>
                              </div>

                              <div class="form-group">
                                <label>Category / Subcategory Status</label>
                                <select class="form-control" name="status">
                  <option>Please select the status of the category</option>
                  <option value="1" <?php if($status == 1) { echo 'selected'; }?> >Active</option>
                  <option value="0" <?php if($status == 0) { echo 'selected'; }?> >Inactive</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <input type="submit" name="updateCat" class="btn btn-primary" value="Save Changes">
                              </div>
                            </form>
                            <!-- Update Category form end -->

                            <?php
                          }

                          //Update query
                          if (isset($_POST['updateCat'])) {
                            $cat_title    = $_POST['cat_title'];
                            $is_parent    = $_POST['is_parent'];
                            $description  = $_POST['description'];
                            $status       = $_POST['status'];

                            $sql = "UPDATE categories SET cat_title = '$cat_title', is_parent = '$is_parent', description = '$description', status = '$status' WHERE id = '$cat_id'";

                            $updateCategory = mysqli_query($db, $sql);

                            if( $updateCategory ){
                              header("Location: category.php");
                            }
                            else{
                              die("Something went wrong". mysqli_error($db));
                            }
                          }
                        ?>
                      </div>

                  </div>

                <?php
                }

              ?>
              <!-- Add New Category Form -->
              <div class="card card-primary">

                  <div class="card-header">
                    <h3 class="card-title">Add New Category/Subcategory</h3>                
                  </div><!-- /.card-header -->

                  <div class="card-body">
                    <form action="" method="POST">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="cat_title" class="form-control" required="required" placeholder="Write down the category title">
                      </div>

                      <div class="form-group">
                        <label>Parent Category [ is any (Optional) ]</label>
                        <select class="form-control" name="is_parent">
                          <option>Please select the parent category</option>
                          <?php
                            $sql = "SELECT * FROM categories WHERE is_parent = 0 ORDER BY cat_title ASC";

                            $parentCat = mysqli_query($db, $sql);

                            while ($row = mysqli_fetch_assoc($parentCat)) {
                              $id = $row['id'];
                              $cat_title = $row['cat_title']; ?>

                              <option value="<?php echo $id; ?>"><?php echo $cat_title; ?></option>
                            
                            <?php
                            }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Description [ Optional ]</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Write Short description"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Category / Subcategory Status</label>
                        <select class="form-control" name="status">
                          <option>Please select the status of the category</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <input type="submit" name="addCat" class="btn btn-primary" value="Add New Category">
                      </div>
                    </form>
                    <!-- Add New Category form end -->

                    <?php

                      if (isset($_POST['addCat'])) {
                        $cat_title    = $_POST['cat_title'];
                        $is_parent    = $_POST['is_parent'];
                        $description  = $_POST['description'];
                        $status       = $_POST['status'];

                        $sql = "INSERT INTO categories(cat_title, is_parent, description, status) VALUES('$cat_title', '$is_parent', '$description', '$status')";

                        $addCategory = mysqli_query($db, $sql);

                        if( $addCategory ){
                          header("Location: category.php");
                        }
                        else{
                          die("Something went wrong". mysqli_error($db));
                        }
                      }
                    ?>
                  </div>

              </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-6">
              <div class="card card-primary">

                <div class="card-header">
                  <h3 class="card-title">Manage All Category</h3>                
                </div><!-- /.card-header -->

                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead class="table-info">
                        <tr>
                          <th scope="col">#Sl No.</th>
                          <th scope="col">Title</th>
                          <th scope="col">Parent Category</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                      <?php
                        $sql = "SELECT * FROM categories WHERE is_parent = 0 ORDER BY cat_title ASC";

                        $allCat = mysqli_query($db, $sql);
                        $i = 0;

                        while ($row = mysqli_fetch_assoc($allCat)) {
                            $id = $row['id'];
                            $cat_title = $row['cat_title'];
                            $is_parent = $row['is_parent'];
                            $description = $row['description'];
                            $status = $row['status'];
                            $i++;
                          ?>

                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td><?php echo $cat_title; ?></td>
                              <td>
                                <?php
                                  if ($is_parent == 0) {
                                     echo '<span class="badge badge-primary">Parent Category</span>';
                                   } 
                                ?>                                   
                              </td>

                              <td>
                                <?php 
                                    if($status == 0){
                                      echo '<span class="badge badge-danger">Inactive</span>';
                                    }
                                    else if($status == 1){
                                      echo '<span class="badge badge-success">Active</span>';
                                    }
                                    else{
                                      echo '<span class="badge badge-danger">Inactive</span>';
                                    }
                                ?>
                                
                              </td>
                              <td>
                                <div class="action-bar">
                                  <ul>
                                    <li>
                                      <a href="category.php?cid=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
                                    </li>
                                    <li>
                                      <a href="" data-toggle="modal" data-target="#deletepCat<?php echo $id; ?>"><i class="fa fa-trash"></i></a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="modal fade" id="deletepCat<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this category?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <div class="modal-action-btn">
                                          <a href="category.php?delpid=<?php echo $id; ?>" class="btn btn-danger">Confirm</a>
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

                          //Sub Category Listing
                          $sql2 = "SELECT * FROM categories WHERE is_parent = '$id'";

                          $subCat = mysqli_query($db, $sql2);

                          while ($row = mysqli_fetch_assoc($subCat)) {
                              $id = $row['id'];
                              $cat_title = $row['cat_title'];
                              $is_parent = $row['is_parent'];
                              $description = $row['description'];
                              $status = $row['status'];
                              $i++;
                            ?>

                              <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td>-- <?php echo $cat_title; ?></td>
                                <td>
                                  <?php
                                    if ($is_parent == 0) {
                                       echo '<span class="badge badge-primary">Parent Category</span>';
                                     } 
                                  ?>                                   
                                </td>

                                <td>
                                  <?php 
                                      if($status == 0){
                                        echo '<span class="badge badge-danger">Inactive</span>';
                                      }
                                      else if($status == 1){
                                        echo '<span class="badge badge-success">Active</span>';
                                      }
                                      else{
                                        echo '<span class="badge badge-danger">Inactive</span>';
                                      }
                                  ?>
                                  
                                </td>
                                <td>
                                  <div class="action-bar">
                                    <ul>
                                      <li>
                                        <a href="category.php?cid=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
                                      </li>
                                      <li>
                                        <a href="" data-toggle="modal" data-target="#deleteCat<?php echo $id; ?>"><i class="fa fa-trash"></i></a>
                                      </li>
                                    </ul>
                                  </div>
                                  <!-- User delete Modal -->
                  <div class="modal fade" id="deleteCat<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this category?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body text-center">
                          <div class="modal-action-btn">
                            <a href="category.php?delid=<?php echo $id; ?>" class="btn btn-danger">Confirm</a>
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
                </div>

              </div>

            </div>
            
        </div>
      </div>
    </div>
    </section>
  </div><!-- /container-wrapper -->

<?php include "inc/footer.php"; ?>