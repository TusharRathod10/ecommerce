<?php
include('../config/db.php');
include('../config/session-cookie.php');

$users = mysqli_query($con, "SELECT * FROM `order`");

$res = [];

if (!empty($_GET['delete_order'])) {
    $id = base64_decode($_GET['delete_order']);
    $fetch_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `order` WHERE `id`='$id'"));

    $delete_user = mysqli_query($con, "DELETE FROM `order` WHERE `id`='$id'");
    if ($delete_user) {
        $res['success'] = "User deleted successfully";
        $res['status'] = 200;
        echo json_encode($res);
    }
}

if(!empty($_GET['update_status'])){
    $id = base64_decode($_GET['update_status']);
    $fetch_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `order` WHERE `id`='$id'"));
    $order_status= 'Delivery Complete';
    $update_status = mysqli_query($con, "UPDATE `order` SET `order_status`='$order_status' WHERE `id`='$id'");
}

$table_row = '';
while ($data = mysqli_fetch_assoc($users)) {
    $memories = explode(',', $data['image']);
    $table_row .= '<tr><td>' . $data['id'] . '</td>
    <td>' . $data['order_id'] . '</td>
    <td>' . $data['firstname'] . '</td>
    <td>' . $data['lastname'] . '</td>
    <td>' . $data['email'] . '</td>
    <td>' . $data['number'] . '</td>
    <td>' . $data['address'] . '</td>
    <td>' . $data['state'] . '</td>
    <td>' . $data['district'] . '</td>
    <td>' . $data['pincode'] . '</td>
    <td>' . $data['date'] . '</td>
    <td>' . $data['payment'] . '</td>
    <td>' . $data['total_product'] . '</td>
                    <td>' . $data['total_price'] . '</td><td>';
                    for ($i = 0; $i < count($memories); $i++) {
                        $table_row .= '<div style="width: 75px;height: 75px; margin:10px 0px;"><img src="' . '../assets/products/' . $memories[$i] . '" style="max-width: 100%;max-height: 100%; border: 1px solid black; padding: 5px;"></div>';
                    }
    $table_row .= '</td><td><button class="btn btn-primary" onclick="update_status('. $data['id'] .')">'. $data['order_status'] .'</button></td>';
    $table_row .= '<td><button class="btn btn-danger" onclick="delete_order(' . $data['id'] . ')"><i class="fa fa-trash"></i></button></td>';
    $table_row .= '</tr>';
}
echo '<pre>' . $table_row;
