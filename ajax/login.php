<?php

include('../config/db.php');
if (!empty($_SESSION['admin'])) {
    if ($_SESSION['admin']['role'] == 'admin') {
      header('location:../html/index.php');
    } else {
      header('location:../online-shop-website-template/index.php');
    }
  }

$email = $_POST['email_number'];
$number = $_POST['email_number'];
$password = $_POST['password'];
$response = [];

if (empty($email)) {
    $response['email_number_err'] = "Email or Number is required.";
    $response['status'] = 400;
}

if (empty($password)) {
    $response['password_err'] = "Password is required.";
    $response['status'] = 400;
}
if (empty($response)) {

    $login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM register WHERE (`email`='$email' OR `phone_no` = '$number') AND `password`='$password'"));

    if ($login_data) {
        $_SESSION['admin'] = $login_data;
        setcookie('Status', 'Login', time() + 86400, '/');
        $response['success'] = "Login successfully.";
        $response['status'] = 200;
    } else {
        $response['error'] = "Invalid email/number and password !";
        $response['status'] = 400;
    }
} else {
    $response['error'] = "Somthing Went Wrong !";
    $response['status'] = 400;
}

echo json_encode($response);
