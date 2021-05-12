<?php include('partials-front/menu.php')?>

<?php
    //Check weather category Id is passed or not from index.html
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        // Get the category title
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($connect, $sql);

        //Get the value from dB
        $row = mysqli_fetch_assoc($res);

        $category_title=$row['title'];
    }
    else
    {
        header("location:".SITE_URL);
    }
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //SQl query to get food based on category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res2 = mysqli_query($connect, $sql2);
                $count = mysqli_num_rows($res);
                
                if($count>0)
                {
                    //Food exists for that category
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Check for image
                                    if($image_name="")
                                    {
                                        //Image avaible
                                        ?>
                                        <img src="<?php echo SITE_URL;?>images/food/<?php echo $image_name; ?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    else
                                    {
                                        //Image not avaible
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
                    //Food not avaible for that category
                    echo "<div>Food not found.</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>