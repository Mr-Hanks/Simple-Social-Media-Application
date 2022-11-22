<?php
    require '../../config/config.php'; //getting $con var

    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    // This comes from bootstrap box
    if (isset($_POST['result'])) {
        if ($_POST['result'] == 'true')
            $query = mysqli_query($con, "DELETE FROM posts WHERE id='$post_id'");
    }
?>