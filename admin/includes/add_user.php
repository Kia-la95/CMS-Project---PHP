<?php include "../includes/db.php";?>
<?php 

if(isset($_POST['create_user'])){

    //echo $_POST['create_post'];


    //$post_id = $_POST['post_id'];
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
   
    $user_password = password_hash($user_password,PASSWORD_DEFAULT,array('cost' => 10));

    $query = "INSERT INTO users( username, user_firstname, user_lastname, user_password, user_role, user_email) ";
    $query .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$user_password}','{$user_role}', '{$user_email}') ";

    $create_user_query = mysqli_query($connection, $query);

    confirm_query($create_user_query);

    echo "User Created: ". " " . "<a href='users.php'>View All Users</a>";
}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
    <div class="form-group">
         <label for="title">First Name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="title">Last Name</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>

    

      <div class="form-group">
            <select name="user_role" id="user_role" >
                <option value="Subscriber">Select Options</option>
                <option value="Admin">Admin</option>
                <option value="Subscriber">Subscriber</option>
       
            </select>
        </div>

      <div class="form-group">
         <label for="title">Username</label>
          <input type="text" class="form-control" name="username">
      </div>

      <div class="form-group">
         <label for="post_tags">User Email</label>
          <input type="email" class="form-control" name="user_email">
      </div>

      <div class="form-group">
         <label for="post_tags">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
   

      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
      </div>

</form>

