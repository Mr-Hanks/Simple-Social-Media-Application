<?php 
ob_start(); //output buffering
session_start(); //Starts the session

$timezone = date_default_timezone_set("America/Chicago");
$con = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) { //error check
    echo "Failed to connect: " . mysqli_connect_errno();
}
?>