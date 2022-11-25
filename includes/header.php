<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Social Media</title>


    <!-- jquery js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--<script src="assets/js/bootbox.min.js"></script> -->
    <script src="assets/js/social.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    

    <!-- CSS -->

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/6a95d184e3.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/styles.css">
    
</head>

<?php require 'config/config.php'; //getting $con var
include("includes/classes/User.php"); //Call in the USER CLASS
include("includes/classes/Post.php"); //Call in the Post CLASS


//Authentication
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];

    //Get user details from db
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");

    $user = mysqli_fetch_array($user_details_query); //return array from db (info about the logged in user)

} else {
    header("Location: login.php"); //If not logged in, redirect to register
}

?>

<body>

    <div class="top_bar">
        <div class="logo">
            <a href="index.php">OnlyFriends</a>
        </div>
        <nav>
            <a href="<?php echo "profile.php?profile_username=$userLoggedIn"; ?>">
                <?php
                echo $user['first_name'];
                ?>
            </a>
            <a href="index.php">
                <i class="fa-solid fa-house-chimney"></i>
            </a>
            
            <a href="#">
                <i class="fa-solid fa-envelope"></i>
            </a>
            
            <a href="#">
                <i class="fa-solid fa-bell"></i>              
            </a>
            <a href="#">
                <i class="fa-solid fa-users"></i>  
            </a>
            <a href="#">
                <i class="fa-solid fa-gear"></i>
            </a>
            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </nav> 
        
    </div>

    <div class="wrapper"> 