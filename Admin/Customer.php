<?php 
require('Top.inc.php');


?>
      <main class="main-table">
        <!--========== HOME ==========-->
        <section class="table-container">
            <div>
               <h3>Dish Detail</h3>
             <div class="btn-group">
                 <a href="#">Users</a>
               
             </div>  
<table id="customers">
    <tr>
      <th>S.No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      
    </tr>
    <?php
     $user_res = mysqli_query($conn,"select * from users");
     if(mysqli_num_rows($user_res) > 0){
       $i=1;
        while($user_row = mysqli_fetch_assoc($user_res)){ ?>

    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $user_row['username'] ?></td>
      <td><?php echo $user_row['email'] ?> </td>
      <td><?php echo $user_row['phone'] ?></td>
    </tr>
           
     <?php $i++;   }
     }
    ?>



 
      
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