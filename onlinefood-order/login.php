<?php
include('config/constants.php'); 
error_reporting(0); 
if(isset($_POST["submit"]))   // if button is submit
{
	$username = $_POST['username'];  
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"]))  
    {
	$loginquery ="SELECT * FROM users WHERE username='$username' && password='$password'"; //selecting matching records
	$result=mysqli_query($conn, $loginquery); //executing
	$row=mysqli_fetch_array($result);
	
		if(is_array($row))  // if matching records in the array & if everything is right
			{
					$_SESSION["user_id"] = $row['u_id']; 
					$_SESSION["login_logout"] = $row['u_id'];
					
					header("Location:index.php"); 
			} 
		else
			{
					$message = "Invalid Username or Password!"; 
			}
	 }
	
	
}
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css"/>

<style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #ff3300;
	  }
	  </style>
  
</head>

<body>
	
	<link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
	
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="grubhub.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
					

					    <?php 
							if(isset($_SESSION["login_logout"]))
							{
						?>	<li><a href="<?php echo SITEURL; ?>logout.php">Logout</a></li>
							<?php
							
							} 
							else{
								?>
								<li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
								<?php
							}
						?>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>	


<div class="pen-title">
  <h1>Login Form</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Login to your account</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
    <form action="" method="post">
      <input type="text" placeholder="Username"  name="username"/>
      <input type="password" placeholder="Password" name="password"/>
      <input type="submit" id="submit" name="submit" value="login" />
    </form>
  </div>
  
  <div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
</div>
 
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<?php include('menu/footer.php'); ?>

</body>

</html>
