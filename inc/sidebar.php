<!-- Blog Right Sidebar -->
<div class="col-md-4">

    <!-- Latest News -->
    <div class="widget">
        <h4>Latest News</h4>
        <div class="title-border"></div>
        
        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">
            <?php

                $sql = "SELECT * FROM post WHERE status= 1 ORDER BY id DESC LIMIT 4";
                $sliderPost = mysqli_query($db, $sql);
                $countPost = mysqli_num_rows($sliderPost);

                if($countPost == 0){

                }
                else{
                    while($row = mysqli_fetch_assoc($sliderPost)){
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

                        <!-- First Latest News Start -->
                        <div class="item">
                            <div class="latest-news">
                                <!-- Latest News Slider Image -->
                                <div class="latest-news-image">
                                    <a href="single.php?id=<?php echo $pid; ?>">
                                    <?php
                                        if(!empty($image)){
                                            ?>
                                                <img src="admin/dist/img/posts/<?php echo $image; ?>" >

                                            <?php
                                        }

                                    ?>
                                    </a>
                                </div>
                                <!-- Latest News Slider Heading -->
                                <h5><?php echo $title; ?></h5>
                                <!-- Latest News Slider Paragraph -->
                                <p><?php echo substr($description, 0, 150); ?></p>
                            </div>
                        </div>
                        <!-- First Latest News End -->
                        <?php
                    }
                }


            ?>
            
        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>


    <!-- Search Bar Start -->
    <div class="widget"> 
            <!-- Search Bar -->
            <h4>Blog Search</h4>
            <div class="title-border"></div>
            <div class="search-bar">
                <!-- Search Form Start -->
                <form action="search.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                        <i class="fa fa-paper-plane-o"></i>
                    </div>
                </form>
                <!-- Search Form End -->
            </div>
    </div>
    <!-- Search Bar End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4>Recent Posts</h4>
        <div class="title-border"></div>
        <div class="recent-post">
            <?php

                $sql = "SELECT * FROM post WHERE status= 1 ORDER BY id DESC LIMIT 4";
                $recentPost = mysqli_query($db, $sql);
                $countPost = mysqli_num_rows($recentPost);

                if($countPost == 0){

                }
                else{
                    while($row = mysqli_fetch_assoc($recentPost)){
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

                        <!-- Recent Post Item Content Start -->
                        <div class="recent-post-item">
                            <div class="row">
                                <!-- Item Image -->
                                <div class="col-md-4">
                                    <a href="single.php?p=<?php echo $pid; ?>">
                                    <?php
                                        if(!empty($image)){
                                            ?>
                                                <img src="admin/dist/img/posts/<?php echo $image; ?>" >

                                            <?php
                                        }

                                    ?>
                                    </a>
                                </div>
                                <!-- Item Tite -->
                                <div class="col-md-8 no-padding">
                                    <h5><a href="single.php?id=<?php echo $pid; ?>">
                                        <?php echo $title; ?></a></h5>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i><?php echo $p_date; ?></li>
                                        <li><i class="fa fa-comment-o"></i>15</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Post Item Content End -->
                        
                        <?php
                    }
                }
            ?>
        </div>
    </div>

    <!-- All Category -->
    <div class="widget">
        <h4>Blog Categories</h4>
        <div class="title-border"></div>
        <!-- Blog Category Start -->
        <div class="blog-categories">
            <ul>
                <?php
                    $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY cat_title ASC";
                    $allCat = mysqli_query($db, $sql);

                    while ($row = mysqli_fetch_assoc($allCat)) {
                        $id = $row['id'];
                        $cat_title = $row['cat_title'];
                        ?>
                        <!-- Category Item -->
                        <li>
                            <a href="category.php?id=<?php echo $id; ?>"><i class="fa fa-check"></i>
                            <?php echo $cat_title; ?></a> 

                            <?php
                                $sql2 = "SELECT * FROM post WHERE category_id = '$id'";
                                $numOfPost = mysqli_query($db, $sql2);
                                $totalPost = mysqli_num_rows($numOfPost);


                            ?>
                            <span>[<?php echo $totalPost; ?>]</span>
                        </li>

                        <?php
                    }

                ?>
                
            </ul>
        </div>
        <!-- Blog Category End -->
    </div>

    <!-- Recent Comments -->
    <div class="widget">
        <h4>Recent Comments</h4>
        <div class="title-border"></div>
        <div class="recent-comments">
            
            <!-- Recent Comments Item Start -->
            <div class="recent-comments-item">
                <div class="row">
                    <!-- Comments Thumbnails -->
                    <div class="col-md-4">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <!-- Comments Content -->
                    <div class="col-md-8 no-padding">
                        <h5>admin on blog posts</h5>
                        <!-- Comments Date -->
                        <ul>
                            <li>
                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Recent Comments Item End -->

            <!-- Recent Comments Item Start -->
            <div class="recent-comments-item">
                <div class="row">
                    <!-- Comments Thumbnails -->
                    <div class="col-md-4">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <!-- Comments Content -->
                    <div class="col-md-8 no-padding">
                        <h5>admin on blog posts</h5>
                        <!-- Comments Date -->
                        <ul>
                            <li>
                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Recent Comments Item End -->

            <!-- Recent Comments Item Start -->
            <div class="recent-comments-item">
                <div class="row">
                    <!-- Comments Thumbnails -->
                    <div class="col-md-4">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <!-- Comments Content -->
                    <div class="col-md-8 no-padding">
                        <h5>admin on blog posts</h5>
                        <!-- Comments Date -->
                        <ul>
                            <li>
                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Recent Comments Item End -->

        </div>
    </div>

    <!-- Meta Tag -->
    <div class="widget">
        <h4>Tags</h4>
        <div class="title-border"></div>
        <!-- Meta Tag List Start -->
        <div class="meta-tags">

            <?php 
                $sql = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC";
                $allTags = mysqli_query($db, $sql);
                while( $row = mysqli_fetch_assoc($allTags) ){
                    $tags = $row['tags'];

                    // STR to ARRAY
                    $eachTags = explode(',', trim($tags));
                    
                    foreach( $eachTags as $tag ){
                            
                            ?>
                                <span><a href="search.php?s=<?php echo $tag; ?>"><?php echo trim($tag); ?></a></span>
                            <?php 
                        
                                                               
                    }
                }

            ?>

            

            
        </div>
        <!-- Meta Tag List End -->
    </div>

</div>
<!-- Right Sidebar End -->