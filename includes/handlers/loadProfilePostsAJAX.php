<?php 

include("../../config/config.php"); //Includes the database $connection variable
include("../classes/userClass.php"); //Includes the User CLASS
include("../classes/postClass.php"); //Includes the Post CLASS

$limit = 100; //Number of posts to be loaded 

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);

?>
