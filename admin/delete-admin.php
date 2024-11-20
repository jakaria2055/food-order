<?php 

  //include constants.php file 
  include('../config/constants.php');

  //1.get the adminb id to delete
    $id = $_GET['id'];

  //2.sql query to delete this admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check query execute successfully or not
    if($res==TRUE)
    {
      //echo "Admin Deleted";
      $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

      header('location:'.SITEURL.'admin/manage-admin.php');
    }else
    {
        //echo "Execution failed";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin.Try again.</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
  //3.rederect the manage admin page with success or error massage
?>