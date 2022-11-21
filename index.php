<?php include("authorization.php"); ?>
<?php echo "This is the activity page";?> <br>
<?php
if (isset($_SESSION['first_name'])) {
    $userLoggedIn = $_SESSION['first_name'];
    
} ?> <!-- add to authorization.php? -->
<br> <a href = "profile.php"> <?php echo $userLoggedIn; ?> </a> <br> 
<br> <a href="logout.php">Logout</a>