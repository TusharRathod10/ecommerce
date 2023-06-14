<?php

include('../config/db.php');

$username = $_POST['username'];
$email = $_POST['email'];
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

if (empty($password)) {
    $response['password_err'] = "Password is required.";
    $response['status'] = 400;
}

if (empty($response)) {
    $user = "SELECT email FROM register WHERE `email`='$email'";
    $user_exe = mysqli_query($con, $user);
    $user_count = mysqli_num_rows($user_exe);

    if ($user_count > 0) {
        $response['repeat'] = "Email Already Exists !";
        $response['status'] = 400;
    } else {

        $insert = "INSERT INTO register (`username`,`email`,`password`) VALUES ('$username','$email','$password')";
        $insert_exe = mysqli_query($con, $insert);
        $response['success'] = "Register successfully.";
        $response['status'] = 200;
    }
} else {
    $response['error'] = "Somthing Went Wrong !";
    $response['status'] = 400;
}

echo json_encode($response);
