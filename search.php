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

                        if(isset($_GET['s'])){
                            $searchContent = $_GET['s'];

                            $sql = "SELECT * FROM post WHERE title LIKE '%$searchContent%' OR description LIKE '%$searchContent%' OR tags LIKE '%$searchContent%' ORDER BY id DESC";
                            $readPost = mysqli_query($db, $sql);

                            $numberOfPost = mysqli_num_rows($readPost);

                            if($numberOfPost == 0){
                                echo '<div class="alert alert-info">Sorry! No post found based on you search keyword <strong>'. $searchContent .'</strong></div>';
                            }
                            else{
                                while($row = mysqli_fetch_assoc($readPost)){
                                    $pid           = $row['id'];
                                    $title        = $row['title'];
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
                                            <a href="single.php?p=<?php echo $pid; ?>">
                                                <?php
                                                if(!empty($image)){
                                                    ?>
                                                        <img src="admin/dist/img/posts/<?php echo $image; ?>" >

                                                    <?php
                                                }

                                                ?>
                                                
                                                
                                                <!-- Post Category Names -->
                                                <div class="blog-category-name">
                                                    <h6>Technology</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="#">
                                                <h3 class="post-title"><?php echo $title; ?></h3>
                                            </a>
                                            <p><?php echo substr($description, 0, 200); ?></p>


                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i>7th Nov, 2018</li>
                                                            <li><i class="fa fa-user"></i>by - admin</li>
                                                            <li><i class="fa fa-heart"></i>(50)</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 read-more-btn">
                                                    <button type="button" class="btn-main">
                                                        <a href="single.php?p=<?php echo $pid; ?>">Read More <i class="fa fa-angle-double-right"></i></a></button>
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


                    <?php

                        if(isset($_POST['search'])){
                            $searchContent = mysqli_real_escape_string($db, $_POST['search']);

                            $sql = "SELECT * FROM post WHERE title LIKE '%$searchContent%' OR description LIKE '%$searchContent%' OR tags LIKE '%$searchContent%' ORDER BY id DESC";
                            $readPost = mysqli_query($db, $sql);

                            $numberOfPost = mysqli_num_rows($readPost);

                            if($numberOfPost == 0){
                                echo '<div class="alert alert-info">Sorry! No post found based on you search keyword <strong>'. $searchContent .'</strong></div>';
                            }
                            else{
                                while($row = mysqli_fetch_assoc($readPost)){
                                    $pid           = $row['id'];
                                    $title        = $row['title'];
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
                                            <a href="single.php?p=<?php echo $pid; ?>">
                                                <?php
                                                if(!empty($image)){
                                                    ?>
                                                        <img src="admin/dist/img/posts/<?php echo $image; ?>" >

                                                    <?php
                                                }

                                                ?>
                                                
                                                
                                                <!-- Post Category Names -->
                                                <div class="blog-category-name">
                                                    <h6>Technology</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="#">
                                                <h3 class="post-title"><?php echo $title; ?></h3>
                                            </a>
                                            <p><?php echo substr($description, 0, 300); ?></p>


                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i>7th Nov, 2018</li>
                                                            <li><i class="fa fa-user"></i>by - admin</li>
                                                            <li><i class="fa fa-heart"></i>(50)</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 read-more-btn">
                                                    <button type="button" class="btn-main">
                                                        <a href="single.php?p=<?php echo $pid; ?>">Read More <i class="fa fa-angle-double-right"></i></a></button>
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

<?php
    include "inc/footer.php";
?>