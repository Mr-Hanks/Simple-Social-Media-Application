<?php
include("includes/header.php"); //Including the header.php with association to User and Post classes


if (isset($_POST['post'])) {

    $uploadOk = true;
    

    if ($uploadOk) {
        $post = new Post($con, $userLoggedIn); //Creates a new post instance of the Post class and passes the user who created the post

        $post->submitPost($_POST['post_text']); //Submit the post from the method in the Post.php file

        header("location: index.php"); //No need to resubmit the form when refreshing the page
    }

    
}

?>
<!-- USER DETAILS -->
<div class="user_details column">
    <!-- comes from header page and rewrites the url to display the user that is logged in -->
    <a href="<?php echo "profile.php?profile_username=$userLoggedIn"; ?>">
        <img src="<?php echo $user['profile_pic']; ?>" alt="Profile picture">
    </a>
    <div class="user_details_left_right">
        <a href="<?php echo "profile.php?profile_username=$userLoggedIn"; ?>">
            <?php
            echo $user['first_name'] . " " . $user['last_name'];
            ?>
        </a>
        <br>
        <?php
        echo "Posts: " . $user['num_posts'] . "<br>";
        echo "Likes: " . $user['num_likes'];
        ?>
    </div>
</div>

<!-- MAIN COLUMN -->
<div class="main_column column">
    
    <form class="post_form" action="index.php" method="POST">
        
        <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" id="post_button" value="Post">
        <hr>
    </form>

    <div class="posts_area">
        <!-- Posts are going to be loaded via ajax -->
    </div>
    <img id="loading" src="assets/images/icons/loading.gif" alt="Loading">
</div>


<!-- Provides infinite scrolling for multiple posts -->
<script>
    $(function() {

        var userLoggedIn = '<?php echo $userLoggedIn; ?>'; //The session variable is being stored in javascript value, to be used with ajax $_REQUEST later
        var inProgress = false;

        loadPosts(); //Load posts

        $(window).scroll(function() {
            var bottomElement = $(".status_post").last();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            // isElementInViewport uses getBoundingClientRect()
            if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                loadPosts();
            }
        });

        function loadPosts() {
            if (inProgress) { //In the case of loading some posts, just return
                return;
            }

            inProgress = true; //Shows the loading wheel if set to true
            $('#loading').show();

            var page = $('.posts_area'); 

            $.ajax({
                url: "includes/handlers/ajax_load_posts.php", //ajax loads the posts for that specific user on the main page
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                cache: false,

                success: function(response) { //if load post is successful, hide the loading wheel animation and append the post to the postarea
                    $('#loading').hide();
                    $(".posts_area").append(response);

                    inProgress = false;
                }
            });
        }

        //Check if the element is in view
        function isElementInView(el) {
            var rect = el.getBoundingClientRect();

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && 
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) 
            );
        }
    });
</script>



</div> <!-- End of wrapper div in header.php -->
</body>

</html>