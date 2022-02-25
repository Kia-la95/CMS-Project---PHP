
<?php 

function insert_categories(){

    global $connection;

    if(isset($_POST['submit'])){             
        $cat_title = $_POST['cat_title']; // get the text from the box after pressing button
        if($cat_title == "" || empty($cat_title)){ // if the input box is empty
             echo "This field should not be empty";

        }else{

             $query = "INSERT INTO categories(cat_title) ";
             $query .= "VALUE('{$cat_title}')"; // insert the data in the database
             $create_category_query = mysqli_query($connection,$query);

             if(!$create_category_query){
                 die('QUERY FAILED' . mysqli_error($connection));
        }
     }
 }
     
}


function findAllCategories(){

    global $connection;

    // having a query to show the categories
    $query = "SELECT * FROM categories";
    $select_categories= mysqli_query($connection, $query);

    // we can have a loop under the <ul> tag to show all the category names as <li>    

    while ($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
            echo "<tr>"; // <tr> is the tag for a row in a table
            echo "<td> {$cat_id}</td>"; // <td> is the tag for a cell in a table
            echo "<td> {$cat_title}</td>";
            echo "<td><a href ='categories.php?delete={$cat_id}'> Delete </a></td>";
            echo "<td><a href ='categories.php?edit={$cat_id}'> Edit </a></td>";
            echo "<tr>";
    }
}


function deleteCategories(){

    global $connection;
    
    if(isset($_GET['delete'])){ // THIS is a GET request

        $get_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$get_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php"); // this line basically sends another request and it will refresh the page

      }
}



function confirm_query($result){

    global $connection;

    if(!$result){
        die(" QUERY FAILED ". mysqli_error($connection));
    }

}


function users_online(){


    if(isset($_GET['onlineusers'])){

    global $connection;

    if($connection){

        session_start();
        include("../includes/db.php");


    $session = session_id();
    $time = time();
    $time_out_in_session = 60;
    $time_out = $time - $time_out_in_session;
    

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count = NULL){
       mysqli_query($connection, "INSERT INTO users_online(time,session) VALUES ('$time','$session')");

    }else{

        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

    }
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    return $count_user = mysqli_num_rows($users_online_query);
    }
    
}//get request 

}
users_online();



function escape($string){

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}



function recordCount($tableName){

    global $connection;

    $query = "SELECT * FROM " . $tableName;
    $select_all_posts = mysqli_query($connection,$query);
    $post_count = mysqli_num_rows($select_all_posts);

    return $post_count;
}

function checkStatus($table,$column,$status){
    global $connection;

        $query = "SELECT * FROM $table WHERE $column = '$status' ";
        $result = mysqli_query($connection,$query);
        return mysqli_num_rows($result);
}


function is_admin($username = ''){

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    $row = mysqli_fetch_array($result);

    if($row['user_role'] ==  'Admin'){

        return true;
    }else{

        return false;
    }


}

?>