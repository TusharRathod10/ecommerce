<?php

include('../config/db.php');
include('../config/session-cookie.php');

if (isset($_POST['submit'])) {

    $subcategories = $_POST['title'];
    $categories = $_POST['category'];

    if (isset($categories) && !empty($categories)) {
        $cate = mysqli_query($con, "SELECT title FROM subcategory WHERE `title`='$subcategories'");
        $cate_count = mysqli_num_rows($cate);

        if ($cate_count > 0) {
            echo "<script>alert('Sub-Category Already Exiest !')</script>";
        } else {

            $query=mysqli_query($con,"SELECT id FROM category WHERE `categories`= '$categories'");

            if($query){
                while($row=mysqli_fetch_assoc($query)){
                    $id=$row['id'];
                }
                $insert = mysqli_query($con, "INSERT INTO subcategory(`title`,`cat_id`)VALUES('$subcategories','$id')");
                header('location:sub-category.php');
            }
        }
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Insert</span> SubCategory
                        </h4>

                        <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <small class="text-muted float-end">SubCategory</small>
                                    </div>
                                  
                                    <div class="card-body">
                                        <form action="" method="POST" id="form" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">SubCategory
                                                    Name</label>
                                                <input type="text" id="category" placeholder="Add Sub-Category" name="title" value="<?php if (isset($_GET['update_id'])) {
                                                                                                                echo $data_arr['title'];
                                                                                                            } ?>" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">
                                                    Category</label>
                                                <select id="p_category" name="category" class="form-select" required>
                                                    <option value="0" hidden selected>Select Category</option>
                                                    <?php
                                                    $category = mysqli_query($con, "SELECT `id`,`categories` FROM category");
                                                    if ($category) {
                                                        while ($row = mysqli_fetch_assoc($category)) { ?>
                                                            <option value="<?php echo $row['categories'] ?>" <?php if (isset($_GET['update_id'])) {
                                                                                                            if ($data_arr['category'] == $row['categories']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        } ?>><?php echo $row['categories'] ?> </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                                <button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
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