<?php
include('Top.inc.php');
 //update status
 if(isset($_GET['type']) && $_GET['type']=="Active"){
   $Activeid = $_GET['id'];
   $update_status = mysqli_query($conn,"update categories set status = 1 where id = '$Activeid'");
 }

 if(isset($_GET['type']) && $_GET['type']=="Deactive"){
  $Deactiveid = $_GET['id'];
  $update_status = mysqli_query($conn,"update categories set status = 0 where id = '$Deactiveid'");
}
 
//delete category


if(isset($_GET['type']) && $_GET['type']=="Delete"){
  $Deleteid = $_GET['id'];
  $update_status = mysqli_query($conn,"delete from categories  where id = '$Deleteid'");
}

 //Fetch category data
 $category_res = mysqli_query($conn,"select * from categories");

?>
      <main class="main-table">
        <!--========== HOME ==========-->
        <section class="table-container">
            <div>
               <h3>Dish Detail</h3>
             <div class="btn-group">
                 <a href="#">Dish</a>
                 <a href="Manage.category.php">+Add</a>
             </div>  
<table id="customers">
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Status</th>
      <th>Action</th>
      
    </tr>
    <?php 
    $i =1;
     while($category_row = mysqli_fetch_assoc($category_res)){ ?>
             <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $category_row['category']; ?></td>
     
      <td>
        <?php if($category_row['status']==1) {?>
          <a class="btn" href="?type=Deactive&id=<?php echo $category_row['id'] ?>">Active</a>
          <?php }else{?>
            <a class="btn" href="?type=Active&id=<?php echo $category_row['id'] ?>">Deactive</a>
          <?php } ?>
      </td>
      <td>
        <a class="btn" href="Manage.category.php?type=Edit&id=<?php echo $category_row['id'] ?>">Edit</a>
        <a class="btn" href="?type=Delete&id=<?php echo $category_row['id'] ?>">Delete</a>
      </td>
    </tr>
    <?php $i++; } ?>
   

 
      
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