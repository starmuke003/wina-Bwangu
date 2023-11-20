<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>



   <form action="Login.php" method="post" >

<div class="background-img">
<img source src="Black And White Globe Y2k Streetwear Logo.png" type="img/png" alt="image" class="image">
</div>

  <div class="container">  
    
    <h2>LOGIN</h2>

<?php if(isset($_GET['error'])){ ?>
 
  <p class="error">

    <?php echo $_GET['error'];?>

  </p>

 <?php } ?>

    <label >user name:</label>
    <input  type="text" name="uname"  placeholder="user Name">

    <br>
    
    <label style="margin-left: 23px;">password:</label>
    <input type="password" name="password" placeholder="password">

    <br>

    
    <button href="WaytoHome.html" >LOGIN</button>

<p style="font-size: 48px; color: #fff;">Don't have an account?<a style="font-weight: bold;" href ="Signup.php">SignUp </a></p>

    </div>
</form>
</body>
</html>