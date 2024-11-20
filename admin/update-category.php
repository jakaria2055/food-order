<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
        
            //check id is set or not
            if(isset($_GET['id']))
            {
                //get the id and allincluding data
                $id = $_GET['id'];

                $sql="SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                //row count and check wether the id is valid or not
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "  <div class='error'> Category not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                         if($current_image!=="")
                         {
                            //display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                            <?php
                         }
                         else
                         {
                            //display error message
                            echo " <div class='error'>Image Not Added</div> ";
                         }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image
            if(isset($_FILES['image']['name']))
            { 
                //get the image details
                $image_name = $_FILES['image']['name'];
                
                //check the image is available or nbot
                if($image_name= "")
                {
                    //image available
                    //upload the new image

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
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();  //stop the process
                        }
                    if($current_image!=="")
                    {
                            //remove the current image
                            $remove_path = "../images/category/".$current_images;
                            $remove= unlink($remove_path);

                            //check wether the image is remove or not
                            if($remove==false)
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                    }
                    
                

                }
                else
                {
                    $image_name=$current_image;
                }
            }
            else
            {
                $image_name=$current_image;
            }

            //updating the data
            $sql2 = "UPDATE tbl_category SET
                     title='$title',
                     image_name='$image_name',
                     featured='$featured',
                     active='$active'
                     WHERE id=$id
                     ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2==TRUE)
            {
              $_SESSION['update'] = " <div class='success'>Category Updated Successfully</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['update'] = " <div class='success'>Failed to Category Updated</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }



        
        }
        
        
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>

