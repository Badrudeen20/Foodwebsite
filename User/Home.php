<?php require('Top.inc.php') ?>
<section class="home" id="home">
     <div class="text">
         <p>Piada Italian Street Food</p>
         <p>Best Food</p>
         <div>
             <small>Piada Italian Street Food is a best Italian Food is a best Italian
               ensure resturent chines with 41 dish is ensure resturent
               server Store chines with 41 dish is ensure.
             </small>
         </div>
         <button class="banner-btn">Make Order</button>
     </div>
     <div class="banner">
        <img src="../img/plate6.png" />
     </div>
    </section>

    <section class="menu" id="menu">
        <h2>Special Menu</h2>
        <div class="flex">
            <ul>
                <?php 
                $category_res  = mysqli_query($conn,"select * from categories");
                while($category_row = mysqli_fetch_assoc($category_res)){ ?>
                <li onclick="foodCategory(<?php echo $category_row['id'] ?>)"><?php  echo $category_row['category'] ?></li>
               <?php } ?>
            </ul>
        </div>
        <div class="food">
            <ul id="foodCategory">
            <?php $dish_res = mysqli_query($conn,"select * from dish where status = 1"); 
                    while($dish_row = mysqli_fetch_assoc($dish_res)){ ?>
                <li>
                    <a href="#"><img src="../img/<?php echo $dish_row['image'] ?>" /></a>
                    <div class="flex">
                        <p><?php echo $dish_row['dish'] ?></p>
                        <div class="qty">
                            <i class="fi-rr-minus-small" data-qty="<?php echo $dish_row['id'] ?>"></i>
                            <span id="qty<?php echo $dish_row['id'] ?>">1</span>
                            <i class="fi-rr-plus-small" data-qty="<?php echo $dish_row['id'] ?>"></i>
                        </div>
                    </div>
                    <div class="desc">
                            <div><?php echo $dish_row['dish_detail'] ?></div>
                    </div>
                    <div class="space"></div>
                   <?php 
                   $price_res = mysqli_query($conn,"select id,dish_id,price from dish_detail GROUP BY dish_id");
                   while($price_row=mysqli_fetch_assoc($price_res)){ ?>
                     <?php if($price_row['dish_id']==$dish_row['id']){?>
                        <input type="hidden" id="dishid<?php echo $dish_row['id']?>" value="<?php echo $price_row['id'] ?>" />
                        <small class="price">$<?php echo $price_row['price'] ?></small>
                     <?php  } ?>
                   <?php  } ?>
                   
                    <div class="cartadd" onclick="addCart(<?php echo $dish_row['id'] ?>,<?php echo $userid ?>)" >
                        <i class="fi-rr-shopping-cart"></i>
                    </div>
                </li>
            <?php  }  ?> 


            </ul>
        </div>
        <div class="load"><button>Load More</button></div>
    </section>
       
       

    <section class="service" id="service">
        
         <div class="heading">
            <h2>Service</h2>
            <p>We provide the best in class services for our customer</p>
         </div>
       <div class="services">
           <ul>
               <li>
                   <img src="../img/service/fast.png"/>
                   <h4>Fast Food</h4>
                   <p>We offer our clients excellent quality services for many years food in the city.</p>
               </li>

               <li>
                <img src="../img/service/cutlery.png"/>
                <h4>Fast Food</h4>
                <p>We offer our clients excellent quality services for many years food in the city.</p>
            </li>

            <li>
                <img src="../img/service/delivery.png"/>
                <h4>Fast Food</h4>
                <p>We offer our clients excellent quality services for many years food in the city.</p>
            </li>
           </ul>
       </div>  
    </section>

    <section class="contact" id="contact">
        <h2>Contact Us</h2>
    <div class="contact-container">
        <div class="contact-img">
            <img src="../img/contact/contact.jpg" />
        </div>
      <div class="contact-form">
        
        <form>
            <div class="heading"><h4>Let's talk</h4></div>
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email" />
            <textarea placeholder="Comment"></textarea>
            <button type="submit">Comment</button>
        </form>
      </div>
    </div> 
    </section>
   

    <?php require('Bottom.inc.php') ?>
    <script>
      function addCart(id,user_id){
       const qty = $('#qty'+id).html()
       const dish_detail_id = $('#dishid'+id).val()  
    
        $.ajax({
                url:'Manage.cart.php',
                type:'post',
                data:'qty='+qty+'&attr='+dish_detail_id+'&userid='+user_id,
                success:function(data){
                     if(data!='update'){
                        $('#cart').html(data)
                     }

                     if(data == "Login"){
                         alert('Login First')
                     }
                }
            })

      }

      function foodCategory(id,userid){
           $.ajax({
               url:'Category.php',
               type:'post',
               data:'category='+id+'&userid='+userid,
               success:function(data){
                  $('#foodCategory').html(data)
               }
           })
      }
   </script>