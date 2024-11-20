<?php include('partials-front/menu.php'); ?>

<?php 
  //check id passed or not
  if(isset($_GET['category_id']))
  {
    //get the category id 
    $category_id = $_GET['category_id'];
    //get the category id based on category id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    

    //get the value from database
    $row = mysqli_fetch_assoc($res);

    //get the title
    $category_title = $row['title'];

  }
  else
  {
    //category not found
    header('location:'.SITEURL);
  }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //sql to get food based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($res2);

            if($count>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                  $title = $row2['title'];
                  $price = $row2['price'];
                  $description = $row2['description'];
                  $image_name = $row2['image_name'];

                  ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                               if($image_name=="")
                               {
                                //image not available
                                echo "<div class='error'>Image not Available.</div>";
                               }
                               else
                               {
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                               }

                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                                 <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                  <?php

                }

            }
            else
            {
                //Food is not available
                echo " <div class='error'>Food not Available.</div> ";
            }
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>