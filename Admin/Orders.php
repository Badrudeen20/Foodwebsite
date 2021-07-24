<?php 
require('Top.inc.php');
$order_res = mysqli_query($conn,"select * from order_master order by id desc");

?>
      <main class="main-table">
        <!--========== HOME ==========-->
        <section class="table-container">
            <div>
               <h3>Order Detail</h3>
             <div class="btn-group">

                
             </div>  
<table id="customers">
    <tr>
      <th>Name/Email/Phone</th>
      <th>Address</th>
      <th>Order Detail</th>
      <th>Total Price</th>
      <th>Payment</th>
      <th>order</th>
      <th>Date</th>
    </tr>
    <?php while($order_row = mysqli_fetch_assoc($order_res)){ ?>
      <tr>
      <td>
        <?php echo $order_row['name'] ?><br/>
        <?php echo $order_row['email'] ?><br/>
        <?php echo $order_row['phone'] ?><br/>
      </td>
      <td><?php echo $order_row['address'] ?></td>
      <td><table>
        <?php
          $detail_sql = "select order_detail.price,order_detail.qty,dish_detail.attribute,dish.dish from order_detail,dish_detail,dish where order_detail.order_id = '".$order_row['id']."' and order_detail.dish_detail_id=dish_detail.id and dish_detail.dish_id = dish.id";
          $detail_res = mysqli_query($conn,$detail_sql);
          while($detail_row = mysqli_fetch_assoc($detail_res)){ ?>
            <tr>
              <td><?php echo $detail_row['dish'] ?></td>
              <td><?php echo $detail_row['attribute'] ?></td>
              <td><?php echo $detail_row['qty'] ?></td>
              <td><?php echo $detail_row['price'] ?></td>
            </tr>
        <?php  } ?>
          </table>
      </td>
      <td><?php echo $order_row['total_price'] ?></td>
      <td><?php echo $order_row['payment_status'] ?></td>
      <td> <?php echo $order_row['order_status'] ?></td>
      <td><?php echo $order_row['added_on'] ?></td>
    </tr>
    <?php } ?>
      
  </table>
            </div>
        </section>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/main.js"></script>
  <script>
     var href = window.location.href
     
     var active = getUrl(href,'/',"last")
     var link = getUrl(active,'.',"first")

    
     function getUrl(url,symble,index){
        var splitUrl = url.split(symble)
        if(index==="last")  return splitUrl[splitUrl.length-1]
        if(index==="first") return splitUrl[0] 
     }
    
    
    document.querySelectorAll('.url').forEach(function(ele,index){
      
   if(getUrl(ele.getAttribute('href'),'.',"first")==link){
     ele.classList.add('active')
   }
    })
    
  </script>
</body>
</html>