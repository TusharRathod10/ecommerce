<?php

include('../config/db.php');
if (!empty($_SESSION['admin'])) {
    if ($_SESSION['admin']['role'] == 'admin') {
      header('location:../html/index.php');
    } else {
      header('location:../online-shop-website-template/index.php');
    }
  }
$username = $_POST['username'];
$email = $_POST['email'];
$number = $_POST['number'];
$password = $_POST['password'];
$response = [];

if (empty($username)) {
    $response['username_err'] = "Username is required.";
    $response['status'] = 400;
}

if (empty($email)) {
    $response['email_err'] = "Email is required.";
    $response['status'] = 400;
}

if (empty($number)) {
    $response['number_err'] = "Number is required.";
    $response['status'] = 400;
}

if (empty($password)) {
    $response['password_err'] = "Password is required.";
    $response['status'] = 400;
}

$no_length = strlen($number);
if (!empty($number) && ($no_length < 10)) {
    $response['length_err'] = "Number Length must be 10 !";
    $response['status'] = 400;
}

if (empty($response)) {
    $user_email = mysqli_query($con, "SELECT email FROM register WHERE `email`='$email'");
    $user_count = mysqli_num_rows($user_email);

    $user_number = mysqli_query($con, "SELECT phone_no FROM register WHERE `phone_no`='$number'");
    $num_count = mysqli_num_rows($user_number);

    if ($user_count > 0) {
        $response['repeat'] = "Email Already Exists !";
        $response['status'] = 400;
    } elseif ($num_count > 0) {
        $response['no_repeat'] = "Number Already Exists !";
        $response['status'] = 400;
    } else {

        $insert = "INSERT INTO register (`username`,`email`,`phone_no`,`password`,`role`) VALUES ('$username','$email','$number','$password','user')";
        $insert_exe = mysqli_query($con, $insert);
        $response['success'] = "Register successfully.";
        $response['status'] = 200;
    }
} else {
    $response['error'] = "Somthing Went Wrong !";
    $response['status'] = 400;
}

echo json_encode($response);
