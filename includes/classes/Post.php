<?php
//User class
class Post
{
    
    private $user_obj;
    private $con;

    //Constructor - creates the user object 
    public function __construct($con, $user)
    {
        //this is referencing the class object
        $this->con = $con;
        $this->user_obj = new User($con, $user); //Each post will create a new instance of the User class
    }

    public function submitPost($body)
    {
        
        $body = mysqli_real_escape_string($this->con, $body); //Allow single quotes in strings

        $check_empty = preg_replace('/\s+/', '', $body); //Deletes all empty spaces from the body

        //Not allowing the user to enter empty spaces into the db
        if ($check_empty != "") {

            //Current date & time
            $date_added = date("Y-m-d H:i:s");
            //Get username
            $added_by = $this->user_obj->getUsername(); //getusername method
       

            //Inserts post to the database
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES ('', '$body', '$added_by', '$date_added', 'no', '0')");

            $returned_id = mysqli_insert_id($this->con); //Returns id of the post that was submitted
            

            //Update the post count for the user
            $num_posts = $this->user_obj->getNumPosts(); //Return the number of posts
            $num_posts++; //Increment the post count
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'"); //Update user 

            
        }
    }

    

    public function loadPostsFriends($data, $limit) {

        
        $userLoggedIn = $this->user_obj->getUsername();

        $html = ""; //HTml to return 
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC"); //Latest post first

        if (mysqli_num_rows($data_query) > 0) { //If at least one row is sent from the database

    

            while ($row = mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];

                
                //showing only friend posts on feed
                $user_logged_obj = new User($this->con, $userLoggedIn);

                if ($user_logged_obj->isFriend($added_by)) {


                    // Delete post button functionality
                    if ($userLoggedIn == $added_by)
                        $delete_button = "<button class='delete_button' id='post$id'>X</button>";
                    else
                        $delete_button = "";

                    $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);

                    $first_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_pic = $user_row['profile_pic'];

                    ?>
                    <!-- COMMENTS BLOCK FUNCTION -->
                    <script>
                        function toggle<?php echo $id; ?>(event) {

                            var target = $(event.target);

                            if (!target.is('a') && !target.is('button')) {
                                var element = document.getElementById("toggleComment<?php echo $id; ?>");

                                if (element.style.display == "block")
                                    element.style.display = "none";
                                else
                                    element.style.display = "block";
                            }

                        }
                    </script>
                <?php

                    //comment count
                    $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                    $comments_check_num = mysqli_num_rows($comments_check);

                    //Timestamps
                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new DateTime($date_time); //Time of post
                    $end_date = new DateTime($date_time_now); //Current time
                    $interval = $start_date->diff($end_date); //Difference between dates

                    if ($interval->y >= 1) {
                        if ($interval->y == 1) {
                            $time_message = $interval->y . " year ago"; // exactly 1 year ago
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
                            $time_message = $interval->m . " month " . $days; //exactly 1 month ago
                        } else {
                            $time_message = $interval->m . " months " . $days; //several months ago
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
                            $time_message = $interval->i . " minutes ago"; //several minutes ago
                        }
                    } else {
                        if ($interval->s < 30) {
                            $time_message = "Just now"; // 0 - 30 seconds
                        } else {
                            $time_message = $interval->s . " seconds ago"; //anything over 30 seconds
                        }
                    }

                    //Add a post to the html
                    $html .= "<div class='status_post' onClick='javascript:toggle$id(event)'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='50'>
                                </div>

                                <div class='posted_by' style='color: #ACACAC;'>
                                    <a href='profile.php?profile_username=$added_by'>$first_name $last_name </a> $time_message
                                    $delete_button
                                </div>
                                <div id='post_body'>
                                    $body
                                    <br>
                                    
                                    <br>
                                    <br>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    Comments($comments_check_num)
                                    <iframe src='like.php?post_id=$id' scrolling='no'></iframe>
                                </div>
                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>";
                }
                ?>
                <script>
                   
                    $(document).ready(function() {
                        $('#post<?php echo $id; ?>').on('click', function() {
                            bootbox.confirm("Are you sure you want to delete this post?", function(result) {
                                $.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {
                                    result: result
                                });

                                if (result) { 
                                    location.reload()
                                }
                            });
                        });
                    });
                </script>
            <?php

            } //END WHILE LOOP
        
        }
        //When the loop is finished , echo the html
        echo $html;
    }

    public function loadProfilePosts($data, $limit) {

        
        $profileUser = $data['profileUsername'];

        $userLoggedIn = $this->user_obj->getUsername();

        $html = ""; //HTML to return
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' AND (added_by='$profileUser') ORDER BY id DESC"); //Latest post first

        if (mysqli_num_rows($data_query) > 0) { //If at least one row is sent from the database


            while ($row = mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];


                // Delete post button functionality
                if ($userLoggedIn == $added_by)
                    $delete_button = "<button class='delete_button' id='post$id'>X</button>";
                else
                    $delete_button = "";

                $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);

                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_pic = $user_row['profile_pic'];

            ?>
                <!-- COMMENTS BLOCK FUNCTION -->
                <script>
                    function toggle<?php echo $id; ?>(event) {

                        var target = $(event.target);

                        if (!target.is('a') && !target.is('button')) {
                            var element = document.getElementById("toggleComment<?php echo $id; ?>");

                            if (element.style.display == "block")
                                element.style.display = "none";
                            else
                                element.style.display = "block";
                        }

                    }
                </script>
                <?php

                //comment count
                $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                $comments_check_num = mysqli_num_rows($comments_check);

                //Timestamps
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time); //Time of post
                $end_date = new DateTime($date_time_now); //Current time
                $interval = $start_date->diff($end_date); //Difference between dates

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
                        $time_message = $interval->m . " month " . $days; //exactly 1 month ago
                    } else {
                        $time_message = $interval->m . " months " . $days; //several months ago
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
                        $time_message = $interval->i . " minutes ago"; //several minutes ago
                    }
                } else {
                    if ($interval->s < 30) {
                        $time_message = "Just now"; // 0 - 30 seconds
                    } else {
                        $time_message = $interval->s . " seconds ago"; // anything over 30 seconds
                    }
                }

                //Add a post to the html
                $html .= "<div class='status_post' onClick='javascript:toggle$id(event)'>
                                <div class='post_profile_pic'>
                                    <img src='$profile_pic' width='50'>
                                </div>

                                <div class='posted_by' style='color: #ACACAC;'>
                                    <a href='profile.php?profile_username=$added_by'>$first_name $last_name </a> $time_message
                                    $delete_button
                                </div>
                                <div id='post_body'>
                                    $body
                                    <br>
                                    <br>
                                    <br>
                                </div>

                                <div class='newsfeedPostOptions'>
                                    Comments($comments_check_num)
                                    <iframe src='like.php?post_id=$id' scrolling='no'></iframe>
                                </div>
                            </div>
                            <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                            </div>
                            <hr>";

                ?>
                <script>
                    
                    $(document).ready(function() {
                        $('#post<?php echo $id; ?>').on('click', function() {
                            // Comes with bootstrap JS
                            bootbox.confirm("Are you sure you want to delete this post?", function(result) {
                                $.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {
                                    result: result
                                });

                                if (result) { //if result is true
                                    location.reload() // reloads the page
                                }
                            });
                        });
                    });
                </script>
                <?php

            } //END WHILE LOOP
            
        }
        //When the loop is finished, echo the html
        echo $html;
    }

}
