<?php

include('../config/db.php');

if (!empty($_SESSION['admin'])) {
    header('location:../html/index.php');
}

$email = $_POST['email'];
$password = $_POST['password'];
$response = [];

if (empty($email)) {
    $response['email_err'] = "Email is required.";
    $response['status'] = 400;
}

if (empty($password)) {
    $response['password_err'] = "Password is required.";
    $response['status'] = 400;
}
if (empty($response)) {

    $login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM register WHERE `email`='$email' AND `password`='$password'"));

    if ($login_data) {
        $_SESSION['admin'] = $login_data;
        setcookie('Status', 'Login', time() + 86400, '/');
        $response['success'] = "Login successfully.";
        $response['status'] = 200;
    } else {
        $response['error'] = "Invalid email and password !";
        $response['status'] = 400;
    }
} else {
    $response['error'] = "Somthing Went Wrong !";
    $response['status'] = 400;
}

echo json_encode($response);
