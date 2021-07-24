<?php 
include('Top.inc.php');
$msg = "";
$category = "";
$id = "";
if(isset($_GET['type']) && $_GET['type']=="Edit"){
  $id = $_GET['id'];
   $category_res  = mysqli_query($conn,"select * from categories where id= '$id'");
   if(mysqli_num_rows($category_res) > 0){
      $category_row = mysqli_fetch_assoc($category_res);
      $category = $category_row['category'];
   }
}






if(isset($_POST['submit'])){
   $category = $_POST['category'];
   //check duplice
    $check_dublicate = mysqli_query($conn,"select * from categories where category = '$category'");

    if(mysqli_num_rows($check_dublicate) > 0){
       $check_row = mysqli_fetch_assoc($check_dublicate);
      
        if(isset($_GET['id']) && $_GET['id'] >0){
          if($check_row['id'] == $id){
              if(mysqli_query($conn,"update categories set category = '$category' where id = '$id'")){
                redirect('Category.php');
              }

          }else{
            $msg = "Category Already Exist";
          }
        }else{
          $msg = "Category Already Exist";
        }
    }

    if($msg=="" && $id > 0){
      if(mysqli_query($conn,"update categories set category = '$category' where id = '$id'")){
        redirect('Category.php');
      }
  }


    if($msg=="" && $id < 0){
        if(mysqli_query($conn,"insert into categories (category,status) values('$category',1)")){
        redirect('Category.php');
        }
    }
  
} 

?>

      <main class="l-main">
        <!--========== HOME ==========-->
        <section class="manage_container">
            <h2>Manage Category</h2>
            <div class="form">
                <form method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label>Dish Category</label>
                        <input type="text" name="category" placeholder="Category" value="<?php echo $category ?>"  required />
                    </div>            
                 
                    <div class="btn-group">
                      <button class="btn" type="submit" name="submit">Submit</button>
                      
                    </div>
                </form>
             </div>
             <input type="hidden" value="1" id="genarate_id" />
              <div class="error"><?php echo $msg ?></div>
        </section>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/main.js"></script>
</body>
</html>