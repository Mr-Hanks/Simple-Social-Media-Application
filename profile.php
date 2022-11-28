<?php
//Including the header.php with association to User and Post classes
include("includes/header.php"); 
 


//Getting the user that is logged in, along with their friends
if (isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];

    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);

    $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}?>

<!-- User Details -->
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
                <!-- Posts are going to be loaded using ajax -->
            </div>
            <img id="loading" src="images/icons/loading.gif" alt="Loading">
        </div>
       
    </div>


</div>

<!-- Modal popup for handling the post something button -->
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
    //Button for profile post something
    $('#submit_profile_post').click(function() {
        $.ajax({
            type: "POST",
            url: "includes/handlers/submitProfilePostAJAX.php",
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

        var userLoggedIn = '<?php echo $userLoggedIn; ?>'; //The session variable is being stored in javascript value, to be used with ajax $_REQUEST later
        var profileUsername = '<?php echo $username; ?>';

        var inProgress = false;

        loadPosts(); //Load posts

        function loadPosts() {
            if (inProgress) { //In the case of loading some posts, just return
                return;
            }

            inProgress = true; //Shows the loading wheel if set to true
            $('#loading').show();

            var page = $('.posts_area'); 

            $.ajax({ //ajax loads the posts for that specific user on their profile page
                url: "includes/handlers/loadProfilePostsAJAX.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
                cache: false,

                success: function(response) { //if load post is successful, hide the loading wheel animation and append the post to the postarea
                    $('#loading').hide();
                    $(".posts_area").append(response);

                    inProgress = false;
                }
            });
        }

        
    });
</script>

