<?php 
include('Connection.inc.php');
include('Function.inc.php');
$cart = 0;
$userid = 0;
$total = 0;
$name="";
$email="";
$phone="";
if(!isset($_SESSION['USER'])){
    redirect('Index.php');
}

if(isset($_GET['type']) && $_GET['type']=="delete"){
  
    if($_GET['id'] > 0){
         $id = $_GET['id'];
         mysqli_query($conn,"delete from dish_cart where id = '$id'");
    }
}


if(isset($_SESSION['USER_ID'])){
    $userid = $_SESSION['USER_ID'];
    $userDetail = mysqli_query($conn,"select * from users where id = '$userid'");
    $userDetail_row = mysqli_fetch_assoc($userDetail);
    $name=$userDetail_row['username'];
    $email=$userDetail_row['email'];
    $phone=$userDetail_row['phone'];
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
            <li><a href="Home.php">Home</a></li>
            <li><a href="#menu">Menu</a></li>
        </ul>
        <div class="user">
        <?php   if(isset($_SESSION['USER'])){ ?>
            <a href="#"><i class="fi-rr-user"></i></a>
            <a href="Cart.php" class="shopping-cart">
                <i class="fi-rr-shopping-cart"></i>
                <span><?php echo $cart ?></span>
            </a>
         <?php }else{ ?>   
            <a href="Login.php" class="btn">Login</a>
         <?php } ?> 
        </div>
        <div class="burger">
            <i class="fi-rr-menu-burger"></i>
        </div>
    </nav>

    <section class="checkout">
        <h2>Address Detail</h2>
        <div class="responsive">
            <form>
                <input type="text" placeholder="Name" name="name" value="<?php echo $name ?>" /><br/>
                <textarea placeholder="address" name="address" ></textarea><br/>
                <div class="flex-col">
                    <input type="email" placeholder="Email" name="email" value="<?php echo $email ?>" />
                    <input type="phone" placeholder="Phone" name="phone" value="<?php echo $phone ?>" />
                </div>
                <div class="payment">
                    <label>
                        <input type="radio" class="option-input radio" name="example" checked />
                        <span><i class="fi-rr-money"></i></span>
                      </label>
                      <label>
                        <input type="radio" class="option-input radio" name="example" />
                        <span><i class="fi-rr-credit-card"></i></span>
                      </label>
                </div>
                <button>Order Placed</button>
            </form>
            <div class="checkcart">
                <h3>Your cart</h3>
                <ul>
                <?php
                 $dish_cart_res  = mysqli_query($conn,"select * from dish_cart where user_id = '$userid'");
                 while($dish_cart_row = mysqli_fetch_assoc($dish_cart_res)){ 
               ?> 
                    <li>
                    <?php 
                      $dishid = $dish_cart_row['dish_detail_id'];
                      $dish_res  = mysqli_query($conn,"select dish.*,dish_detail.attribute,dish_detail.price,dish_detail.id from dish_detail,dish where dish_detail.id = '$dishid' and dish.id = dish_detail.dish_id group by dish_detail.id"); 
                      $dish_row = mysqli_fetch_assoc($dish_res);
                    ?>
                        <img src="../img/<?php echo $dish_row['image'] ?>" />
                        <div class="detail">
                            <p><?php echo $dish_row['dish'] ?></p>
                            <div class="qty">
                                <span onclick="updateQty(<?php echo $dish_cart_row['id'] ?>,<?php echo $dish_row['price'] ?>,'minus')"><i class="fi-rr-minus-small"></i></span>
                                   <p id="qty<?php echo $dish_cart_row['id'] ?>"><?php echo $dish_cart_row['qty'] ?></p>
                                <span onclick="updateQty(<?php echo $dish_cart_row['id'] ?>,<?php echo $dish_row['price'] ?>,'plus')"><i class="fi-rr-plus-small"></i></span>
                            </div>
                        </div>
                        <div class="price">
                        <p>$<span id="total<?php echo $dish_cart_row['id'] ?>" class="subTotal"><?php echo $dish_row['price'] * $dish_cart_row['qty'] ?></span></p>
                            <a href="?type=delete&id=<?php echo $dish_cart_row['id'] ?>"><i class="fi-rr-trash"></i></a>
                        </div>
                      </li>
                    <?php $total = $total + $dish_row['price'] * $dish_cart_row['qty']; ?>
                    <?php } ?>
                    <li class="total">
                        <span>Total</span>
                        <span id="total">$<?php echo $total ?></span>
                    </li>
              </ul>

                 

        
            </div>
        </div>
    </section>
 

<?php require('Bottom.inc.php') ?>
<script>
         function updateQty(id,price,cal){
            var t = 0
              var qty = parseInt($('#qty'+id).html())
                if(cal=="minus") {
                    if(qty < 2) return
                    $('#qty'+id).html(qty - 1)
                    qty--
                }
                if(cal=="plus") {
                    $('#qty'+id).html(qty + 1)
                    qty++
                }
              $.ajax({
                  url:'Update.cart.php',
                  type:'post',
                  data:'qty='+qty+'&id='+id,
                  success:function(data){
                       if(data=="success"){
                       $('#total'+id).html((price * qty))
                       $('.subTotal').each(function(index,ele){
                            t =  t + parseInt(ele.innerHTML)
                            
                          })
                         $('#total').html('$'+t)
                    }
                      
                  }
              })
         }

</script>