<?php 

require '../../config/config.php'; //Includes the database $connection variable
include("../classes/userClass.php"); //Includes the USER CLASS
include("../classes/postClass.php"); //Includes the Post CLASS

if (isset($_POST['post_body'])) {
    $post = new Post($con, $_POST['user_from']);
    $post->submitPost($_POST['post_body'], ""); 
}

?>