<?php

include('../config/db.php');

if (isset($_GET['order_id'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $order_id = $_GET['order_id'];
        $delete_order = mysqli_query($con, "DELETE FROM `order` WHERE `order_id`='$order_id'");  
        if ($delete_order) {
            header('location:index.php');   
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
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
                    <a class="breadcrumb-item active" href="myorder.php">My Order</a>
                    <a class="breadcrumb-item active" href="myorder.php?all=all">All Orders</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <?php $email = $_SESSION['admin']['email'];
    if (isset($_GET['all'])) {
        $getorder = mysqli_query($con, "SELECT * FROM `order` WHERE `email`='$email' ORDER BY `id` DESC");
    } else {
        $getorder = mysqli_query($con, "SELECT * FROM `order` WHERE `email`='$email' ORDER BY `id` DESC LIMIT 1");
    }
    while ($row = mysqli_fetch_assoc($getorder)) {
        if ($_SESSION['admin']['email'] == $row['email']) { ?>
            <div class="container mt-5 d-flex justify-content-center">
                <div class="p-4 mt-3" style="border:2px solid silver;border-radius: 5px; background-color: white; width: 800px;">
                    <p style="font-size: 25px; font-weight:600; text-decoration: underline; border: 2px dotted black; border-radius: 5px; padding: 5px;" class=" d-flex justify-content-center">My Order</p>
                    <div class="first d-flex justify-content-between align-items-center mb-3">
                        <div class="info">
                            <span class="d-block name mb-1">Thank you, <?php echo ucfirst($row['firstname']); ?></span>
                            <span class="order">Order Id - <?php echo $row['order_id']; ?></span><br>
                            <span class="order">Date : <?php echo $row['date']; ?></span>
                        </div>

                        <img src="https://i.imgur.com/NiAVkEw.png" width="70" />


                    </div>
                    <div class="detail">
                        <span class="d-block summery" style="font-size: 15px; color: black;">Your order has been dispatched. we are delivering you order.</span>
                    </div>
                    <hr>
                    <div class="info">
                        <?php
                        $img = explode(',', $row['image']);
                        for ($i = 0; $i < count($img); $i++) {
                        ?> <img src="../assets/products/<?php echo $img[$i] ?>" alt="" style="width: 100px;height: 100px; border: 1px solid black; padding: 5px;"><?php } ?>
                        <p class="mt-2" style="margin-bottom: 0; font-weight: 600; color: black;">Your Product Name :-
                            <span class="order ml-2" style="font-size: 15px; color: black;"><?php echo '[ ' . $row['total_product'] . ' ]'; ?></span><br>
                        </p>
                        <p class="mt-2" style="margin-bottom: 0; font-weight: 600; color: black;">Total Amount :-
                            <span class="order ml-2" style="font-size: 15px; color: black;"><?php echo '₹' . $row['total_price']; ?></span><br>
                        </p>
                        <p class="mt-2" style="margin-bottom: 0; font-weight: 600; color: black;">Shipping :-
                            <span class="order ml-2" style="font-size: 15px; color: black;"><?php echo '₹' . 40; ?></span>
                            <hr>
                        <p class="mt-2" style="margin-bottom: 0; font-size: 22px; font-weight: 600; color: black;">Total :-
                            <span class="order ml-2" style="font-size: 20px; color: black;"><?php echo '₹' . $row['total_price'] + 40; ?></span><br>
                    </div>
                    <hr>
                    <div class="text">
                        <span class="d-block mb-2" style="font-weight: 500; color: black;"><?php echo ucwords($row['firstname'] . ' ' . $row['lastname']); ?></span>
                    </div>
                    <div class="text">
                        <span class="d-block mb-2" style="font-weight: 500; color: black;"><?php echo $row['email']; ?></span>
                    </div>
                    <div class="text">
                        <span class="d-block mb-1" style="font-weight: 500; color: black;">Contact No : <?php echo $row['number']; ?></span>
                    </div>
                    <p class="mt-3" style="margin-bottom: 0; font-weight: 600; color: black;">Address :- </p>
                    <span class="my-2" style="margin-top: 0;"><?php echo $row['address'] . ',' . $row['district'] . '-' . $row['pincode'] . ',' . $row['state'] . '.'; ?></span>
                    <p class="mt-2" style="margin-bottom: 0; font-weight: 600; color: black;">Payment :- </p>
                    <div class="d-flex flex-row align-items-center">
                        <span><?php echo strtoupper($row['payment']); ?></span>
                        <img src="../online-shop-website-template/img/money.png" width="30" class="ml-3" />
                    </div>
                    <hr>
                    <p style="font-size: 20px; font-weight:500; border: 0.5px dashed black; border-radius: 5px;" class="d-flex justify-content-center">Order Status</p>
                    <?php if (($row['order_status']) == 'Delivery Soon') { ?>
                        <div class="d-flex flex-row mt-2 align-items-center">
                            <img src="../online-shop-website-template/img/fast-delivery.png" width="30" />
                            <span class="ml-3" style="font-weight: 500; color: orangered;"><?php echo $row['order_status']; ?></span>
                        </div>
                        <p class="mt-2" style="font-weight: 600; color: black;">Order Receive To : 
                        <span class="order ml-2" style="font-size: 15px; color: black;"><?php echo $fiveDays = date ("Y-m-d", strtotime ($row['date'] ."+5 days")); ?></span></p>
                    <?php } else { ?>
                        <div class="d-flex flex-row mt-2 align-items-center">
                            <img src="../online-shop-website-template/img/shipped.png" width="30" />
                            <span class="ml-3" style="font-weight: 500; color: green;"><?php echo $row['order_status']; ?></span>
                        </div>
                    <?php } ?>
                    <hr>
                    <button class="btn btn-primary mt-3 px-2" style="border-radius: 5px; padding: 2px;"><a href="index.php" style="margin-top: 0;color: black; text-decoration: none;">Go To Home Page</a></button>
                    <?php if (($row['order_status']) == 'Delivery Soon') { ?>
                        <button class="btn btn-primary mt-3 ml-2 px-2" style="border-radius: 5px; padding: 2px; background-color: white;" onclick="return confirm('Are You Sure Cancel Order?')"><a href="myorder.php?order_id=<?php echo $row['order_id']; ?>" style="margin-top: 0;color: black; text-decoration: none;">Cancel Order</a></button><?php } ?>
                </div>
            </div>
    <?php }
    } ?>

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