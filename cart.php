<?php

include('../config/db.php');

if (isset($_POST['update_btn'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $update_id = $_POST['update_quantity_id'];
        $update_value = $_POST['update_quantity'];
        $quantity_update = mysqli_query($con, "UPDATE `cart` SET `quantity`='$update_value' WHERE `id`='$update_id'");
        if ($quantity_update) {
            header('location:cart.php');
        }
    } else {
        header('location:../html/auth-login-basic.php');
    }
}

if (isset($_GET['remove'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $remove_id = $_GET['remove'];
        mysqli_query($con, "DELETE FROM `cart` WHERE `id`='$remove_id'");
        header('location:cart.php');
    } else {
        header('location:../html/auth-login-basic.php');
    }
}

if (isset($_GET['remove_all'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        mysqli_query($con, "DELETE FROM `cart`");
        header('location:cart.php');
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
    <style>
        #number {
            padding: 0.5rem 0.5rem;
            font: 1rem;
            color: var(--blue);
            width: 5rem;
            border: 1px solid silver;
        }
    </style>
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Original Price</th>
                            <th>Discount Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle"><?php
                                                $grand_total = 0;
                                                $login_mail=$_SESSION['admin']['email'];
                                                $getQuery =  mysqli_query($con, "SELECT *FROM cart WHERE `login_mail`='$login_mail'");
                                                while ($row2 = mysqli_fetch_assoc($getQuery)) { ?>
                            <tr>
                                <td class="align-middle"><?php
                                                            $img = explode(',', $row2['pro_image']);
                                                            for ($i = 0; $i < count($img); $i++) {
                                                            ?> <img src="../assets/products/<?php print($img[$i]); ?>" alt="" style="width: 50px;margin-right: 10px;"><?php }
                                                                                                                                                                        ?><?php echo $row2['pro_name']; ?></td>
                                <td class="align-middle">₹<?php
                                                            echo $row2['pro_price']; ?></td>
                                <td class="align-middle">₹<?php $price = $row2['pro_price'] - ($row2['pro_price'] * ($row2['pro_discount'] / 100));
                                                            echo intval($price); ?></td>
                                <td class="align-middle">
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" id="" value="<?php echo $row2['id']; ?>">
                                        <input type="number" min="1" name="update_quantity" id="number" value="<?php echo $row2['quantity']; ?>">
                                        <button type="submit" style="margin:10px;padding:2px 5px; border-radius: 5px;" class="btn btn-primary" value="update" name="update_btn"><i class="fa fa-check"></i></button>
                                    </form>
                                </td>
                                <td class="align-middle"><?php echo "₹" . $sub_total = intval($price * $row2['quantity']); ?></td>
                                <td class="align-middle"><a href="cart.php?remove=<?php echo $row2['id']; ?>" onclick="return confirm('Remove Item From Cart?')" class="delete"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a></td>
                            </tr>
                        <?php
                                                    $grand_total += $sub_total;
                                                }
                                                if (mysqli_num_rows($getQuery) > 0) { ?>
                            <tr style="margin-top:10x;">
                                <td class="align-middle"><button class="btn btn-primary" style="border-radius: 5px;"><a href="shop.php" style="margin-top: 0;color: black; text-decoration: none;">Add More Product</a></button></td>
                                <td colspan="3" style="font-size: 20px; font-weight: 600;">Grand Total : </td>
                                <td><?php echo '₹' . $grand_total; ?></td>
                                <td><a href="cart.php?remove_all=<?php $getQuery =  mysqli_query($con, "SELECT *FROM cart");
                                                                    $getall = mysqli_fetch_assoc($getQuery);
                                                                    echo $getall['id']; ?>" onclick="return confirm('Are You Sure You Want To Delete All?')" class="delete"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a></td>
                            </tr><?php } else { ?>
                            <tr>
                                <td colspan="5" style="font-size: 20px; font-weight: 600;">No Product Carted</td>
                                <td class="align-middle"><button class="btn btn-primary" style="border-radius: 5px;"><a href="shop.php" style="margin-top: 0;color: black; text-decoration: none;">Continue Shopping</a></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Grand Total</h6>
                            <h6><?php echo '₹' . $grand_total; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php if ($grand_total > 1) {
                                                                echo '₹' . $shipping = 40;
                                                            } else {
                                                                echo '₹' . $shipping = 0;
                                                            } ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php $total = $grand_total + $shipping;
                                echo '₹' . $total; ?></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" <?php if ($grand_total < 1) {
                                                                                                    echo 'disabled';
                                                                                                } else {
                                                                                                    echo '';
                                                                                                } ?>><a href="checkout.php" style="text-decoration:none; color: black;">Proceed To Checkout</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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