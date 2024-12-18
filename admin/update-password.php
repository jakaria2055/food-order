<?php include('partials/menu.php'); ?>

<div class="main-contenet">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
         
          if(isset($_GET['id']))
          {
            $id=$_GET['id'];
          }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>

<?php 
  //check wether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
    //get the data
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //check the user with current id and current password exist
    $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        $count = mysqli_num_rows($res);

        if($count==1)
        //user found and pass can be changed
        {
          // echo "User data found";
          if($new_password==$confirm_password)
          {
            //echo "//Update the password";
            $sql2 = "UPDATE tbl_admin SET
                    password = '$new_password'
                    WHERE id=$id 
                    ";

            //execuet teh query
            $res2 = mysqli_query($conn, $sql2);

            //check the query execute or not
            if($res2==TRUE)
            {
                //Print success
                $_SESSION['pwd-change'] = "<div class='success'>Password Changed Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['pwd-change'] = "<div class='error'>Failed to Change Password.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
          }
          else
          {
            //new password and confirm pass not match so message to redirect
            $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match.Try Again.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
          }
        }

        else 
        //user not exist and message to redirect
        {
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

    //check wether the new password and confirm password match

    //change password if all above condition is trrue
  }
?>

<?php include('partials/footer.php'); ?>