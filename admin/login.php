<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login </h1><br><br>

            <?php 
              if(isset($_SESSION['login'])) 
              {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
              }

              if(isset($_SESSION['no-login-message'])) 
              {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
              }
            ?>
            <br><br>


            <form class="text-center" action="" method="POST">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br> <br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br> <br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form><br><br>


            <p class="text-center">Created By - <a href="#">Jakaria & Emtiaz</a></p>
        </div>
    </body>
</html>



<?php 
//check wether the submit button is clicked or not
   if(isset($_POST['submit']))
   {
    //processs for login
    //1.Get the data from form
      $username = $_POST['username'];
      $password = md5($_POST['password']);

    //2.sql to check the username and password will match or not
    $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.Execute the query
    $res = mysqli_query($conn, $sql);

    //4.check wether the user exists or not
    $count = mysqli_num_rows($res);

        if($count==1)
        {
            //if username & pass match
            $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
            $_SESSION['user'] = $username; //check the user logedin or not

            header('location:'.SITEURL.'admin/');
        }
        else 
        {
            //if does not match
            $_SESSION['login'] = "<div class='error text-center'>Login Failed. Please try again.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    
   }
?>