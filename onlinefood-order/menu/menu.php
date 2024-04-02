<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrubHub</title>
    <!-- Link to CSS file -->
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>

<body>
    <!-- Navbar Section Starts Here -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
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

					<li>
					    <?php 
							if(isset($_SESSION["login_logout"]))
							{
						?>	<a href="logout.php">Logout</a>
							<?php
							
							} 
							else{
								?>
								<a href="login.php">Login</a>
								<?php
							}
						?>
					</li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->