<?php include('partials-front/menu.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Create sql query to display the categories from dB
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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

                        <a href="<?php echo SITE_URL;?>category-foods.php?category_id=<?php echo $id; ?>">
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


    <?php include('partials-front/footer.php');?>