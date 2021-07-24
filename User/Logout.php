<?php 
include('Function.inc.php');
 session_start();
 unset($_SESSION['USER']);
 unset($_SESSION['USER_NAME']);
  redirect('Login.php');
?>