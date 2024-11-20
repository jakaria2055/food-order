<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
             //Get the id 
             $id=$_GET['id'];
             //create sql query to get details
             $sql="SELECT * FROM tbl_admin WHERE id=$id";
             //Execute the query
             $res=mysqli_query($conn, $sql);
             //check the sql is executed or not
             if($res==TRUE)
             {
                //check the data is available or not
                $count = mysqli_num_rows($res);
                //check have admin data or not
                if($count==1)
                {
                    //get the details
                    //echo "ADmin available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //rederect to manage-admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
             }
        ?>

        <Form action="" method="POST">

            <table class="tbl-30">
               <tr>
                 <td>Full Name</td>
                 <td>
                    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                 </td>
               </tr>

               <tr>
                 <td>Username</td>
                 <td>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                 </td>
               </tr>

               <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
               </tr>
            </table>

        </Form>

    </div>
</div>

<?php 
    //check wether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button clicked";
        //get teh value from the form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //sql query to update admin
        $sql ="UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check query execute successfully or not
        if($res==TRUE)
        {
            //Update sql execute successsfully
            $_SESSION['update'] = "<div class='success'>Admin info update successfully</div>";
            //rediredct to the manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to update execute 
            $_SESSION['update'] = "<div class='error'>Failed to admin info update</div>";
            //rediredct to the manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php');?>