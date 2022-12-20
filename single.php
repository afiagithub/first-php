<?php 
    include "inc/header.php";
?>


    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Left Sidebar</li>
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

                <!-- Blog Single Posts -->
                <div class="col-md-8">

                    <?php

                        if(isset($_GET['id'])){
                            $postID = $_GET['id'];
                            //echo $postID;

                            $sql = "SELECT * FROM post WHERE id = '$postID'";
                            $thePost = mysqli_query($db, $sql);

                            while($row = mysqli_fetch_assoc($thePost)){
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

                                <div class="blog-single des">
                                    <!-- Blog Title -->
                                        <h3 class="post-title"><?php echo $title; ?></h3>

                                    <!-- Blog Categories -->
                                    <div class="single-categories">
                                    <?php
                                        $allCat = explode(",", $category_id);
                                        foreach ($allCat as $catid ) {
                                            $sql2 = "SELECT * FROM categories WHERE id = '$catid'";
                                            $catName = mysqli_query($db, $sql2);

                                            while ($row = mysqli_fetch_assoc($catName)) {
                                                $id = $row['id'];
                                                $cat_title = $row['cat_title'];
                                                ?>

                                                <a href="category.php?id=<?php echo $id; ?>"><span><?php echo $cat_title; ?></span></a>

                                            <?php
                                            }
                                        }
                                    ?>
                                        
                                    </div>
                                    
                                    <!-- Blog Thumbnail Image Start -->
                                    <div class="blog-banner">
                                        <a href="#">
                                            <img src="admin/dist/img/posts/<?php echo $image; ?>">
                                        </a>
                                    </div>
                                    <!-- Blog Thumbnail Image End -->

                                    <!-- Blog Description Start -->
                                    <p><?php echo $description; ?></p>
                                    
                                    <!-- Blog Description End -->
                                </div>

                                <?php
                            }
                        }


                    ?>

                    

                    <!-- Single Comment Section Start -->
                    <div class="single-comments" id="logIn">
                        <!-- Comment Heading Start -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4>All Latest Comments</h4>
                                <div class="title-border"></div>
                                <p>Comments Regarding <?php echo $title; ?></p>
                            </div>
                        </div>
                        <!-- Comment Heading End -->

                        <?php

                            $sql = "SELECT * FROM comments WHERE pid = '$pid' AND status = 1 ORDER BY id DESC";

                            $allComments = mysqli_query($db, $sql);
                            $countComments = mysqli_num_rows($allComments);

                            if($countComments == 0){
                                echo '<div class="alert alert-info">No Comments Found on this post yet</div>';
                            }

                            else{
                                while($row = mysqli_fetch_assoc($allComments)){
                                    $cid        = $row['id'];
                                    $pid        = $row['pid'];
                                    $uid        = $row['uid'];
                                    $comments   = $row['comments'];
                                    $status     = $row['status'];
                                    $post_date  = $row['post_date'];
                                    ?>

                                    <!-- Single Comment Post Start -->
                                    <div class="row each-comments">
                                        <?php
                                            $sql = "SELECT * FROM users WHERE id = '$uid'";
                                            $userName = mysqli_query($db, $sql);

                                            while ($row = mysqli_fetch_assoc($userName)) {
                                                $id = $row['id'];
                                                $uName = $row['name'];
                                                $image = $row['image'];
                                                ?>

                                            <div class="col-md-2">                                     
                                                <!-- Commented Person Thumbnail -->
                                                <div class="comments-person">
                                                    <?php

                                                        if(!empty($image)){
                                                        ?>
                                                            <img src="admin/dist/img/users/<?php echo $image; ?>">

                                                        <?php
                                                        }

                                                        else{
                                                        ?>

                                                            <img src="admin/dist/img/users/avatar.png">

                                                        <?php
                                                        }

                                                    ?>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-10 no-padding">
                                                <!-- Comment Box Start -->
                                                <div class="comment-box">
                                                    <div class="comment-box-header">
                                                        <ul>                                                        
                                                            <li class="post-by-name"><?php echo $uName; ?></li>
                                                        </ul>
                                                    </div>
                                                    <p><?php echo $comments; ?></p>
                                                </div>
                                                <!-- Comment Box End -->
                                            </div>


                                                <?php
                                            }
                                        ?>
                                        
                                    </div>
                                    <!-- Single Comment Post End -->

                                    <?php
                                }
                            }

                        ?>

                        <!-- Comment Reply Post Start -->
                        <div class="row each-comments">
                            <div class="col-md-2 offset-md-2">
                                <!-- Commented Person Thumbnail -->
                                <div class="comments-person">
                                    <img src="assets/images/corporate-team/team-2.jpg">
                                </div>
                            </div>

                            <div class="col-md-8 no-padding">
                                <!-- Comment Box Start -->
                                <div class="comment-box">
                                    <div class="comment-box-header">
                                        <ul>
                                            <li class="post-by-name">Someone Special</li>
                                            <li class="post-by-hour">20 Hours Ago</li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <!-- Comment Box Start -->
                            </div>
                        </div>
                        <!-- Comment Reply Post End -->
                    </div>
                    <!-- Single Comment Section End -->

                    <?php

                        if(empty($_SESSION["id"])){
                            echo '<div class="alert alert-info">Please log-in to post your comment</div>';
                            ?>

                            <!-- /*Login box Start*/ -->

                            <div class="post-comments">
                                <h4>Log-In</h4>
                                <div class="title-border"></div>                                
                                
                                <!-- Left Side Start -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Form Start -->
                                        <form action="" method="POST" class="contact-form">
                                            <!-- First Name Input Field -->
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email Address" class="form-input" autocomplete="off" required="required">
                                                <i class="fa fa-envelope-o"></i>
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="Enter your password" class="form-input" required="required">
                                                <i class="fa fa-user-o"></i>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" name="login" class="btn-main" value="Login">
                                            </div>
                                            <?php

                                                if(!empty($_SESSION["msg"])){
                                                    echo "<div class='alert alert-danger'> " . $_SESSION["msg"] . "</div>";
                                                    unset($_SESSION["msg"]);
                                                }

                                            ?>
                                        </form>
                                    </div>
                                    <!-- /*Login box End*/ -->

                                    <?php

                                    if (isset($_POST["login"])) {
                                        $email = mysqli_real_escape_string($db, $_POST["email"]);
                                        $password = mysqli_real_escape_string($db, $_POST["password"]);

                                        $haspassed = sha1($password);

                                        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$haspassed'";
                                        $authUser = mysqli_query($db, $sql);
                                        $countUser = mysqli_num_rows($authUser);

                                        if ($countUser == 0) {
                                          $_SESSION["msg"] = "Your email or password is invalid";
                                        }

                                        else{

                                            while ( $row = mysqli_fetch_array( $authUser ) ){
                                                $_SESSION["id"]           = $row['id'];
                                                $_SESSION["name"]         = $row['name'];
                                                $_SESSION["email"]        = $row['email'];
                                                $_SESSION["role"]         = $row['role'];

                                                if ($email == $_SESSION["email"] && $password == $haspassed)
                                                {
                                                  header("Location: index.php");
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
                                        }
                                    }


                                    ?>

                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                                <!-- Left Side End -->

                                    <!-- Right Side Start -->
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group">
                                                <input type="text" name="subject" placeholder="Subject" class="form-input" autocomplete="off" required="required">
                                                <i class="fa fa-diamond"></i>
                                            </div>
                                            
                                            <div class="form-group">
                                                <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                                <i class="fa fa-pencil-square-o"></i>
                                            </div>

                                            <button type="submit" class="btn-main"><i class="fa fa-paper-plane-o"></i> Post Your Comments</button>
                                        </div>
                                    </div> -->
                                    <!-- Right Side End -->
                                
                                <!-- Form End -->
                            </div>
                            

                            <?php
                        }

                        else{
                            ?>

                            <!-- Post New Comment Section Start -->
                            <div class="post-comments">
                                <h4>Post Your Comments</h4>
                                <div class="title-border"></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                <!-- Form Start -->
                                <form action="" method="POST" class="contact-form">
                                   
                                    <!-- Right Side Start -->
                                    <div class="row">
                                        <div class="col-md-12">                                            
                                            <!-- Comments Textarea Field -->
                                            <div class="form-group">
                                                <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                                <i class="fa fa-pencil-square-o"></i>
                                            </div>
                                            <!-- Post Comment Button -->
                                            <input type="submit" class="btn-main" name="postComment" value="Post Your Comments">

                                            <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                                        </div>
                                    </div>
                                    <!-- Right Side End -->
                                </form>
                                <!-- Form End -->

                                <?php

                                    if(isset($_POST['postComment'])){
                                        $comments = mysqli_real_escape_string($db, $_POST['comments']);
                                        $uid      = $_SESSION['id'];
                                        $pid      = $_POST['postID'];

                                        if( !empty($comments)){
                                            $sql = "INSERT INTO comments (pid, uid, comments, status, post_date) VALUES('$pid', '$uid', '$comments', 1, now())";

                                            $addPost = mysqli_query($db, $sql);

                                            if($addPost){
                                                header("Location: single.php?id=$pid");
                                            }

                                            else{
                                                die("Something went wrong...". mysqli_error($db));
                                            }
                                        }
                                    }

                                ?>


                            </div>
                            <!-- Post New Comment Section End --> 

                            <?php
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