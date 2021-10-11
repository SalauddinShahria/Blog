<div class="col-md-4">

    <!-- Search Bar Start -->
    <div class="widget"> 
            <!-- Search Bar -->
            <h4> সার্চ করুন </h4>
            <div class="title-border"></div>
            <div class="search-bar">
                <!-- Search Form Start -->
                <form action="search.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input" required="required">
                        <i class="fa fa-paper-plane-o"></i>
                        <input type="submit" name="searchbtn" value="Search" class="btn-main">
                    </div>
                </form>
                <!-- Search Form End -->
            </div>
    </div>
    <!-- Search Bar End -->

    <!-- Latest News -->
    <div class="widget">
        <h4> সবচেয়ে বেশি পঠিত </h4>
        <div class="title-border"></div>
        
        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">

            <?php
                $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 5";
                $latestNews = mysqli_query($db, $sql);

                while ($row = mysqli_fetch_assoc($latestNews)) {
                    $post_id             = $row['post_id'];
                    $title          = $row['title'];
                    $description    = mysqli_real_escape_string($db, $row['description']);
                    $image          = $row['image'];
                    $category_id    = $row['category_id'];
                    $author_id      = $row['author_id'];
                    $status         = $row['status'];
                    $meta           = $row['meta'];
                    $post_date      = $row['post_date'];
                    ?>

                    <div class="item">
                        <div class="latest-news">
                            <!-- Latest News Slider Image -->
                            <div class="latest-news-image">
                                <a href="single.php?post=<?php echo $post_id; ?>">
                                    <img src="admin/img/post/<?php echo $image;?>">
                                </a>
                            </div>
                            <!-- Latest News Slider Heading -->
                            <h5><a href="single.php?post=<?php echo $post_id; ?>"><?php echo $title; ?></a></h5>
                            <!-- Latest News Slider Paragraph -->
                            <p><?php echo substr($description, 0, 175); ?></p>
                        </div>
                    </div>
                    <!-- First Latest News End -->

                <?php }
            ?>
        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>
    <!-- Latest New End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4> নতুন পোস্ট </h4>
        <div class="title-border"></div>
        <div class="recent-post">

            <?php
                $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 6";
                $latestNews = mysqli_query($db, $sql);

                while ($row = mysqli_fetch_assoc($latestNews)) {
                    $post_id             = $row['post_id'];
                    $title          = $row['title'];
                    $description    = mysqli_real_escape_string($db, $row['description']);
                    $image          = $row['image'];
                    $category_id    = $row['category_id'];
                    $author_id      = $row['author_id'];
                    $status         = $row['status'];
                    $meta           = $row['meta'];
                    $post_date      = $row['post_date'];
                    ?>


                    <!-- Recent Post Item Content Start -->
                    <div class="recent-post-item">
                        <div class="row">
                            <!-- Item Image -->
                            <div class="col-md-4">
                                <a href="single.php?post=<?php echo $post_id; ?>"><img src="admin/img/post/<?php echo $image;?>"></a>
                            </div>
                            <!-- Item Tite -->
                            <div class="col-md-8 no-padding">
                                <h5><a href="single.php?post=<?php echo $post_id; ?>"><?php echo $title; ?></a></h5>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i><h5><?php echo $post_date; ?></h5></li>
                                    <li><i class="fa fa-comment-o"></i>15</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Post Item Content End -->

            <?php    }

            ?>

        </div>
    </div>

    <!-- All Category -->
    <div class="widget">
        <h4> ব্লগ ক্যাটাগরি </h4>
        <div class="title-border"></div>
        <!-- Blog Category Start -->

        <?php
            $query = "SELECT * FROM category WHERE is_parent = 0";
            $catSidbar = mysqli_query($db, $query);

            while( $row = mysqli_fetch_assoc($catSidbar)){
                $cat_id         = $row['cat_id'];
                $cat_name       = $row['cat_name'];

                $query = "SELECT * FROM post WHERE category_id = '$cat_id'";
                $result = mysqli_query($db, $query);
                $catSidbarCount = mysqli_num_rows($result);                 

                ?>

        <div class="blog-categories">
            <ul>
                <!-- Category Item -->
                <li>
                    <i class="fa fa-check"></i>
                    <a href="category.php?category=<?php echo $cat_name; ?>"><?php echo $cat_name; ?> </a>
                    <span>[<?php echo $catSidbarCount; ?>]</span>
                </li>
            </ul>
        </div>
        <!-- Blog Category End -->

            <?php }                
        ?>        
    </div>

    <!-- Recent Comments -->
    <div class="widget">
        <h4> নতুন মন্তব্য সমূহ </h4>
        <div class="title-border"></div>
        <div class="recent-comments">
            
            <?php
                $sql = "SELECT * FROM comments WHERE cmt_status = 1 ORDER BY cmt_id DESC LIMIT 6";
                $readSidbarComments = mysqli_query($db, $sql);

                while($row = mysqli_fetch_assoc($readSidbarComments)){
                    $cmt_id             = $row['cmt_id'];
                    $cmt_desc           = $row['cmt_desc']; 
                    $cmt_post_id        = $row['cmt_post_id']; 
                    $cmt_author         = $row['cmt_author']; 
                    $cmt_author_email   = $row['cmt_author_email']; 
                    $cmt_status         = $row['cmt_status']; 
                    $cmt_date           = $row['cmt_date'];
                    ?>

                    <!-- Recent Comments Item Start -->
                    <div class="recent-comments-item">
                        <div class="row">
                            <!-- Comments Thumbnails -->
                            <div class="col-md-4">
                                <i class="fa fa-comments-o"></i>
                            </div>
                            <!-- Comments Content -->
                            <div class="col-md-8 no-padding">
                                <a href="single.php?post=<?php echo $cmt_post_id;?>"><h5><?php echo $cmt_desc; ?></h5></a>
                                <!-- Comments Date -->
                                <ul>
                                    <li>
                                        <i class="fa fa-clock-o"></i><?php echo $cmt_date; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Comments Item End -->

                <?php }
            ?>


        </div>
    </div>

    <!-- Meta Tag -->
    <div class="widget">
        <h4> টেগ সমূহ </h4>
        <div class="title-border"></div>
        <!-- Meta Tag List Start -->
        <div class="meta-tags">

            <?php
                $sql = "SELECT * FROM post LIMIT 14";
                $allPosts = mysqli_query($db, $sql);

                while($row = (mysqli_fetch_assoc($allPosts))){
                    $post_id    = $row['post_id'];
                    $meta       = $row['meta'];
                    $tags = explode(' ', trim($meta));

                    foreach ($tags as $tag) {?>
                        <a href="search.php?meta=<?php echo $tag; ?>"><span><?php echo $tag; ?></span></a>
                    <?php }
                }
            ?>
        <!-- Meta Tag List End -->
    </div>
    
</div>