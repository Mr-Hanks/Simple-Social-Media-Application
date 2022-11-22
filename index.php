<?php include("authorization.php"); ?>
<?php echo "This is the activity page";?> <br>
<?php
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    
} ?> <!-- add to authorization.php? -->
<br> <a href = "profile.php"> <?php echo $userLoggedIn; ?> </a> <br> 
<br> <a href="logout.php">Logout</a>