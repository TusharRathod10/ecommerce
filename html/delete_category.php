<?php
include('../config/db.php');
include('../config/session-cookie.php');

$users = mysqli_query($con, "SELECT * FROM category");

$res = [];

if (!empty($_GET['delete_user'])) {
    $id = base64_decode($_GET['delete_user']);
    $fetch_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE `id`='$id'"));
    if (file_exists('../assets/category/' . $fetch_user['image'])) {
        unlink('../assets/category/' . $fetch_user['image']);
    }
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
    $table_row .= '<td><div style="width: 75px;height: 75px; margin:10px 0px;"><img src="' . '../assets/category/' . $data['img'] . '" style="max-width: 100%;max-height: 100%; border: 1px solid black; padding: 5px;"></div>';
    $table_row .= '</td><td><a href="../html/add-category.php?update_id=' . $data['id'] . '"><button class="btn btn-secondary"><i class="fa fa-edit"></i></button></a></td>';
    $table_row .= '</td><td><button class="btn btn-danger" onclick="delete_category(' . $data['id'] . ')"><i class="fa fa-trash"></i></button></td>';

    $table_row .= '</td></tr>';
}
echo '<pre>' . $table_row;
