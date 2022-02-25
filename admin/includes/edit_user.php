<?php include "../includes/db.php";?>
<?php 

if(isset($_GET['edit_user'])){

   $the_user_id = $_GET['edit_user'];

   $query = "SELECT * FROM users Where user_id = $the_user_id";
   $select_users_query= mysqli_query($connection, $query);

   // we can have a loop under the <ul> tag to show all the category names as <li>    

   while ($row = mysqli_fetch_assoc($select_users_query)){ // row is like a database here, we can use it to get data from each coloumn
       $user_id = $row['user_id'];
       $username = $row['username'];
       $user_firstname = $row['user_firstname'];
       $user_password = $row['user_password'];
       $user_lastname = $row['user_lastname'];
       $user_image = $row['user_image'];
       $user_email = $row['user_email'];
       $user_role = $row['user_role'];

}



if(isset($_POST['edit_user'])){

  
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if(!empty($user_password)){

        $query_passowrd = "SELECT * FROM users WHERE user_id=$the_user_id";
        $get_user_query = mysqli_query($connection,$query_passowrd);
        confirm_query($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password){

            $hashed_password = password_hash('$password',PASSWORD_DEFAULT,array('cost'=>12));
    
        }

    }
    

         $query = "UPDATE users SET ";
          $query .="user_firstname = '{$user_firstname}', ";
          $query .="user_lastname = '{$user_lastname}', ";
          $query .="username = '{$username}', ";
          $query .="user_password = '{$hashed_password}', ";
          $query .="user_email   = '{$user_email}', ";
          $query .="user_role= '{$user_role}' ";
          $query .= "WHERE user_id = {$the_user_id} ";

          $update_user = mysqli_query($connection,$query);

    confirm_query($update_user);


}

}else{

    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
        <!-- <h4 class="text-center bg-success">User Updated</h4> -->

         <label for="title">First Name</label>
          <input type="text" value="<?php echo $user_firstname?>" class="form-control" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="title">Last Name</label>
          <input type="text" value="<?php echo $user_lastname?>" class="form-control" name="user_lastname">
      </div>

    
    <!-- User can change its role to something else, we also show the current  role -->
      <div class="form-group">
            <select name="user_role" id="user_role" >
                <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
                
                <?php
                
                if($user_role =='Admin'){
                    echo "<option value='Subscriber'>Subscriber</option>";
                } else{
                    echo "<option value='Admin'>Admin</option>";
                }
                
                ?>

            </select>
        </div>


      <div class="form-group">
         <label for="title">Username</label>
          <input type="text" value="<?php echo $username?>" class="form-control" name="username">
      </div>

      <div class="form-group">
         <label for="post_tags">User Email</label>
          <input type="email" value="<?php echo $user_email?>" class="form-control" name="user_email">
      </div>

      <div class="form-group">
         <label for="post_tags">Password</label>
          <input type="password" autocomplete="off" class="form-control" name="user_password">
      </div>
   

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
      </div>

</form>

