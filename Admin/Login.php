<?php
 include('Connection.inc.php');
 include('Function.inc.php');
 $msg = "";
 
 if(isset($_SESSION['ADMIN'])){
     redirect('Index.php');
 }
 if(isset($_POST['submit'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
       $user_res =  mysqli_query($conn,"select * from admin where username = '$username' and password ='$password'");
       if(mysqli_num_rows($user_res) > 0){
            $user_row = mysqli_fetch_assoc($user_res);
            $_SESSION['ADMIN'] = 'yes';
            $_SESSION['ADMIN_ID'] = $user_row['username'];
             redirect('Index.php');
       }else{
           $msg = "Invalid Email!";
       }

 }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/login.css" /> 
</head>
<body>

<h2>Login Form</h2>

<form  method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox"  name="remember"> Remember me
    </label>
  </div>
  <h2><?php echo $msg ?></h2>
  
</form>

</body>
</html>
