 <?php

    require 'config/config.php'; //getting $con var
    include("includes/classes/User.php"); //Call in the USER CLASS
    include("includes/classes/Post.php"); //Call in the Post CLASS


    //If user is logged in 
    if (isset($_SESSION['username'])) {
        $userLoggedIn = $_SESSION['username'];

        //Get user details from db
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");

        $user = mysqli_fetch_array($user_details_query); //return array from db

    } else {
        header("Location: register.php"); //If not logged in, redirect to register
    }

    //Get id of post that the use wants to like/liked 
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    $get_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($get_likes);

    $total_likes = $row['likes']; //Number of likes
    $user_liked = $row['added_by']; //User who liked post

    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_liked'"); //info of user who liked
    $row = mysqli_fetch_array($user_details_query);
    $total_user_likes = $row['num_likes'];

    //Like button
    if (isset($_POST['like_button'])) {

        $total_likes++; //Increase the like count on the post and update the value in db
        $query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");

        $total_user_likes++; //Increase the like count on user total likes
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($con, "INSERT INTO likes VALUES ('', '$userLoggedIn', '$post_id')");

        
    }

    //Unlike button
    if (isset($_POST['unlike_button'])) {

        $total_likes--; //Increase the like count on the post and update the value in db
        $query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");

        $total_user_likes--; //Increase the like count on user total likes
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
    }

    //Check for previous likes
    $check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
    $num_rows = mysqli_num_rows($check_query);

    if ($num_rows > 0) {
        echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                <input type="submit" class="comment_like" name="unlike_button" value="Unlike">
                <div class="like_value">
                    ' . $total_likes . ' Likes
                </div>
            </form>';
    } else {
        echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                <input type="submit" class="comment_like" name="like_button" value="Like">
                <div class="like_value">
                    ' . $total_likes . ' Likes
                </div>
            </form>';
    }

    ?>

 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="assets/css/styles.css">
 </head>

 <body>

     <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #fff;
        }

        form {
            position: absolute;
            top: 0;
        }
     </style>



 </body>

 </html>