<?php

include('../config/db.php');
include('../config/session-cookie.php');

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];
    $category = implode(',', $_POST['category']);
    $subcategory = implode(',', $_POST['subcategory']);
    $image = $_FILES['multiple'];
    for ($i = 0; $i < count($image['name']); $i++) {
        $rand = rand(1000000, 99999999);
        $explode = explode(".", $image['name'][$i]);
        $extension = end($explode);
        $multiple_image[] = $rand . "." . $extension;
        move_uploaded_file($image['tmp_name'][$i], "../assets/products/" . $multiple_image[$i]);
    }
    $image = implode(',', $multiple_image);
    if (isset($image) && !empty($image)) {
        $insert = mysqli_query($con, "INSERT INTO product(`title`,`image`,`price`,`discount`,`category`,`subcategory`,`description`)VALUES('$title','$image','$price','$discount','$category','$subcategory','$description')");
        header('location:product.php');
    }
}

$product_data = mysqli_query($con, "SELECT * FROM product");

if (isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];

    $data_exe = mysqli_query($con, "SELECT * FROM product WHERE `id`='$update_id' ");
    $data_arr = mysqli_fetch_assoc($data_exe);
    $category = explode(" , ", $data_arr['category']);
    $subcategory = explode(" , ", $data_arr['subcategory']);
}

if (isset($_POST['update'])) {
    $id = $_GET['update_id'];

    $ntitle = $_POST['title'] ? $_POST['title'] : $data_arr['title'];
    $nprice = $_POST['price'] ? $_POST['price'] : $data_arr['price'];
    $ndiscount = $_POST['discount'] ? $_POST['discount'] : $data_arr['discount'];
    $ndescription = $_POST['description'] ? $_POST['description'] : $data_arr['description'];
    $ncategory = $_POST['category'] ? $_POST['category'] : $category;
    $nsubcategory = $_POST['subcategory'] ? $_POST['subcategory'] : $subcategory;
    if (!empty($_FILES['multiple']['name'][0])) {
        $old_memories_pic = !empty($data_arr['image']) ? explode(',', $data_arr['image']) : '';
        if (!empty($old_memories_pic)) {
            foreach ($old_memories_pic as $pic) {
                if (file_exists('../assets/products/' . $pic)) {
                    unlink('../assets/products/' . $pic);
                }
            }
        }
        $image = $_FILES['multiple'];
        for ($i = 0; $i < count($image['name']); $i++) {
            $rand = rand(1000000, 99999999);
            $explode = explode(".", $image['name'][$i]);
            $extension = end($explode);
            $multiple_image[] = $rand . "." . $extension;
            move_uploaded_file($image['tmp_name'][$i], "../assets/products/" . $multiple_image[$i]);
        }
        $memories = implode(',', $multiple_image);
    }else{
        $memories=$data_arr['image'];
    }
    $ncategory = implode(" , ", $ncategory);
    $nsubcategory = implode(" , ", $nsubcategory);

    $data_update = "UPDATE product SET `title`='$ntitle',`price`='$nprice',`discount`='$ndiscount',`description`='$ndescription',`category`='$ncategory',`subcategory`='$nsubcategory',`image`='$memories' WHERE `id`='$id'";
    $updated_data_exe = mysqli_query($con, $data_update);

    if ($updated_data_exe) {
        header('location:product.php');
    } else {
        $error = "Something went wrong";
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Vertical Layouts - Forms | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include('../config/sidebar.php') ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include('../config/header.php') ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Insert</span> Product
                        </h4>

                        <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <small class="text-muted float-end">Product</small>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Product
                                                    Name</label>
                                                <input type="text" style="width: 45%;" placeholder="Enter Product Name" id="p_name" name="title" value="<?php if (isset($_GET['update_id'])) {
                                                                                                                                                            echo $data_arr['title'];
                                                                                                                                                        } ?>" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Product
                                                    Image</label><br>

                                                <?php if (isset($_GET['update_id'])) {
                                                    $img = explode(',', $data_arr['image']);
                                                    for ($i = 0; $i < count($img); $i++) {
                                                ?> <img src="../assets/products/<?php echo $img[$i] ?>" alt="" height="70px" width="70px" style="border: 1px solid black; padding: 5px;margin:10px;"><?php }
                                                                                                                                                                                                } ?>
                                                <input type="file" id="img" name="multiple[]" class="form-control" style="width: 35%;"  multiple>

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Product
                                                    Price</label>
                                                <input type="tel" placeholder="Enter Product Price" id="p_price" style="width: 35%;" name="price" value="<?php if (isset($_GET['update_id'])) {
                                                                                                                                                                echo $data_arr['price'];
                                                                                                                                                            } ?>" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Product
                                                    Discount</label>

                                                <input type="number" style="width: 35%;" placeholder="Enter Product Discount" id="p_dis" name="discount" min="1" max="100" value="<?php if (isset($_GET['update_id'])) {
                                                                                                                                                                                        echo $data_arr['discount'];
                                                                                                                                                                                    } ?>" class="form-control" required />

                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label" for="basic-default-fullname">Product
                                                            Category</label>
                                                        <select id="p_category" name="category[]" class="form-select" multiple required>
                                                            <?php if (isset($_GET['update_id'])) {
                                                                $cat_arr = explode(",", $data_arr['category']);

                                                                foreach ($cat_arr as $tmp_cat) {
                                                                    echo "<option value='" . $tmp_cat . "'selected>" . $tmp_cat . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            $category = mysqli_query($con, "SELECT `id`,`categories` FROM category");
                                                            if ($category) {
                                                                while ($row = mysqli_fetch_assoc($category)) { ?>
                                                                    <option value="<?php echo $row['categories'] ?>"><?php echo $row['categories'] ?> </option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="basic-default-fullname">Product
                                                            SubCategory</label>
                                                        <select id="p_subcategory" name="subcategory[]" class="form-select" multiple required>
                                                            <?php if (isset($_GET['update_id'])) {
                                                                $cat_arr = explode(",", $data_arr['subcategory']);
                                                                foreach ($cat_arr as $tmp_cat) {
                                                                    echo "<option value='" . $tmp_cat . "'selected>" . $tmp_cat . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            $subcategory = mysqli_query($con, "SELECT `sub_id`,`title` FROM subcategory");
                                                            if ($subcategory) {
                                                                while ($row = mysqli_fetch_assoc($subcategory)) { ?>
                                                                    <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?> </option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="description">Product
                                                    Description</label>
                                                <textarea id="basic-default-message" class="form-control" name="description" id="p_description" placeholder="Hi, Do you have a moment to talk Joe?" required><?php if (isset($_GET['update_id'])) {
                                                                                                                                                                                                                    echo $data_arr['description'];
                                                                                                                                                                                                                }  ?></textarea>
                                            </div>
                                            <?php if (isset($_GET['update_id'])) { ?>
                                                <button type="submit" id="update" value="submit" name="update" class="btn btn-primary">Update</button>
                                            <?php } else { ?>
                                                <button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">

                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#p_category").select2({
            maximumSelectionLength: 3
        });
    </script>
    <script>
        $("#p_subcategory").select2({
            maximumSelectionLength: 6
        });
    </script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

</script>