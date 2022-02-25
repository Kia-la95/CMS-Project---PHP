<table class="table table-bordered table-hover">
                            <thead>  <!-- Table Header -->
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                                
                            </thead>
                        
                        <tbody> <!-- Table body -->

                <?php 
                
                $query = "SELECT * FROM comments";
                $select_comments= mysqli_query($connection, $query);
            
                // we can have a loop under the <ul> tag to show all the category names as <li>    
            
                while ($row = mysqli_fetch_assoc($select_comments)){ // row is like a database here, we can use it to get data from each coloumn
                    $comment_id = $row['comment_id'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_email = $row['comment_email'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                    echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
                        
                    echo "<td>{$comment_email}</td>";
                    echo "<td>{$comment_status}</td>";

                    
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_categories_id_query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_categories_id_query)){
                    $post_id = $row['post_id'];
                    $post_title =$row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                    }
                    
                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                    echo "</tr>";
                }
                
                
                ?>
                        </tbody>
                    </table>


<?php 

/* Unaprove Comment query by updating the database column*/
if(isset($_GET['approve'])){

    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id =$the_comment_id ";
    $approve_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");

    confirm_query($delete_query);

}






/* Unaprove Comment query by updating the database column*/
if(isset($_GET['unapprove'])){

    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id =$the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection,$query);
    header("Location: comments.php");

    confirm_query($delete_query);

}




/* Delete Comment query */
if(isset($_GET['delete'])){

    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id =  {$the_comment_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: comments.php");

    confirm_query($delete_query);

}


?>