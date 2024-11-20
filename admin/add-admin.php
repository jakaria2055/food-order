<?php include('partials/menu.php'); ?>

  <div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add'])) //checking the session is set or not
        {
            echo $_SESSION['add'];  //display if the sesssion is set
            unset($_SESSION['add']);  //clear the message
        }
        ?>

        <form action="" method="POST"> 
        <table class="tbl-30">
           <tr>
            <td>Full Name: </td>
            <td>
                <input type="text" name="full_name" placeholder="Enter your name">
            </td>
           </tr>

           <tr>
            <td>Username: </td>
            <td>
                <input type="text" name="username" placeholder="Enter Username">
            </td>
           </tr>

           <tr>
            <td>Password: </td>
            <td>
                <input type="password" name="password" placeholder="Password">
            </td>
           </tr>

           <tr>
              <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
              </td>
           </tr>
        </table>
        </form>

    </div>
  </div>

<?php include('partials/footer.php'); ?>


<?php 
 //process the value and save it in database
 //check the submit button clicked or not

 if(isset($_POST['submit'])){
    //1.take data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2.save data into database
    $sql = " INSERT INTO tbl_admin SET 
             full_name = '$full_name',
             username = '$username',
             password = '$password'
    ";

    
    //3.executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //check wether the (query is executed) data is inserted or not and display appropiate message
    if($res==TRUE){
        //data inserted
        //echo "Data Inserted";
        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //failed to inserted data
        //echo "Data inseted failed";
         //create a session variable to display message
         $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
         //redirect page to manage admin
         header("location:".SITEURL.'admin/add-admin.php');
    }


 }


    

?>