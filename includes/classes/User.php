<?php
//User class
class User {
    
    private $user; //this->user
    private $con;

    //Constructor - creates the user object
    public function __construct($con, $user) {
        //this is referencing the class object
        $this->con = $con;
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getUsername() { //gets the username
        return $this->user['username']; //Used in Post.php 
    }

    public function getNumPosts() { //gets the number of posts
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'"); 
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function getFirstName() { //gets the first name
        return $this->user['first_name'];
    }

    public function getFirstAndLastName() {// gets the user's first and last name
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }

    public function getProfilePic() { //gets the user's profile pic
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
    }

    
    public function isFriend($username_to_check) { //friend check
        $usernameComma = "," . $username_to_check . ","; //friend_array in db is set with commas as a placeholder

        if ((strstr($this->user['friend_array'], $usernameComma)) || $username_to_check == $this->user['username']) { //Show friends or yourself
            return true;
        } else {
            return false;
        } 
    }   
}
?>