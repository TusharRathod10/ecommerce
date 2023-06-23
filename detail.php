<?php

include('../config/db.php');

if (isset($_POST['submit_review'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $rating = $_POST['rating'];
        $login_mail = $_SESSION['admin']['email'];
        $contact = mysqli_query($con, "INSERT INTO review(`name`,`email`,`message`,`rating`,`login_mail`) VALUES('$name','$email','$message','$rating','$login_mail')");
    } else {
        header('location:../html/auth-login-basic.php');
    }
}

if (isset($_POST['addtocart'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $login_mail = $_SESSION['admin']['email'];
        $pro_name = $_POST['pro_name'];
        $pro_price = $_POST['pro_price'];
        $pro_discount = $_POST['pro_discount'];
        $pro_image = $_POST['pro_image'];
        $quantity = 1;

        $getcart = mysqli_query($con, "SELECT * FROM cart WHERE `pro_name`='$pro_name'");
        if (mysqli_num_rows($getcart) > 0) {
            while ($row = mysqli_fetch_assoc($getcart)) {
                $get_qty = $row['quantity'];
            }
            $get_qty++;
            $qty_update = mysqli_query($con,"UPDATE `cart` SET `quantity`='$get_qty' WHERE `pro_name`='$pro_name'");
            if ($qty_update) {
                header('location:cart.php');
            }
        } else {
            $message = "Product Added To Cart Successfully.";
            $addtocart = mysqli_query($con, "INSERT INTO cart(`login_mail`,`pro_name`,`pro_price`,`pro_discount`,`pro_image`,`quantity`) VALUES('$login_mail','$pro_name','$pro_price','$pro_discount','$pro_image','$quantity')");
            header('location:cart.php');
        }
    } else {
        header('location:../html/auth-login-basic.php');
    }
}
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
    <link href="css/style1.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include('config/topbar.php') ?>

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
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $getQuery =  mysqli_query($con, "SELECT *FROM product WHERE `id`='$id'");
                while ($row2 = mysqli_fetch_assoc($getQuery)) { ?>
                    <div class="col-lg-5 mb-30">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner bg-light">
                                <div class="carousel-item active">

                                    <?php
                                    $img = explode(',', $row2['image']);
                                    for ($i = 0; $i < count($img); $i++) {
                                    ?> <img src="../assets/products/<?php echo $img[$i] ?>" alt="" class="w-100 h-100"><?php }
                                                                                                                        ?>
                                </div>
                            </div>
                            <!-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> -->
                        </div>
                    </div>

                    <div class="col-lg-7 h-auto mb-30">
                        <div class="h-100 bg-light p-30">
                            <h3><?php echo $row2['title'] ?></h3>
                            <div class="d-flex mb-3">
                                <div class="text-primary mr-2">
                                    <?php for ($i = 0; $i < rand(2, 5); $i++) { ?>
                                        <small class="fas fa-star"></small>
                                    <?php } ?>
                                </div>
                                <small class="pt-1">(<?php echo rand(50, 150) . ' Reviews' ?>)</small>
                            </div>
                            <div class="d-flex align-items-center  mt-2">
                                <h3>₹<?php $price = $row2['price'] - ($row2['price'] * ($row2['discount'] / 100));
                                        echo intval($price); ?></h3>
                                <h6 class="text-muted ml-2"><del>₹<?php echo $row2['price'] ?></del></h6>
                                <h6 class="text-muted ml-2" style="font-size: 12px;"><?php echo $row2['discount']; ?>% OFF</h6>
                            </div>
                            <p class="mb-4"><?php echo $row2['description']; ?></p>
                            <form action="" method="post">
                                <div class="d-flex align-items-center mb-4 pt-2">
                                    <input type="hidden" name="pro_name" value="<?php echo $row2['title']; ?>">
                                    <input type="hidden" name="pro_price" value="<?php echo $row2['price']; ?>">
                                    <input type="hidden" name="pro_discount" value="<?php echo $row2['discount']; ?>">
                                    <input type="hidden" name="pro_image" value="<?php
                                                                                    $img = explode(',', $row2['image']);
                                                                                    for ($i = 0; $i < count($img); $i++) {
                                                                                        echo $img[$i];
                                                                                    } ?>">
                                    <button class="btn btn-primary px-3" type="submit" style="border-radius: 5px;" value="addtocart" name="addtocart"><i class="fa fa-shopping-cart mr-1"></i>Add To
                                        Cart</button>&nbsp;&nbsp;
                                </div>
                            </form>
                            <div class="d-flex pt-2">
                                <strong class="text-dark mr-2">Share on:</strong>
                                <div class="d-inline-flex">
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a class="text-dark px-2" href="">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div>Facere, distinctio, consectetur illo ullam officia eum vero vitae a commodi harum cum perferendis ducimus delectus? Inventore hic, accusamus rerum perferendis deleniti iure tenetur doloribus optio modi quisquam iste numquam.</div>
                            <div> Iste minima ex velit autem vero delectus optio ullam, esse veniam cupiditate voluptatum nisi assumenda quidem expedita commodi odit corporis aliquid vel ea necessitatibus doloribus unde recusandae? Nostrum illo minus optio porro consectetur incidunt similique voluptas, possimus esse dolorem pariatur. Animi dolor nobis voluptate quae asperiores, dolorem ab accusamus veritatis excepturi.</div>
                        </div>
                    </div>
                <?php } ?>
        </div>

        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews <?php $get_review = mysqli_query($con, "SELECT * FROM review");
                                                                                                            $count = mysqli_num_rows($get_review);
                                                                                                            echo $count; ?></a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6"><?php if (isset($_GET['id'])) {
                                                            $id = $_GET['id'];
                                                            $getQuery =  mysqli_query($con, "SELECT *FROM product WHERE `id`='$id'");
                                                            while ($row2 = mysqli_fetch_assoc($getQuery)) { ?>
                                            <h4 class="mb-4">Review For - <?php echo $row2['title'];
                                                                        }
                                                                    } ?></h4>
                                            <?php $select = mysqli_query($con, "SELECT * FROM review ORDER BY RAND() LIMIT 3");
                                            while ($reviews = mysqli_fetch_assoc($select)) { ?>
                                                <div class="media mb-4">
                                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                    <div class="media-body">
                                                        <h6><?php echo $reviews['name'] ?></small></h6>
                                                        <div class="text-primary mb-2">
                                                            <?php echo $reviews['rating'] . ' Star'; ?>
                                                        </div>
                                                        <p><?php echo $reviews['message']; ?></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="message">Your Review</label>
                                            <textarea id="message" cols="30" rows="5" name="message" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="email" class="form-control" name="email" id="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Your Rating</label>
                                            <input type="number" class="form-control" id="rating" min="1" max="5" name="rating" required>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="submit_review" name="submit_review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else {
                echo '<div> <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">No Result Found</span></h2>
                <h6 class="position-relative text-uppercase mx-xl-5 mb-4"><a href="shop.php">Go To Shoping</a></h6></div>';
            } ?>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <?php $latest = mysqli_query($con, "SELECT * FROM product ORDER BY RAND() LIMIT 6"); ?>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php while ($row3 = mysqli_fetch_assoc($latest)) { ?>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <?php
                            $img = explode(',', $row3['image']);
                            for ($i = 0; $i < count($img); $i++) {
                            ?> <img src="../assets/products/<?php echo $img[$i] ?>" alt="" height="400px" width="90%"><?php } ?>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="detail.php?id=<?php echo $row3['id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href=""><?php echo $row3['title']; ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>₹<?php $price = $row3['price'] - ($row3['price'] * ($row3['discount'] / 100));
                                        echo intval($price); ?></h5>
                                <h6 class="text-muted ml-2"><del>₹<?php echo $row3['price'] ?></del></h6>
                                <h6 class="text-muted ml-2" style="font-size: 12px;"><?php echo $row3['discount']; ?>% OFF</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <?php for ($i = 0; $i < rand(2, 5); $i++) { ?>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                <?php } ?>
                                <small>(<?php echo rand(50, 150) ?>)</small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->


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