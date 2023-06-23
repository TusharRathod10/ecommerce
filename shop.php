<?php

include('../config/db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .one1 :hover,
        .one1:active {
            background-color: yellow !important;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <?php include('config/topbar.php')?>

    <!-- Topbar End -->


    <!-- Navbar -->
    <?php include('config/header.php') ?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">SubCategory</span></h5>
                <?php $getcat = mysqli_query($con, "SELECT * FROM category");
                $getsub = mysqli_query($con, "SELECT * FROM subcategory");
                while ($row = mysqli_fetch_assoc($getcat)) { ?>
                    <div class="bg-light p-4 mb-30">
                        <form method="post">
                            <div class="mb-3">
                                <a href="?cat=<?php echo $row['categories']; ?>">
                                    <i class="fa fa-arrow-right" style="color: black; margin-right:5px;"></i><label style="color: black;"><?php echo $row['categories']; ?></label></a>
                                <div class="custom-control  mb-3">
                                    <?php foreach ($getsub as $row1) {
                                        if ($row["id"] == $row1["cat_id"]) { ?>
                                            <a class='badge border text-decoration-none' href="shop.php?sub=<?php echo $row1['title']; ?>"><?php echo $row1['title'];
                                                                                                                                            echo "<br>"; ?></a>
                                    <?php }
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="mb-4">
                            <!-- <div class="ml-2 d-flex align-items-center justify-content-between ">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="shop.php" <?php $getproduct = mysqli_query($con, "SELECT * FROM product ORDER BY `id` DESC"); ?>>Latest</a>
                                        <a class="dropdown-item" href="shop.php"><?php $getproduct = mysqli_query($con, "SELECT * FROM product ORDER BY `id` ASC"); ?>Oldest</a>
                                        <a class="dropdown-item" href="#"><?php $getproduct = mysqli_query($con, "SELECT * FROM product ORDER BY `price` DESC"); ?>High Price</a>
                                        <a class="dropdown-item" href="#"><?php $getproduct = mysqli_query($con, "SELECT * FROM product ORDER BY `price` ASC"); ?>Low Price</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <?php if (isset($_GET['cat'])) {
                        $category = $_GET['cat'];
                        $getQuery = "SELECT *FROM product WHERE `category`='$category'";
                        $result = mysqli_query($con, $getQuery);
                    } elseif (isset($_GET['sub'])) {
                        $subcategory = $_GET['sub'];
                        $getQuery = "SELECT *FROM product WHERE `subcategory`='$subcategory'";
                        $result = mysqli_query($con, $getQuery);
                    } else {
                        $limit = 9;

                        $getproduct = mysqli_query($con, "SELECT * FROM product");
                        $total_rows = mysqli_num_rows($getproduct);
                        $total_pages = ceil($total_rows / $limit);

                        if (!isset($_GET['page'])) {

                            $page = 1;
                        } else {

                            $page = $_GET['page'];
                        }
                        $initial_page = ($page - 1) * $limit;
                        $getQuery = "SELECT *FROM product LIMIT " . $initial_page . ',' . $limit;
                        $result = mysqli_query($con, $getQuery);
                    }

                    while ($row2 = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden"> <?php
                                                                                            $img = explode(',', $row2['image']);
                                                                                            for ($i = 0; $i < count($img); $i++) {
                                                                                            ?> <img src="../assets/products/<?php echo $img[$i] ?>" alt="" height="400px" width="100%"><?php } ?>
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="detail.php?id=<?php echo $row2['id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""><?php echo $row2['title']; ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>₹<?php $price = $row2['price'] - ($row2['price'] * ($row2['discount'] / 100));
                                                echo intval($price); ?></h5>
                                        <h6 class="text-muted ml-2"><del>₹<?php echo $row2['price'] ?></del></h6>
                                        <h6 class="text-muted ml-2" style="font-size: 12px;"><?php echo $row2['discount']; ?>% OFF</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <?php for ($i = 0; $i < rand(2, 5); $i++) { ?>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        <?php } ?>
                                        <small>(<?php echo rand(50, 150) ?>)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ((!isset($_GET['sub'])) && (!isset($_GET['cat']))) { ?>
                        <div class="col-12">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item mx-2"><?php if ($page >= 2) { ?><a class="page-link" href="shop.php?page=<?php echo ($page - 1); ?>">Previous</span></a><?php } else {
                                                                                                                                                                                    'disabled';
                                                                                                                                                                                } ?></li>
                                    <?php for ($page1 = 1; $page1 <= $total_pages; $page1++) { ?>
                                        <li class="page-item mx-2 one1"><a class="page-link " href="shop.php?page=<?php echo $page1; ?>"><?php echo $page1; ?></a></li>
                                        <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                                    <?php  }  ?>
                                    <li class="page-item mx-2"><?php if ($page < $total_pages) { ?><a class="page-link" href="shop.php?page=<?php echo ($page + 1); ?>">Next</span></a><?php } ?></li>
                                </ul>
                            </nav>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <?php include('config/footer.php') ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>