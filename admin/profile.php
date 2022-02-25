<?php include "includes/admin_header.php"?>;
<?php include "../includes/db.php" ?>
<?php 

if(isset($_SESSION['username'])){

    $username =  $_SESSION['username'];
  
    $query ="SELECT * FROM users WHERE username = '{$username}'";

    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_password = $row['user_password'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
    }
}
?>

<?php 

if(isset($_POST['update_profile'])){

  
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


         $query = "UPDATE users SET ";
          $query .="user_firstname = '{$user_firstname}', ";
          $query .="user_lastname = '{$user_lastname}', ";
          $query .="username = '{$username}', ";
          $query .="user_password = '{$user_password}', ";
          $query .="user_email   = '{$user_email}', ";
          $query .= "WHERE username = '{$username}' ";

          $update_user = mysqli_query($connection,$query);

    confirm_query($update_user);
}



?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>;

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <h1 class="page-header">
                            Welcome to admin 
                            <small>Author</small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="title">First Name</label>
                                <input type="text" value="<?php echo $user_firstname?>" class="form-control"
                                    name="user_firstname">
                            </div>

                            <div class="form-group">
                                <label for="title">Last Name</label>
                                <input type="text" value="<?php echo $user_lastname?>" class="form-control"
                                    name="user_lastname">
                            </div>


                            <!-- User can change its role to something else, we also show the current  role -->
                            <!-- <div class="form-group">
                                <select name="user_role" id="user_role">
                                    <option value="Subscriber"><?php echo $user_role?></option>

                                    <?php
                
                                    if($user_role =='Admin'){
                                        echo "<option value='Subscriber'>Subscriber</option>";
                                    } else{
                                        echo "<option value='Admin'>Admin</option>";
                                    }
                                    
                                    ?>

                                </select>
                            </div> -->


                            <div class="form-group">
                                <label for="title">Username</label>
                                <input type="text" value="<?php echo $username?>" class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">User Email</label>
                                <input type="email" value="<?php echo $user_email?>" class="form-control"
                                    name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input type="password" autocomplete="off" class="form-control"
                                    name="user_password">
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                            </div>

                        </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"; ?>