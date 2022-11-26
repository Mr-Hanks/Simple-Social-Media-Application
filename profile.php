<?php
include("includes/header.php"); //Also includes classes like User and Post
 
// session_destroy();


// Profile actual url (we hid it with htaccess) /fb/profile.php?profile_username=rix_rix

if (isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];

    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);

    $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}?>

<style>
    .wrapper {
        margin-left: 0px;
        padding-left: 0px;
    }
</style>

<!-- PROFILE BOX -->
<div class="profile_left">
    <img src="<?php echo $user_array['profile_pic']; ?>" alt="profile_pic">

    <div class="profile_info">
        <p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
        <p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
        <p><?php echo "Friends: " . $num_friends; ?></p>
    </div>

    

    <input type="submit" class="deep_purple" data-toggle="modal" data-target="#post_form" value="Post Something">

    

</div>

<div class="profile_main_column column">
    <div>
        <div>
            <div class="posts_area">
                <!-- Posts are going to be loaded via ajax, 10 at a time -->
            </div>
            <img id="loading" src="assets/images/icons/loading.gif" alt="Loading">
        </div>
       
    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="post_form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Something!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>
                <form class="profile_post" action="" method="POST">
                    <div class="form-group">
                        <textarea class="form-control" name="post_body"></textarea>
                        <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    //Button for profile post
    $('#submit_profile_post').click(function() {
        $.ajax({
            type: "POST",
            url: "includes/handlers/ajax_submit_profile_post.php",
            data: $('form.profile_post').serialize(),
            success: function(msg) {
                $('#post_form').modal('hide');
                location.reload();
            },
            error: function () {
                alert("Failed to post!");
            }
        });
    });
});

</script>

<script>
    $(function() {

        var userLoggedIn = '<?php echo $userLoggedIn; ?>'; //Save the session variable to js value, to be used with ajax $_REQUEST later
        var profileUsername = '<?php echo $username; ?>';

        var inProgress = false;

        loadPosts(); //Load first posts

        $(window).scroll(function() {
            var bottomElement = $(".status_post").last();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
            if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                loadPosts();
            }
        });

        function loadPosts() {
            if (inProgress) { //If it is already in the process of loading some posts, just return
                return;
            }

            inProgress = true;
            $('#loading').show();

            var page = $('.posts_area'); 

            $.ajax({
                url: "includes/handlers/ajax_load_profile_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
                cache: false,

                success: function(response) {
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
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
            );
        }
    });
</script>



</div> <!-- End of wrapper div in header.php -->
</body>

</html>