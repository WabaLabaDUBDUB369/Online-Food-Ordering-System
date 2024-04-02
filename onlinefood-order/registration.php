<!DOCTYPE html>
<html lang="en">



<?php

session_start(); 
error_reporting(0); 
include('config/constants.php'); // connection





if(isset($_POST['submit'] )) //if submit btn is pressed
{
     if(empty($_POST['firstname']) ||  
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['username']) ||
		empty($_POST['cpassword']))
		{
			$message = "All fields must be Required!";
			echo $message;
		}
	else
	{
	$check_username= mysqli_query($conn, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($conn, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  //matching passwords
       	$message = "Password does not match";
		echo $message;
    }
	elseif(strlen($_POST['password']) < 4)  //check password length
	{
		$message = "Password Must be >=4";
		echo $message;
	}
	elseif(strlen($_POST['phone']) < 8)  //check phone length
	{
		$message = "Invalid phone number!";
		echo $message;
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
       	$message = "Invalid email address please type a valid email!";
		echo $message;
    }
	elseif(mysqli_num_rows($check_username) > 0)  //check username
     {
    	$message = 'Username Already exists!';
		echo $message;
     }
	elseif(mysqli_num_rows($check_email) > 0) //check email
     {
    	$message = 'Email Already exists!';
		echo $message;
     }
	else{
       
	 //inserting values into db 
	$username = mysqli_real_escape_string ($conn, $_POST['username']);
	$f_name = mysqli_real_escape_string ($conn, $_POST['firstname']);
	$l_name = mysqli_real_escape_string ($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string ($conn, $_POST['email']);
	$phone = mysqli_real_escape_string ($conn, $_POST['phone']);
	$password = mysqli_real_escape_string ($conn, $_POST['password']);
	$address = mysqli_real_escape_string ($conn, $_POST['address']);
	
	
	$sql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('$username','$f_name','$l_name','$email','$phone','$password','$address')";
	if(mysqli_query($conn, $sql)){
		header('Location: login.php');
	}else{
		echo 'query error: ' . mysqli_error($conn);
	}
	
		
    }
	}

}
?>





<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Sign Up</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> </head>
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
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
					<li>
						<a href="login.php">Login</a>
					</li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
	
			
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                              
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">User-Name</label>
                                       <input class="form-control" type="text" name="username" id="username" placeholder="UserName"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">First Name</label>
                                       <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Last Name</label>
                                       <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Email address</label>
                                       <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Phone number</label>
                                       <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone"> <small class="form-text text-muted">We"ll never share your email with anyone else.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input type="text" class="form-control" name="password" id="password" placeholder="Password"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Repeat password</label>
                                       <input type="text" class="form-control" name="cpassword" id="cpassword" placeholder="Password"> 
                                    </div>
									 <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Delivery Address</label>
                                       <textarea class="form-control" id="address"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                           
						   </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
           
		 
	<?php include('menu/footer.php'); ?>
      
</body>


</html>