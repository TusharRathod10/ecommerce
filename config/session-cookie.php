<?php

if ($_SESSION['admin'] == '') {
  header('location:../html/auth-login-basic.php');
}

if($_SESSION['admin']['role']=='user'){
  header('location:../online-shop-website-template/index.php');
}

if ($_COOKIE['Status'] == "Login") {
} else {
  header('location:../html/auth-login-basic.php');
}
?>