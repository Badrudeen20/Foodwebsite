<?php
 include('Connection.inc.php');
 include('Function.inc.php');

$quantity = $_POST['qty'];
$attribute = $_POST['attr'];
$userid = $_POST['userid'];
$addedon= date('y-m-d');

if(isset($_POST)){

    //check update
    $user_cart_res = mysqli_query($conn,"select * from dish_cart where user_id = '$userid' and dish_detail_id = '$attribute'");
    if(mysqli_num_rows($user_cart_res) > 0){
        $update_cart_row = mysqli_fetch_assoc($user_cart_res); 
        $updatecartid = $update_cart_row['id'];
         mysqli_query($conn,"update dish_cart set qty = '$quantity' where id = '$updatecartid'");
         echo "update";
    }else{
        if(mysqli_query($conn,"insert into dish_cart (user_id,dish_detail_id,qty,added_on) values('$userid','$attribute','$quantity','$addedon')")){
            $cartsnum  =    mysqli_query($conn,"select id from dish_cart where user_id = '$userid'");
            $count = mysqli_num_rows($cartsnum);
            echo $count;
        }else{
            echo "Login";
        }
       
     
    }
   
                   
} 

 ?>