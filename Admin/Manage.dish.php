<?php 
include('Top.inc.php');

$msg = "";
$dish = "";
$dishdetail = "";
$image = "";
$categoryid= "";
$id = "";
$imgrequired = "required";
//Edit Dish
if(isset($_GET['type']) && $_GET['type']=="Edit"){
  $id = $_GET['id'];
  $imgrequired ="";
   $dish_res  = mysqli_query($conn,"select * from dish where id = '$id'");
   if(mysqli_num_rows($dish_res) > 0){
      $dish_row = mysqli_fetch_assoc($dish_res);
      $dish = $dish_row['dish'];
      $dishdetail = $dish_row['dish_detail'];
      $categoryid = $dish_row['category_id'];
      $image = $dish_row['image'];

      
   }
}

//delete Dish Attribute

if(isset($_GET['type']) && $_GET['type']=="delete"){
  $id = $_GET['id'];
 
   $dish_res  = mysqli_query($conn,"delete from dish_detail where id = '$id'");
   if(mysqli_num_rows($dish_res) > 0){
      $dish_row = mysqli_fetch_assoc($dish_res);
      $dish = $dish_row['dish'];
      $dishdetail = $dish_row['dish_detail'];
      $categoryid = $dish_row['category_id'];
      $image = $dish_row['image'];
   }
}



if(isset($_POST['submit'])){
   $dish = $_POST['dish'];
   $dishdetail = $_POST['detail'];
   $categoryid  = $_POST['category'];
   $attributeArr = $_POST['attr'];
   $priceArr = $_POST['price'];
   $addedon = date('y-m-d');
  
  // print_r($_POST);
   //die();
   //check duplice
    $check_dublicate = mysqli_query($conn,"select * from dish where dish = '$dish'");
    if(mysqli_num_rows($check_dublicate) > 0){
       $check_row = mysqli_fetch_assoc($check_dublicate);
        if(isset($_GET['id']) && $_GET['id'] >0){
          if($check_row['id'] == $id){
             $imageCondition = '';
            if($_FILES['image']['name']!=""){
                 $image = $_FILES['image']['name'];
                 move_uploaded_file($_FILES['image']['tmp_name'],FILE_PATH.$_FILES['image']['name']);
                 $imageCondition =", image='$image'";
            }
              if(mysqli_query($conn,"update dish set dish = '$dish',category_id='$categoryid',
                 dish_detail='$dishdetail' $imageCondition  where id = '$id'")){
                  $dishdetailidArr = $_POST['dish_detail_id'];
                  foreach($attributeArr as  $key=>$val){
                       $attr = $val;
                       $price = $priceArr[$key];
                       if(isset($dishdetailidArr[$key])){
                         $updateid = $dishdetailidArr[$key];
                        mysqli_query($conn,"update dish_detail set attribute='$attr',price='$price',added_on='$addedon' where id = '$updateid'") ;
                        
                       }else{
                        mysqli_query($conn,"insert into dish_detail (dish_id,attribute,price,status,added_on) 
                        values('$id','$attr','$price',1,'$addedon')");
                       }
                     
                       
                  }

                redirect('Dish.php');
              }

          }else{
            $msg = "Category Already Exist";
          }
        }else{
          $msg = "Category Already Exist";
        }
    }
    if($msg==""){
      $image = $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'],FILE_PATH.$_FILES['image']['name']);
         if(mysqli_query($conn,"insert into dish (dish,category_id,dish_detail,image,status,added_on)
          values('$dish','$categoryid','$dishdetail','$image',1,'$addedon')")){
            $did = mysqli_insert_id($conn);
            foreach($attributeArr as  $key=>$val){
                 $attr = $val;
                 $price = $priceArr[$key];
                mysqli_query($conn,"insert into dish_detail (dish_id,attribute,price,status,added_on) 
                 values('$did','$attr','$price',1,$addedon)");
                 
            }

            redirect('Dish.php');
       }
    }
  
} 

?>
      <main class="l-main">
        <!--========== HOME ==========-->
        <section class="manage_container">
            <h2>Manage Dish</h2>
            <div class="form">

                <form method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label>Dish</label>
                        <input type="text" name="dish" placeholder="Name" value="<?php echo $dish ?>"  required />
                    </div>
                    
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                          <?php
                           $category_res = mysqli_query($conn,"select * from categories"); 
                            while($category_row = mysqli_fetch_assoc($category_res)){ ?>
                                 <?php if($category_row['id'] == $categoryid){ ?>
                                  <option value="<?php echo $category_row['id'] ?>" selected><?php echo $category_row['category'] ?></option> 
                              <?php  }else{  ?>
                                <option value="<?php echo $category_row['id'] ?>" ><?php echo $category_row['category'] ?></option> 
                                <?php  } ?>  
                          <?php  } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Dish Detail</label>
                        <input type="text" name="detail" placeholder="Dish detail" value="<?php echo $dishdetail ?>"  required />
                    </div>

                    <div class="form-group">
                        <label>Dish Detail</label>
                        <div class="file-upload-wrap" id="upload" data-text="Select Image">
                            <input type="file" name="image" placeholder="Image" 
                            class="file-upload-field" <?php echo $imgrequired ?>/>
                        </div>
                    </div>
                  
                   <!--attribute field -->
                   
                  <div class="attr-group" id="attr-group"> 
                      <?php  if($id > 0){ ?>
                          <?php
                             $dish_detail_res = mysqli_query($conn,"select * from dish_detail where dish_id = '$id'");
                            $i = true;
                            while($dish_detail_row = mysqli_fetch_assoc($dish_detail_res)){?> 
                                 <div class="flex">
                                 <input type="hidden"  value="<?php echo $dish_detail_row['id'] ?>" name="dish_detail_id[]" />
                                      <div class="form-group">
                                     
                                           <label>Attribute</label>
                                           <input type="text" name="attr[]" placeholder="Attribute" value="<?php echo $dish_detail_row['attribute'] ?>" />
                                      </div>
                        
                                    <div class="wrap active">
                        
                                       <div class="form-group">
                                      
                                            <label>Price</label>
                                            <input type="text" name="price[]" placeholder="price"  value="<?php echo $dish_detail_row['price'] ?>" />
                                      </div>
                                    <?php if($i){ ?>
                                      <div class="form-group hidden">
                                          <label>Remove </label>
                                          <button class="btn">Remove</button>
                                      </div>
                                    <?php }else{ ?>
                                      <div class="form-group ">
                                          <label>Remove </label>
                                          <a href="?type=delete&id=<?php echo $dish_detail_row['id'] ?>" class="btn" >Remove</a>
                                      </div>
                                  <?php  } ?>
                                     
  
                                    </div>
                                 </div>   
                           <?php $i = false; } ?>
                       <?php }else{?>
                    <div class="flex">
                         <div class="form-group">
                            <label>Attribute</label>
                            <input type="text" name="attr[]" placeholder="Attribute"  />
                          </div>
                        
                          <div class="wrap active">
                        
                            <div class="form-group">
                             
                              <label>Price</label>
                              <input type="text" name="price[]" placeholder="price" />
                            </div>
   
                             <div class="form-group hidden">
                               <label>Remove </label>
                              <button  class="btn">Remove</button>
                             </div>
  
                         </div>
                    </div>    
                  <?php }?>
                
                   <input type="hidden" id="deleteAttr" type="text" value="1" />
                  </div> 
                  
                
                 
                    <div class="btn-group">
                      <button class="btn" type="submit" name="submit">Submit</button>
                      <button  onclick="addAttribute()" class="btn" type="button" >Add More</button>
                    </div>
                </form>
             </div>
            
              <div  class="error"><?php echo $msg ?></div>
        </section>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/main.js"></script>
  <script>
       var id = $('#deleteAttr').val()
      
       function addAttribute(){
          var addAttr = $(`<div class="flex" id="del${id}">
                        <div class="form-group">
                           <label>Attribute</label>
                           <input type="text" name="attr[]" placeholder="Attribute"  />
                         </div>

                       <div class="wrap">
                        
                          <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price[]" placeholder="price" />
                          </div>
 
                           <div class="form-group">
                             <label>Remove </label>
                            <button onclick="removeAttr(${id})" class="btn">Remove</button>
                           </div>

                       </div>
                         
                   </div>`)[0]
                   var attribute = $('#attr-group')[0]
                      attribute.append(addAttr)
                   id++

       }


       function removeAttr(id){
         $('#del'+id).remove()
       }
   
  </script>
</body>
</html>