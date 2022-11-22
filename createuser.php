
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title> 
        <meta charset="utf-8"/>
        <link href="register.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <?php
        if(isset($_POST['firstName'])){
            $firstName = $_POST['firstName'];
        }
        if(isset($_POST['lastName'])){
            $lastName = $_POST['lastName'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['confirmEmail'])){
            $confirmEmail = $_POST['confirmEmail'];
        }
        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if(isset($_POST['confirmPassword'])){
            $confirmPassword = $_POST['confirmPassword'];
        }
        
        if (isset($_POST['username']) && isset($_POST['password'])){
            $db = new mysqli("localhost", "root", "", "social");
            $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $res = $db->query($sql);

            if($res->num_rows > 0){
                $row = mysqli_fetch_assoc($res);
                if($email==($row['email']) && $username==($row['username'])){
                    echo "<div class ='form'>
                    <h3>Email and Username are already in use</h3>
                    <br/><a href='createuser.php'>Register With A New Email And Username</a>
                    </div>"; 
                }
                elseif($email==($row['email'])){
                    echo "<div class ='form'>
                    <h3>Email is already in use</h3>
                    <br/><a href='createuser.php'>Register With A New Email</a>
                    </div>";
                }
                elseif($username==($row['username'])){
                    echo "<div class ='form'>
                    <h3>Username is already in use</h3>
                    <br/><a href='createuser.php'>Register With A New Username</a>
                    </div>";
                    }
            }
            elseif($email != $confirmEmail && $password != $confirmPassword){
                echo "<div class ='form'>
                    <h3>Emails And Passwords Both Don't Match</h3>
                    <br/><a href='createuser.php'>Try Registering Again</a>
                    </div>";
            }
            elseif($email != $confirmEmail){
                echo "<div class ='form'>
                    <h3>Emails Don't Match</h3>
                    <br/><a href='createuser.php'>Try Registering Again</a>
                    </div>";
            }
            elseif($password != $confirmPassword){
                echo "<div class ='form'>
                    <h3>Passwords Don't Match</h3>
                    <br/><a href='createuser.php'>Try Registering Again</a>
                    </div>";

            }
            else{
                $rand = rand(1, 2); //Random nr between 1 and 2

                if ($rand == 1){ 
                    $profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
                }
                else if ($rand == 2){ 
                    $profile_pic = "assets/images/profile_pics/defaults/head_wet_asphalt.png";
                }
                else if ($rand == 3) {
                    $profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
                }
                $query = "INSERT INTO users (first_name, last_name, email, username, password, profile_pic, num_posts, num_likes, friend_array) VALUES ('$firstName', '$lastName', '$email', '$username', '".md5($password)."', '$profile_pic', '0', '0', ',test,')";
                $db->query($query);
                if($db){
                    echo "<div class ='form'>
                    <h3>You have successfully registered</h3>
                    <br/>Click Here To <a href='login.php'>Login</a>
                    </div>";
                }
            }
        }else{
            ?>
            <div class="wrapper">
                <div class="login-box">
                    <div class="login-header">
                        <h1>Registration</h1>
                    </div>
                    <div>
                        <form name="registration" action="" method="POST">
                            <input type="text" name="firstName" placeholder="First Name" required/>
                            <input type="text" name="lastName" placeholder="Last Name" required/>
                            <input type="text" name="email" placeholder="Email" required/>
                            <input type="text" name="confirmEmail" placeholder="Confirm Email" required/>
                            <input type="text" name="username" placeholder="Username" required />
                            <input type="password" name="password" placeholder="Password" required />
                            <input type="password" name="confirmPassword" placeholder="Confirm Password" required/> <br>
                            <input type="submit" name="submit" value="Register"/>
                        </form>
                        <p>Have An Account? <a href='login.php'>Sign in Here!</a></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        
    </body>
</html>