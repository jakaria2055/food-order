<?php 
  include('../config/constants.php');

    //check the category is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //find the category and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //delete the image from folder if available
        if($image_name!="")
        {
            //image avao;able and delete it from images/category folder
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            //if failed to delete
            if($remove==false)
            {
                $_SESSION['remove']= " <div class='error'>failed to delete category image.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop deleting process
                die();
            }
        }

        //delete the data 
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['delete']=" <div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete']=" <div class='error'> Failed to Delete Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //do not find and return to main page
        header('location:'.SITEURL.'admin/manage-category.php');
    }


?>