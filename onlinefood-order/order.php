<?php include('menu/menu.php'); ?>

    <?php 
        //Check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
			
            //CHeck whether the data is available or not
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
				
				if(isset($_SESSION["login_logout"])){
					$price = $row['price'] * 0.9;
				}
				else{
					$price = $row['price'];
				}
				
                $image_name = $row['image_name'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <!-- FOOD SEARCH Section Starts Here -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">    <!--linking the css file for the font icons-->
    <section class="food-search2">
        <div class="container">
            <h1 style="font-size: 30px; font-family: Comic Sans MS;"><u>Shopping Cart</u><i class="fas fa-shopping-cart"></i></h1>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <?php 
                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {

                    $food = mysqli_real_escape_string ($conn,$_POST['food']);
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = mysqli_real_escape_string ($conn,$_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string ($conn,$_POST['contact']);
                    $customer_email = mysqli_real_escape_string ($conn,$_POST['email']);
                    $customer_address = mysqli_real_escape_string ($conn,$_POST['address']);


                    //Save the Order in Databaase
                    $sql2 = "INSERT INTO tbl_order (food,price,qty,total,order_date,status,customer_name,customer_contact,customer_email,customer_address) VALUES('$food','$price','$qty','$total','$order_date', '$status','$customer_name','$customer_contact','$customer_email','$customer_address')";                  
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully. Your delivery is on the way.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {              
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>
			
			
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">HKD&nbsp;<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John McCarthy" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="text" name="contact" placeholder="E.g. 60755890" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="text" name="email" placeholder="E.g. johnmccarthy90@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->

    <?php include('menu/footer.php'); ?>