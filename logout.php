<?php
//Starts the logout session and returns the user back to the login page
session_start();
if(session_destroy()){
    header("Location: login.php");
}
?> 