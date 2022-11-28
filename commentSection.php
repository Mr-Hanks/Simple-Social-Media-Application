<?php

    require 'config/config.php'; //getting $connection variable
    include("includes/classes/User.php"); //Includes the USER CLASS
    include("includes/classes/Post.php"); //Includes the Post CLASS

    //Authentication
    if (isset($_SESSION['username'])) {
        $userLoggedIn = $_SESSION['username'];

        //Get user details from db
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");

        $user = mysqli_fetch_array($user_details_query); //return array from db

    } else {
        header("Location: register.php"); //If the user is not logged in, redirect to them to the register page
    }
    ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="styles.css" type="text/css" rel="stylesheet">
</head>

<body>

    <style>
        * {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

    <script>
        //Show or hide the comment section
        function toggle() {
            let element = document.getElementById("comment_section");

            if (element.style.display == "block") {
                element.style.display == "none";
            } else {
                element.style.display == "block";
            }
        }
    </script>

    <?php
    //Get the id of the post that the user wants to comment on
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    $user_query = mysqli_query($con, "SELECT added_by FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($user_query);

    $posted_to = $row['added_by'];

    if (isset($_POST['postComment' . $post_id])) {
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        $date_time_now = date("Y-m-d H:i:s");

        $insertpost = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', '$post_id')");
        

        echo "<php>Comment posted!</php>"; //confirmation that the comment was posted
    }

    ?>

    <form action="commentSection.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
        <textarea name="post_body"></textarea>
        <input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
    </form>

    <!-- Load all comments -->
    <?php
    $get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id DESC");
    $count = mysqli_num_rows($get_comments);

    if ($count != 0) {
        while ($comment = mysqli_fetch_array($get_comments)) {

            $comment_body = $comment['post_body'];
            $posted_by = $comment['posted_by'];
            $posted_to = $comment['posted_to'];
            $date_added = $comment['date_added'];
            $removed = $comment['removed'];

            //Timestamp since the post date
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_added); //Time of post
            $end_date = new DateTime($date_time_now); //Current time
            $interval = $start_date->diff($end_date); //Difference between the two dates

            if ($interval->y >= 1) {
                if ($interval->y == 1) {
                    $time_message = $interval->y . " year ago"; //1 year ago
                } else {
                    $time_message = $interval->y . " years ago"; // several years ago
                }
            } else if ($interval->m >= 1) {
                if ($interval->d == 0) {
                    $days = " ago";
                } else if ($interval->d == 1) {
                    $days = $interval->d . " day ago"; //exactly 1 day ago
                } else {
                    $days = $interval->d . " days ago"; //several days ago
                }

                if ($interval->m == 1) {
                    $time_message = $interval->m . " month" . $days; // exactly 1 month ago
                } else {
                    $time_message = $interval->m . " months" . $days; //several months ago
                }
            } else if ($interval->d >= 1) {
                if ($interval->d == 1) {
                    $time_message = "Yesterday"; 
                } else {
                    $time_message = $interval->d . " days ago"; 
                }
            } else if ($interval->h >= 1) {
                if ($interval->h == 1) {
                    $time_message = $interval->h . " hour ago"; //exactly 1 hour ago
                } else {
                    $time_message = $interval->h . " hours ago"; //several hours ago
                }
            } else if ($interval->i >= 1) {
                if ($interval->i == 1) {
                    $time_message = $interval->i . " minute ago"; //exactly 1 minute ago
                } else {
                    $time_message = $interval->i . " minutes ago"; // several minutes ago
                }
            } else {
                if ($interval->s < 30) {
                    $time_message = "Just now"; //0 - 30 seconds
                } else {
                    $time_message = $interval->s . " seconds ago"; //anything after 30 seconds
                }
            }

            $user_obj = new User($con, $posted_by);

            ?>
            <!-- Comment section that shows who posted the comment, grabbing their profile pic and first/last names -->
            <div class="comment_section">
            <a href="<?php echo "profile.php?profile_username=$posted_by"; ?>" target="_parent">
                <img src="<?php echo $user_obj->getProfilePic(); ?>" alt="Comment_profile_pic" title="<?php echo $posted_by; ?>" style="float:left; height: 30px;">
            </a>
            <a href="<?php echo "profile.php?profile_username=$posted_by"; ?>" target="_parent">
                <b><?php echo $user_obj->getFirstAndLastName(); ?> </b>
            </a>
            <?php echo $time_message . "<br>" . $comment_body; ?>
            <hr>
            </div>

            <?php
        }
    } else {
        echo "<center><br><br>No Comments to Show!</center>"; //no comments
    }

    ?>

  

</body>

</html>