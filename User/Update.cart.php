<?php 
 include('Connection.inc.php');
 include('Function.inc.php');
$qty = $_POST['qty'];
$id = $_POST['id'];

if(isset($_POST)){
     mysqli_query($conn,"update dish_cart set qty='$qty' where id ='$id'");
    echo "success";
}

?>