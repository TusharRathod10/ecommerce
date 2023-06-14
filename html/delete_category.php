<?php
include('../config/db.php');
include('../config/session-cookie.php');

$users = mysqli_query($con, "SELECT * FROM category");

$res = [];

if (!empty($_GET['delete_user'])) {
    $id = base64_decode($_GET['delete_user']);
    $fetch_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE `id`='$id'"));

    $delete_user = mysqli_query($con, "DELETE FROM category WHERE `id`='$id'");
    if ($delete_user) {
        $res['success'] = "User deleted successfully";
        $res['status'] = 200;
        echo json_encode($res);
    }
}

$table_row = '';
while ($data = mysqli_fetch_assoc($users)) {
    $table_row .= '<tr><td>' . $data['id'] . '</td>
                    <td>' . $data['categories'] . '</td>';
    $table_row .= '</td><td><a href="../html/add-category.php?update_id=' . $data['id'] . '"><button class="btn btn-secondary"><i class="fa fa-edit"></i></button></a></td>';
    $table_row .= '</td><td><button class="btn btn-danger" onclick="delete_category(' . $data['id'] . ')"><i class="fa fa-trash"></i></button></td>';

    $table_row .= '</td></tr>';
}
echo '<pre>' . $table_row;
