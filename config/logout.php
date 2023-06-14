<?php 

include('../config/db.php');

session_destroy();

header('location:../html/auth-login-basic.php');

?>