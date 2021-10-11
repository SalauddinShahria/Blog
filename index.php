<?php
    include "inc/header.php";
?>
 
<?php
    include "inc/headerpage.php";
?>



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">

                    <?php
                        $sql = "SELECT * FROM post WHERE status = 1 ORDER BY post_id DESC";
                        $allPost = mysqli_query($db, $sql);

                        $total_page = mysqli_num_rows($allPost);

                            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                            $num_result_per_page = 5;

                            if($stmt = $db->prepare('SELECT * FROM post ORDER BY post_id DESC LIMIT ?,?')){

                                $cal_page = ($page - 1) * $num_result_per_page;
                                $stmt->bind_param('ii', $cal_page, $num_result_per_page);
                                $stmt->execute();
                                $result = $stmt->get_result();      
                            }

                        while( $row = mysqli_fetch_assoc($result) ){
                            $post_id        = $row['post_id'];
                            $title          = $row['title'];
                            $description    = $row['description'];
                            $image          = $row['image'];
                            $category_id    = $row['category_id'];
                            $author_id      = $row['author_id'];
                            $status         = $row['status'];
                            $meta           = $row['meta'];
                            $post_date      = $row['post_date'];
                            ?>

                            <!-- Single Item Blog Post Start -->
                            <div class="blog-post">
                                <!-- Blog Banner Image -->
                                <div class="blog-banner">
                                    <a href="single.php?post=<?php echo $post_id; ?>">
                                        <img src="admin/img/post/<?php echo $image; ?>">
                                        <!-- Post Category Names -->
                                        <div class="blog-category-name">
                                             <?php
                                                $sql = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                                $readCat = mysqli_query($db, $sql);

                                                while( $row = mysqli_fetch_assoc($readCat) ){
                                                  $cat_id   = $row['cat_id'];
                                                  $cat_name = $row['cat_name'];
                                                  ?>
                                                  <h6><?php echo $cat_name; ?></h6>
                                                <?php }
                                              ?>
                                        </div>
                                    </a>
                                </div>
                                <!-- Blog Title and Description -->
                                <div class="blog-description">
                                    <a href="single.php?post=<?php echo $post_id; ?>">
                                        <h3 class="post-title"><?php echo $title; ?></h3>
                                    </a>
                                    <p><?php echo substr($description, 0, 600) . "..."; ?></p>
                                    <!-- Blog Info, Date and Author -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="blog-info">
                                                <ul>
                                                    <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                                    <li>
                                                         <?php
                                                            $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                                            $readUser = mysqli_query($db, $sql);
                                                            while( $row = mysqli_fetch_assoc($readUser) ){
                                                              $id   = $row['id'];
                                                              $name = $row['name'];
                                                            }
                                                          ?>
                                                        <i class="fa fa-user"> Posted by - <?php echo $name; ?></i>
                                                    </li>
                                                    <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4 read-more-btn">
                                            <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main"> আরো দেখুন <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Item Blog Post End -->
                        <?php } ?>
                            <!-- Blog Paginetion Design Start -->
                            <?php if( ceil($total_page / $num_result_per_page ) > 0 ) : ?>
                                <div class="paginetion">
                                    <ul>
                                        <!-- Next Button -->
                                        <?php if( $page > 1 ) : ?>    
                                            <li class="blog-prev">
                                                <a href="index.php?page=<?php echo $page - 1; ?>"><i class="fa fa-long-arrow-left"></i>  Previous</a>
                                            </li>
                                        <?php else: ?>
                                             <li class="blog-prev disabled">
                                                <a href=""><i class="fa fa-long-arrow-left"></i>  Previous</a>
                                            </li>
                                        <?php endif; ?>


                                        <?php if($page-2 > 0) : ?>
                                            <li>
                                                <a href="index.php?page=<?php echo $page-2; ?>"><?php echo $page-2; ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($page-1 > 0) : ?>
                                            <li>
                                                <a href="index.php?page=<?php echo $page-1; ?>"><?php echo $page-1; ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <li class="active"><a href="<?php echo $page; ?>"><?php echo $page; ?></a></li>

                                        <?php if($page+1 < ceil($total_page / $num_result_per_page) + 1) : ?>
                                            <li>
                                                <a href="index.php?page=<?php echo $page+1; ?>"><?php echo $page+1; ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($page+2 < ceil($total_page / $num_result_per_page) + 2) : ?>
                                            <li>
                                                <a href="index.php?page=<?php echo $page+2; ?>"><?php echo $page+2; ?></a>
                                            </li>
                                        <?php endif; ?>

                                        <!-- Previous Button -->
                                        <?php if ( $page < ceil($total_page / $num_result_per_page)) : ?>
                                            <li class="blog-next">
                                                <a href="index.php?page=<?php echo $page + 1; ?>"> Next <i class="fa fa-long-arrow-right"></i></a>
                                            </li>
                                        <?php else : ?>
                                            <li class="blog-next disabled">
                                                <a href="index.php?page=<?php echo $page + 1; ?>"> Next <i class="fa fa-long-arrow-right"></i></a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            <?php endif;?>
                                <!-- Blog Paginetion Design End -->
               
                </div>



                <!-- Blog Right Sidebar -->
                <?php
                    include "inc/sidebar.php";
                ?>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->


    <!-- :::::::::: Footer Section Start :::::::: -->
<?php
    include "inc/footer.php";
?>