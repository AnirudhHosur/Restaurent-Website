<?php include('partials-front/menu.php');?>

    <?php
        //Check if food id is set or not
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];

            //Get the details of the food
            $sql = "SELECT * FROM tbl_food WHERE ID='$food_id'";
            $res = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //we have data
                while($row=mysqli_fetch_assoc($res))
                {
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                }
            }
            else
            {
                header("location:".SITE_URL);
            }
        }
        else
        {
            header("location:".SITE_URL);
        }
    ?>
    <br>
    <!-- fOOD sEARCH Section Starts Here -->
        <section class="food-search">
            <div class="container">
                
                <h2 class="text-center text-white">Fill this form to confirm your order.</h2>


                <form action="" method="POST" class="order">
                    <fieldset>
                        <legend>Selected Food</legend>

                        <div class="food-menu-img">
                            <?php 
                            // check wetather image avaible or nt
                            if($image_name=="")
                            {
                                //image not avaible 
                                echo "<div>Image not avaible</div>";
                            }
                            else
                            {
                                //Image is avaible
                                ?>
                                <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php 
                            }
                            ?>
                        </div>
        
                        <div class="food-menu-desc">
                            <h3><?php echo $title;?></h3>
                            <input type="hidden" name="food" value="<?php echo $title;?>">

                            <p class="food-price"><?php echo $price?></p>
                            <input type="hidden" name="price" value="<?php echo $price;?>">

                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" required>
                            
                        </div>

                    </fieldset>
                    
                    <fieldset>
                        <legend>Delivery Details</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                        <div class="order-label">Address</div>
                        <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </fieldset>

                </form>

                <?php 
                    //Check weather submit button is cliekc or not
                    if(isset($_POST['submit']))
                    {
                        //Button is clicked
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $total = $price*$qty;
                        $order_date = date("Y-m-d h:i:sa"); //order date
                        $status = "Ordered";
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];

                        //Save the order in dB
                        $sql2 = "INSERT INTO tbl_order SET
                            food = '$food',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = $order_date,
                            status = '$status',
                            $customer_name = '$customer_name',
                            $customer_contact = '$customer_contact',
                            $customer_email = '$customer_email',
                            $customer_address = '$customer_address'
                        ";

                        $res2 = mysqli_query($connect, $sql2);

                        //Check weather query exceuted
                        if($res2==True)
                        {
                            //Query executed succesfuly
                            $_SESSION['order'] = "Order placed success";
                            header("location:".SITE_URL);
                        }
                        else
                        {
                            //Failed to save order 
                            $_SESSION['order'] = "Order placed failed";
                            header("location:".SITE_URL);
                        }

                    }
                ?>

            </div>
        </section>
        <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>