<?php

include('../config/db.php');
if (!empty($_SESSION['admin'])) {
  if ($_SESSION['admin']['role'] == 'admin') {
    header('location:../html/index.php');
  } else {
    header('location:../online-shop-website-template/index.php');
  }
}
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                 <img src="../assets/img/pngegg.png" alt="" height="40px" width="40px">
             </span>
             <span class=" demo menu-text fw-bolder ms-2" style="font-size: 25px; color: black;">Register</span>
                </a>
              </div>
              <p id="success" class='error' style="color:green; font-weight: bold;"></p>
              <p id="error" class='error' style="color:red; font-weight: bold;"></p>
              <!-- /Logo -->
              <h4 class="mb-2">Adventure starts here 🚀</h4>
              <p class="mb-4">Make your app management easy and fun!</p>

              <form id="form" class="mb-3" action="index.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    autofocus
                  />
                </div>
                <p id="username_err" class='error' style="color:red; font-weight: bold;"></p>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                </div>
                
                <p id="email_err" class='error' style="color:red; font-weight: bold;"></p>
                <p id="repeat" class='error' style="color:red; font-weight: bold;"></p>

                <div class="mb-3">
                  <label for="number" class="form-label">Mobile Number</label>
                  <input type="tel" maxlength="10" minlength="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" id="number" name="number" placeholder="Enter your number" />
                </div>
                
                <p id="number_err" class='error' style="color:red; font-weight: bold;"></p>
                <p id="length_err" class='error' style="color:red; font-weight: bold;"></p>
                <p id="no_repeat" class='error' style="color:red; font-weight: bold;"></p>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <p id="password_err" class='error' style="color:red; font-weight: bold;"></p>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100" name="submit" value="submit" id="submit" type="submit">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="auth-login-basic.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        $('#form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '../ajax/register.php',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#username_err').text("");
                    $('#email_err').text("");
                    $('#number_err').text("");
                    $('#length_err').text("");
                    $('#password_err').text("");
                    $('#repeat').text("");
                    $('#no_repeat').text("");
                    $('#error').text("");
                    var x = JSON.parse(response);
                    if (x.status == 400) {
                        $('#username_err').text(x.username_err);
                        $('#email_err').text(x.email_err);
                        $('#number_err').text(x.number_err);
                        $('#length_err').text(x.length_err);
                        $('#password_err').text(x.password_err);
                        $('#repeat').text(x.repeat);
                        $('#no_repeat').text(x.no_repeat);
                        $('#error').text(x.error);
                    } else if (x.status == 200) {
                        $('#success').text(x.success);
                        $('#form')[0].reset();
                        window.setTimeout(function(){window.location.href = "auth-login-basic.php"},3000);
                     }
                }
            })
        })
    </script>
   <script>
   $(document).ready(function(){
   var hideError = function () {
   $(".error").hide();
  };

    $("#form").submit(function () {
        setTimeout(hideError, 3000);
        $(".error").show();
            });
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