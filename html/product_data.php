<?php
include('../config/db.php');
include('../config/session-cookie.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $fetch_user = json_encode(mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product WHERE `id`='$id'")));
    print_r($fetch_user);
}