<?php 

    include "inc/header.php";

?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">

                    <?php
                        if(isset($_GET['id'])){
                            $catID = $_GET['id'];
                            //echo $postID;

                            $sql = "SELECT * FROM post WHERE status= 1 AND category_id LIKE '%$catID%' ORDER BY id DESC";
                            $allPost = mysqli_query($db, $sql);
                            $countAllPost = mysqli_num_rows($allPost);

                            if($countAllPost == 0){
                                ?>

                                <div class="alert alert-warning" role="alert">
                                  No post on this Category...
                                </div>

                                <?php
                            }

                            else{
                                while($row = mysqli_fetch_assoc($allPost)){

                                    $pid          = $row['id'];
                                    $p_title        = $row['title'];
                                    $description  = $row['description'];
                                    $image        = $row['image'];
                                    $category_id  = $row['category_id'];
                                    $author_id    = $row['author_id'];
                                    $tags         = $row['tags'];
                                    $status       = $row['status'];
                                    $p_date       = $row['p_date'];
                                    ?>

                                    <!-- Single Item Blog Post Start -->
                                    <div class="blog-post">
                                        <!-- Blog Banner Image -->
                                        <div class="blog-banner">
                                            <a href="single.php?id=<?php echo $pid; ?>">
                                                <?php
                                                if(!empty($image)){
                                                    ?>
                                                        <img src="admin/dist/img/posts/<?php echo $image; ?>" >

                                                    <?php
                                                }

                                                ?>
                                                
                                                
                                                <!-- Post Category Names -->
                                                <div class="blog-category-name">
                                                    <h6>
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

                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="single.php?id=<?php echo $pid; ?>">
                                                <h3 class="post-title"><?php echo $p_title; ?></h3>
                                            </a>
                                            <p><?php echo substr($description, 0, 200); ?></p>


                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i><?php echo $p_date; ?></li>
                                                            <li><i class="fa fa-user"></i>
                                                                <?php
                                                                  $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                                                  $authName = mysqli_query($db, $sql);

                                                                  while ($row = mysqli_fetch_array($authName)) {
                                                                    $id = $row['id'];
                                                                    $name = $row['name'];
                                                                    echo $name;
                                                                  }

                                                                ?>
                                                            </li>
                                                            <li><i class="fa fa-heart"></i>(50)</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 read-more-btn">
                                                    <button type="button" class="btn-main">
                                                        <a href="single.php?id=<?php echo $pid; ?>">Read More <i class="fa fa-angle-double-right"></i></a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Item Blog Post End -->                                

                                    <?php
                                }
                            }
                            
                            
                        }
                        
                    ?>
              
                </div>


            <?php
                include "inc/sidebar.php";
            ?>
                
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    


<?php
    include "inc/footer.php";
?>    