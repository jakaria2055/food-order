<?php

include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){
    //1.get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //2.remove image if available
    if($image_name != ""){
        $path = "../images/food/".$image_name;
        $remove = unlink($path);
        if($remove == false){
            $_SESSION['upload'] = "<div class='error'>Failed to remove image.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }

    //3.delete from db
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Food deleted.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }

}else{
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');



}

?>