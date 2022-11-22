<?php
//Object oriented PHP - User class
class User {
    //Will only be able to use these variables inside this class
    private $user; //Basically equals this->user
    private $con;

    //Constructor (like in react) - creates the user object upon call = $new_obj = new User($con, $userLoggedIn) ...
    public function __construct($con, $user) {
        //"THIS" REFERENCES THE CLASS OBJECT
        $this->con = $con;
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getUsername() {
        return $this->user['username']; //Used in Post.php class for example
    }

    

    public function getNumPosts() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'"); 
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function getFirstName() {
        return $this->user['first_name'];
    }

    public function getFirstAndLastName() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }

    public function getProfilePic() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
    }

    
    public function isFriend($username_to_check) {
        $usernameComma = "," . $username_to_check . ","; //friend_array in db is with commas

        if ((strstr($this->user['friend_array'], $usernameComma)) || $username_to_check == $this->user['username']) { //Show friends or yourself
            return true;
        } else {
            return false;
        } //Needle, haystack
    }
    
    

    

   

    public function getFriendArray() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT friend_array FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['friend_array'];
    }

    
    
    
}


?>