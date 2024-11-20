<?php 
    //authorization & access control
    //check the user loggedin or not
    if(!isset($_SESSION['user']))//if user is not set
    {
        //user is not logged in
        //redderect tio login page
        $_SESSION['no-login-message'] = " <div class='error text-center'>Please login to acces Admin Panel.</div> ";
        //rederect to login page
        header('location:'.SITEURL.'admin/login.php');

    }
?>