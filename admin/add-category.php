<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
          if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }

          if(isset($_SESSION['upload']))
          {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
        ?>
        <br><br>

        <!-- Add Category form -->
         <form action="" method="POST" enctype="multipart/form-data">

         <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category">
                </td>
            </tr>
            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
         </table>

         </form>

    <?php 
    //check wether the button is clicked or not
    if(isset($_POST['submit']))
    {
       // echo "Clicked";

            //get the value
            $title = $_POST['title'];

            //for radio input get the value
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            //check the image is added or not and set the value for this
            //print_r($_FILES['image']);

            if(isset($_FILES['image']['name']))
            {
                    //uplopad the image and need the source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //upload the image only if image is selected
                    if($image_name!="")
                    {

                        //rename the image and get the extension of the image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;  //from food1.jpg--->to Food_Category_843.jpg

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check wether the image is uoload or not
                        if($upload==false)
                        {
                            $_SESSION['upload'] = " <div class='error'>Failed to Upload Image.</div> ";
                            header('location;'.SITEURL.'admin/add-category.php');
                            die();  //stop the process
                        }
                   }
            }
            else
            {
                $image_name="";
            }

            


            //sql to enter the data 
            // Correct SQL to insert data
            $sql = "INSERT INTO tbl_category SET
                   title = '$title',
                   image_name = '$image_name',
                   featured = '$featured',
                   active = '$active'";


            //execute the query
            $res = mysqli_query($conn, $sql);

            //check the sql is execute or not
            if($res==TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = " <div class='error'>Failed to Add Category.</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }
    }
    ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>