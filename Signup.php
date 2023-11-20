<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

       <?php if (isset($_GET['success'])) { ?>
     		<p class="success"><?php echo $_GET['success']; ?></p>
     	<?php } ?>


  <label style="margin-right: 300px;">Name:</label>  
       <?php if (isset($_GET['name'])) { ?>
     		         <input type="text" 
                 name="name" 
                 placeholder="Name"
                 value="<?php echo $_GET['name']; ?>"><br>
     	<?php }else{ ?>
              <input type="text" 
              name="name" 
              placeholder="Name"><br> 
        <?php } ?>

    <label style="margin-right: 45px;">User Name:</label>
         
       <?php if (isset($_GET['uname'])) { ?>
     		         <input type="text" 
                 name="uname" 
                 placeholder="User Name"
                 value="<?php echo $_GET['uname']; ?>"><br>
     	<?php }else{ ?>
              <input type="text" 
              name="uname" 
              placeholder="User Name"><br> 
        <?php } ?>

     	<label style="margin-right: 100px;">password:</label>
     	<input type="password" 
              name="password" 
              placeholder="Password"><br>

       <label style="margin-right: 80px;">password: </label>
     	<input type="password"
             name="re_password"     
             placeholder="Re_Password"><br>

        
             <input type="hidden" name="action" value="index.php">

             <button href="WaytoHome.html" >SIGN UP</button>

          <a href="index.php" class="ca">already have an account?</a>
     </form>

</body>
</html>