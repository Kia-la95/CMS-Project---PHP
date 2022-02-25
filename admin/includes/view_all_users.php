<table class="table table-bordered table-hover">
                            <thead>  <!-- Table Header -->
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                                
                            </thead>
                        
                        <tbody> <!-- Table body -->

                <?php 
                
                $query = "SELECT * FROM users";
                $select_users= mysqli_query($connection, $query);
            
                // we can have a loop under the <ul> tag to show all the category names as <li>    
            
                while ($row = mysqli_fetch_assoc($select_users)){ // row is like a database here, we can use it to get data from each coloumn
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_firstname = $row['user_firstname'];
                    $user_password = $row['user_password'];
                    $user_lastname = $row['user_lastname'];
                    $user_image = $row['user_image'];
                    $user_email = $row['user_email'];
                    $user_role = $row['user_role'];

                    echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";

                    // $query = "SELECT * FROM categories WHERE cat_id=$post_category_id";
                    // $select_categories_id = mysqli_query($connection,$query);  
                    // while($row =  mysqli_fetch_assoc($select_categories_id)) {
                    // $cat_id = $row['cat_id'];
                    // $cat_title = $row['cat_title'];


                    // echo "<td>{$cat_title}</td>";
                    
                    // }
                        
                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";

                    
                    // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    // $select_categories_id_query = mysqli_query($connection,$query);

                    // while($row = mysqli_fetch_assoc($select_categories_id_query)){
                    // $post_id = $row['post_id'];
                    // $post_title =$row['post_title'];

                    // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                    // }

                    echo "<td><a href='users.php?chagne_to_admin={$user_id}'>Admin</a></td>";
                    echo "<td><a href='users.php?chagne_to_sub={$user_id}'>Subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";
                }
                
                
                ?>
                        </tbody>
                    </table>


<?php 

/* Change user role to Admin*/
if(isset($_GET['chagne_to_admin'])){

    $the_user_id = $_GET['chagne_to_admin'];

    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($connection,$query);
    header("Location: users.php");

    // confirm_query($change_to_admin_query);

}






/* Change user role to Subscribre*/
if(isset($_GET['chagne_to_sub'])){

    $the_user_id = $_GET['chagne_to_sub'];

    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id ";
    $change_to_sub_query = mysqli_query($connection,$query);
    header("Location: users.php");

    // confirm_query($change_to_admin_query);

}




/* Delete Comment query */
if(isset($_GET['delete'])){

    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'Admin'){

    $the_user_id = mysqli_real_escape_string($connection,$_GET['delete']);

    $query = "DELETE FROM users WHERE user_id =  {$the_user_id} ";
    $delete_user_query = mysqli_query($connection,$query);
    header("Location: users.php");

    confirm_query($delete_user_query);

        }

    }
}


?>