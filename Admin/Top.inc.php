<?php 
include('Connection.inc.php');
include('Function.inc.php');
if(!isset($_SESSION['ADMIN'])){
    redirect('Login.php');
}
$name= $_SESSION['ADMIN_ID'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css"/>
    <link rel="stylesheet" href="./css/styles.css" /> 
    <script>
  
    </script>
</head>
<body>
  <div class="sidebar">
      <div class="sidebar-brand">
          <h1><i class="fi-rr-basketball"></i>Ripple</h1>
      </div>
      <div class="sidebar-menu">
          <ul>
              <li><a href="Index.php" class="url"><i class="fi-rr-layers"></i> Dashboard</a></li>
              <li><a href="Category.php" class="url"><i class="fi-rr-book-alt"></i> Category</a></li>
              <li><a href="Comments.php" class="url"><i class="fi-rr-comment"></i> Comments</a></li>
              <li><a href="Customer.php" class="url"><i class="fi-rr-portrait"></i> Customer</a></li>
              <li><a href="Dish.php" class="url"><i class="fi-rr-palette"></i> Dish</a></li>
              <li><a href="Orders.php" class="url"><i class="fi-rr-shopping-bag"></i> Orders</a></li>
          </ul>
      </div>
      <div id="close">
        <i class="fi-rr-cross-small"></i>
      </div>
      
  </div>

  <div class="main-content">
      <header>
              <h1>
                  <label><i class="fi-rr-menu-burger" id="burger"></i></label>
              </h1>
              <div class="user-wrapper">
                 <i class="fi-rr-portrait"></i>
                   <div>
                      <h4><?php echo $name ?></h4>
                      <small><a href="Logout.php">Logout</a></small>
                   </div>
                  <!--<div class="login">
                    <small><a href="#">Login</a></small>
                    <small>/</small>
                    <small><a href="#">Register</a></small>
                </div>-->
              </div>
      </header>