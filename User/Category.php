<?php 
include('Connection.inc.php');

if(isset($_POST)){
    $category = $_POST['category'];
    $userid = $_POST['userid'];
    $dish_res = mysqli_query($conn,"select * from dish where  category_id = '$category'");
    $li  ='';
    while($dish_row = mysqli_fetch_assoc($dish_res)){
        $li .=  '<li>
               <a href="#"><img src="../img/'. $dish_row['image'].'" /></a>
               <div class="flex">
                 <p>'. $dish_row['dish'].'</p>
                  <div class="qty">
                   <i class="fi-rr-minus-small" data-qty="'. $dish_row['id'].'"></i>
                   <span id="qty'.$dish_row['id'].'">1</span>
                   <i class="fi-rr-plus-small" data-qty="'.$dish_row['id'] .'"></i>
                 </div>
               </div>
               <div class="desc">
                 <div>'.$dish_row['dish_detail'] .'</div>
               </div>
               <div class="space"></div>';
                $price_res = mysqli_query($conn,"select id,dish_id,price from dish_detail GROUP BY dish_id");
                while($price_row=mysqli_fetch_assoc($price_res)){ 
                    if($price_row['dish_id']==$dish_row['id']){
                        $li.='<input type="hidden" id="dishid'. $dish_row['id'].'" value="'. $price_row['id'] .'" />
                             <small class="price">$'.$price_row['price'] .'</small>';
                       } 
                     }
                    $li .='<div class="cartadd" onclick="addCart('. $dish_row['id'] .','.$userid .')" >
                        <i class="fi-rr-shopping-cart"></i>
                    </div>
               </li>';
    }

    echo $li;
}
 
?>