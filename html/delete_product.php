<?php
include('../config/db.php');
include('../config/session-cookie.php');

$users = mysqli_query($con, "SELECT * FROM product");

$res = [];

if (!empty($_GET['delete_user'])) {
    $id = base64_decode($_GET['delete_user']);
    $fetch_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product WHERE `id`='$id'"));
    if (!empty($fetch_user['image'])) {
        
        $old_pics = !empty($fetch_user['image']) ? explode(',', $fetch_user['image']) : '';
        if (!empty($old_pics)) {
            foreach ($old_pics as $pic) {
                if (file_exists('../assets/products/' . $pic)) {
                    unlink('../assets/products/' . $pic);
                }
            }
        }
        $delete_user = mysqli_query($con, "DELETE FROM product WHERE `id`='$id'");
        if ($delete_user) {
            $res['success'] = "User deleted successfully";
            $res['status'] = 200;
            echo json_encode($res);
        }
    }
}

$table_row = '';
while ($data = mysqli_fetch_assoc($users)) {
    $memories = explode(',', $data['image']);
    $table_row .= '<tr><td>' . $data['id'] . '</td>
                    <td>' . $data['title'] . '</td>
                    <td>' . $data['price'] . '</td>
                    <td>' . $data['discount'] . '</td>
                    <td>' . $data['category'] . '</td>
                    <td>' . $data['subcategory'] . '</td>
                    <td style="white-space: pre-wrap;">' . $data['description'] . '</td><td>';
    for ($i = 0; $i < count($memories); $i++) {
        $table_row .= '<div style="width: 75px;height: 75px; margin:10px 0px;"><img src="' . '../assets/products/' . $memories[$i] . '" style="max-width: 100%;max-height: 100%; border: 1px solid black; padding: 5px;"></div>';
    }
    $table_row .= '</td><td><a href="../html/add-product.php?update_id=' . $data['id'] . '"><button class="btn btn-secondary"><i class="fa fa-edit"></i></button></a></td>';
    $table_row .= '</td><td><button class="btn btn-danger" onclick="delete_user(' . $data['id'] . ')"><i class="fa fa-trash"></i></button></td>';

    $table_row .= '</td></tr>';
}
echo '<pre>' . $table_row;
