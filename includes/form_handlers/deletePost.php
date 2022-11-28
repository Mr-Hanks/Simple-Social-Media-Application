<?php
    require '../../config/config.php'; //Includes the database $connection variable

    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    // Included in bootstrap 
    if (isset($_POST['result'])) {
        if ($_POST['result'] == 'true')
            $query = mysqli_query($con, "DELETE FROM posts WHERE id='$post_id'");
    }
?>