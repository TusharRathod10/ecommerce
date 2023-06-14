<?php

if (empty($_SESSION['admin'])) {
    header('location:../html/auth-login-basic.php');
  }
  
  if ($_COOKIE['Status'] == "Login") {
  } else {
    header('location:../html/auth-login-basic.php');
  }
