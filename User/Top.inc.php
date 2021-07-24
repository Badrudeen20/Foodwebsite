<?php 
include('Connection.inc.php');
include('Function.inc.php');
$cart = 0;
$userid = 0;
if(isset($_SESSION['USER_ID'])){
    $userid = $_SESSION['USER_ID'];
    $cartsnum  =    mysqli_query($conn,"select id from dish_cart where user_id = '$userid'");
    $cart = mysqli_num_rows($cartsnum);
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
    <nav>
        <div class="logo">
            <img src="../img/blogo.jpg" />
        </div>
        <ul id="navigation-menu">
            <li><a href="#home">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#service">Service</a></li>
            <li><a href="#contact">Contact us</a></li>
        </ul>
        <div class="user">
        <?php   if(isset($_SESSION['USER'])){ ?>
            <a href="#"><i class="fi-rr-user"></i></a>
            <a href="Cart.php" class="shopping-cart">
                <i class="fi-rr-shopping-cart"></i>
                <span id="cart"><?php echo $cart ?></span>
            </a>
         <?php }else{ ?>   
            <a href="Login.php" class="btn">Login</a>
         <?php } ?>   

            
        </div>
        <div class="burger">
            <i class="fi-rr-menu-burger"></i>
        </div>
    </nav>
