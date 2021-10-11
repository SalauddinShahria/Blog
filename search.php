
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
                        if(isset($_POST['searchbtn'])){
                            $searchContent = $_POST['search'];
                            
                            $sql = "SELECT * FROM post WHERE title LIKE '%$searchContent%' OR description LIKE '%$searchContent%' ORDER BY post_id DESC";

                            $searchCat = mysqli_query($db, $sql);

                            $searchCount = mysqli_num_rows($searchCat);

                            if($searchCount == 0){ ?>
                                <h3 class="alert alert-warning">Your search result for - '<?php echo $searchContent; ?>'. <br> Total post found - <?php echo $searchCount; ?>.</h3>
                                <!-- <div class="alert alert-warning">Opps!!! No Post Found according your search result...</div> -->
                            <?php }
                            else{
                                while( $row = mysqli_fetch_assoc($searchCat) ){
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

                                <h3 class="alert alert-warning">Your search result for - '<?php echo $searchContent; ?>'. <br> Total post found - <?php echo $searchCount; ?>.</h3>

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
                                        <p><?php echo substr($description, 0, 250) . "..."; ?></p>
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
                                                <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Item Blog Post End -->
                                <?php }
                            }
                        }
                        else if(isset($_GET['meta'])){
                            $searchMeta =$_GET['meta'];
                            
                            $sql = "SELECT * FROM post WHERE title LIKE '%$searchMeta%' OR description LIKE '%$searchMeta%' OR meta LIKE '%$searchMeta%' ORDER BY post_id DESC";

                            $searchCat = mysqli_query($db, $sql);

                            $searchCount = mysqli_num_rows($searchCat);

                            if($searchCount == 0){ ?>
                                <h3 class="alert alert-warning">Your search result for - '<?php echo $searchMeta; ?>'. <br> Total post found - <?php echo $searchCount; ?>.</h3>
                                <!-- <div class="alert alert-warning">Opps!!! No Post Found according your search result...</div> -->
                            <?php }
                            else{
                                while( $row = mysqli_fetch_assoc($searchCat) ){
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

                                <h3 class="alert alert-warning">Your search result for - '<?php echo $searchMeta; ?>'. <br> Total post found - <?php echo $searchMeta; ?>.</h3>

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
                                        <p><?php echo substr($description, 0, 250) . "..."; ?></p>
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
                                                <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Item Blog Post End -->
                                <?php }
                            }
                        }
                    ?>

                    <!-- Blog Paginetion Design End -->               
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
   