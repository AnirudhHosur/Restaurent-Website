<?php include('partials-front/menu.php')?>

    <!-- fOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">   
        <div class="container">
            
            <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Create sql query to display the categories from dB
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $res = mysqli_query($connect, $sql);
                
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories avaible
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values id, image, title
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITE_URL;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check weather img is avaible or not
                                if($image_name=="")
                                {
                                    echo "Image not avaible";
                                }
                                else
                                {
                                    //Image avaible 
                                    ?>
                                    <img src="<?php echo SITE_URL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                } 
                                ?>

                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                        </a>

                    <?php

                    }
                }
                else
                {
                    //categories not avaible
                    echo "category not added";
                }
            ?>        

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Get the data from food
                $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $res = mysqli_query($connect, $sql);
                
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Foods exists
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Check if image exsits or not
                                    if($image_name=="")
                                    {
                                        //Image does not exists
                                        echo "<div>Image not avaible</div>";
                                    }
                                    else
                                    {
                                        //Image exists
                                        ?>
                                        <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php SITE_URL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //Food not avavible
                    echo "Food not avaivle";
                }
            ?>

            

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here --> 

    <?php include('partials-front/footer.php');?>