<?php
    ob_start();
    include "admin/inc/db.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title> ব্লগ প্রজেক্ট - শিখবে সবাই </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">

    <!-- Theme Main Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    
  </head>

  <body>

    <!-- :::::::::: Header Section Start :::::::: -->
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="right-bar">
                            <a href="admin/index.php">লগইন <i class="fa fa-sign-in" aria-hidden="true"></i>
                            </a>
                            .
                            <a href="admin/register.php"> রেজিস্ট্রেশন <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu" id="sticker">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                          <a class="navbar-brand" href="index.php"><img src="assets/images/logo1.png"></a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <?php
                                    $query = "SELECT cat_name AS 'navCategoryName', cat_id AS 'navCategoryId' FROM category WHERE cat_status = 1 AND is_parent = 0";

                                    $result = mysqli_query($db, $query);

                                    while($row = mysqli_fetch_assoc($result)){
                                        extract($row);

                                        $subCategoryQuery = "SELECT cat_name AS 'navSubCatName', cat_id AS 'navSubCatId' FROM category WHERE is_parent = '$navCategoryId' AND cat_status = 1";

                                        $subCategoryResult = mysqli_query($db, $subCategoryQuery);

                                        $countSubCategory = mysqli_num_rows($subCategoryResult);
                                        ?>

                                    <?php
                                        if($countSubCategory==0){?>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="category.php?category=<?php echo $navCategoryName; ?>"><?php echo $navCategoryName; ?></a>
                                            </li>
                                        <?php }
                                        else{?>
                                             <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <?php echo $navCategoryName;?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php 
                                                    while($row = mysqli_fetch_assoc($subCategoryResult)){
                                                        extract($row);
                                                    ?>
                                                    <a class="dropdown-item" href="category.php?category=<?php echo str_replace(" ", "_", $navSubCatName); ?>"><?php echo $navSubCatName;?></a>
                                                    <?php }
                                                ?>
                                            </div>
                                    <?php } }
                                ?>
                            </ul>
                          </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ::::::::::: Header Section End ::::::::: -->