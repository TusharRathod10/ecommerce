<?php

include('../config/db.php');

if (isset($_POST['order'])) {
    if ($_SESSION['admin']['role'] == 'user') {
        $order_id = rand(1000000, 9999999);
        $firstname = $_SESSION['admin']['username'];
        $lastname = $_POST['lastname'];
        $email = $_SESSION['admin']['email'];
        $number = $_SESSION['admin']['phone_no'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $date = date('Y-m-d');
        $payment = $_POST['payment'];
        $login_mail=$_SESSION['admin']['email'];
        $order_status='Delivery Soon';

        $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE `login_mail`='$login_mail'");
        $price_total = 0;
        if (mysqli_num_rows($cart_query) > 0) {
            while ($product_item = mysqli_fetch_assoc($cart_query)) {
                $image[]=$product_item['pro_image'];
                $product_name[] = $product_item['pro_name'] . ' (' . $product_item['quantity'] . ') ';
                $price = $product_item['pro_price'] - ($product_item['pro_price'] * ($product_item['pro_discount'] / 100));
                $product_price = intval($price * $product_item['quantity']);;
                $price_total += $product_price;
            };
            $image=implode(',',$image);
        };
        $total_product = implode(', ', $product_name);
        $detail_query = mysqli_query($con, "INSERT INTO `order`(`order_id`,`firstname`,`lastname`,`email`,`number`,`address`,`state`,`district`,`pincode`,`date`,`image`,`payment`,`total_product`,`total_price`,`order_status`) VALUES('$order_id','$firstname','$lastname','$email','$number','$address','$state','$district','$pincode','$date','$image','$payment','$total_product','$price_total','$order_status')") or die('query failed');
        if ($detail_query) {
            $delet_cart = mysqli_query($con, "DELETE FROM cart WHERE `login_mail`='$login_mail'");
            if ($delet_cart) {
                header('location:myorder.php');
            }
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
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="" method="post">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label style="font-weight: 600;">First Name</label>
                                <input class="form-control" type="text" placeholder="Enter Firstname" value="<?php if(isset($_SESSION['admin']['email'])){ echo $_SESSION['admin']['username'];} ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="font-weight: 600;">Last Name</label>
                                <input class="form-control" type="text" placeholder="Enter Lastname" name="lastname" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="font-weight: 600;">E-mail</label>
                                <input class="form-control" type="email" placeholder="Enter E-mail" value="<?php if(isset($_SESSION['admin']['email'])){echo $_SESSION['admin']['email'];} ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label style="font-weight: 600;">Mobile No</label>
                                <input class="form-control" type="tel" maxlength="10" minlength="10" name="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter Number"  value="<?php if(isset($_SESSION['admin']['phone_no'])){echo $_SESSION['admin']['phone_no'];} ?>" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label style="font-weight: 600;">Address</label>
                                <textarea class="form-control" type="text" placeholder="Enter Your Address" name="address" required></textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="inputState" style="font-weight: 600;">State</label>
                                <select class="form-control" id="inputState" name="state" required>
                                    <option value="SelectState">Select State</option>
                                    <option value="Andra Pradesh">Andra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madya Pradesh">Madya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Orissa">Orissa</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttaranchal">Uttaranchal</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="West Bengal">West Bengal</option>
                                    <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadeep">Lakshadeep</option>
                                    <option value="Pondicherry">Pondicherry</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="inputDistrict" style="font-weight: 600;">District</label>
                                <select class="form-control" id="inputDistrict" name="district" required>
                                    <option value="">-- select one -- </option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label style="font-weight: 600;">Pin Code</label>
                                <input class="form-control" type="tel" maxlength="6" minlength="6" name="pincode" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="pincode" placeholder="Enter Pincode" required>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                    <div class="bg-light p-30 mb-5">

                        <?php $grand_total = 0;
                        $sub_total = 0;
                        $login_mail=$_SESSION['admin']['email'];
                        $getQuery =  mysqli_query($con, "SELECT *FROM cart WHERE `login_mail`='$login_mail'");
                        if (mysqli_num_rows($getQuery) > 0) { ?>
                            <div class="border-bottom">
                                <h6 class="mb-3">Products</h6>
                                <?php while ($row2 = mysqli_fetch_assoc($getQuery)) { ?>
                                    <div class="d-flex justify-content-between">
                                        <p><?php echo $row2['pro_name'];
                                            echo ' (' . $row2['quantity'] . '-Qty)'; ?></p>
                                        <p><?php $price = $row2['pro_price'] - ($row2['pro_price'] * ($row2['pro_discount'] / 100));
                                            echo "₹" . $sub_total = intval($price * $row2['quantity']); ?></p>
                                    </div>
                                <?php $grand_total += $sub_total;
                                } ?>
                            </div>
                            <div class="border-bottom pt-3 pb-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6>Grand total</h6>
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
                            </div>
                        <?php } else {
                            echo '<div class="alert alert-danger" role="alert">No records found</div>';
                        } ?>

                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="paypal" id="paypal" checked>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="credit/debit" id="credit/debit">
                                    <label class="custom-control-label" for="credit/debit">Credit/Debit Card</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="cash-on-delivery" id="cashondelivery">
                                    <label class="custom-control-label" for="cashondelivery">Cash On Delivery</label>
                                </div>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit" name="order" value="submit">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->


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
    <script src="js/state.js"></script>

    <!-- State City -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

</body>

</html>