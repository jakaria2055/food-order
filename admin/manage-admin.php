<?php include('partials/menu.php'); ?>

   <!-- Main-content Start -->
   <div class="main-content">
      <div class="wrapper">
       <h1>Manage Admin</h1>
       <br>

       <?php 
       
        if(isset($_SESSION['add']))
        {
           echo $_SESSION['add'];  //display if the sesssion is set
           unset($_SESSION['add']);  //clear the message
        }

        if(isset($_SESSION['delete']))
        {
           echo $_SESSION['delete'];  //display if the sesssion is set
           unset($_SESSION['delete']);  //clear the message
        }

        if(isset($_SESSION['update']))
        {
           echo $_SESSION['update'];  //display if the sesssion is set
           unset($_SESSION['update']);  //clear the message
        }

        if(isset($_SESSION['user-not-found']))
        {
           echo $_SESSION['user-not-found'];  //display if the sesssion is set
           unset($_SESSION['user-not-found']);  //clear the message
        }

        if(isset($_SESSION['pwd-not-match']))
        {
           echo $_SESSION['pwd-not-match'];  //display if the sesssion is set
           unset($_SESSION['pwd-not-match']);  //clear the message
        }

        if(isset($_SESSION['pwd-change']))
        {
           echo $_SESSION['pwd-change'];  //display if the sesssion is set
           unset($_SESSION['pwd-change']);  //clear the message
        }

       ?>
       <br><br><br>

   <!-- Button-add admin -->
      <a href="add-admin.php" class="btn-primary">Add Admin</a>
      <br><br><br>

       <table class="tbl-full">
         <tr>
           <th>S.N.</th>
           <th>Full Name</th>
           <th>Username</th>
           <th>Actions</th>
         </tr>

         <?php 
         $sql = "SELECT * FROM tbl_admin";   //query to get all admin
         $res = mysqli_query($conn, $sql); //Execute the query

         //check the query is executed or not
         if($res==TRUE)
         {
            //count rows to check have data in database or not
            $count = mysqli_num_rows($res); //function to get all rows in database

            //check the number of rows
            if($count>0)
            {
               //have data in database
               $sn=1;
               while($rows=mysqli_fetch_assoc($res))
               {
                  //loop to get all the data from the database
                  //loop will run as long as we have data in database

                  //get individual data
                  $id = $rows['id'];
                  $full_name = $rows['full_name'];
                  $username = $rows['username'];

                  //display teh values in our table
                  ?>

                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                    </td>
                 </tr>

                  <?php
               }
            }
            else
            {
               //we do not have data in database
            }
         }
         

         ?>

       </table>

      </div>
   </div>
   <!-- Main-content End -->

<?php include('partials/footer.php'); ?>
