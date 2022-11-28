
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
                if($email==($row['email']) && $username==($row['username'])){ //check for similar emails AND usernames
                  ?>  <div class="wrapper">
                        <div class="login-box">
                            <div class="login-header">
                                <h1>Registration</h1>
                                <p>Sign up below!</p>
                            </div>
                            <div>
                                <form name="registration" action="" method="POST">
                                <?php echo "Email And Username Are Already In Use, Try Again"; ?> <!-- notifiying the user that their email and username are both already in use -->
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
                    </div> <?php
                }
                elseif($email==($row['email'])){ //check for similar emails
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Email Is Already In Use, Try Again"; ?> <br> <!-- notifiying the user that their email is already in use -->
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
                        </div> <?php  
                }
                elseif($username==($row['username'])){ //check for similar usernames
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Username Is Already In Use, Try Again"; ?> <br> <!-- notifiying the user that the username chosen is already in use -->
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
                        </div> <?php
                    
                    }
            }
            elseif($email != $confirmEmail && $password != $confirmPassword){ //check if emails and passwords are different 
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Emails And Passwords Both Don't Match, Try Again"; ?> <br> <!-- notifying the user that BOTH email and password do not match -->
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
                        </div> <?php         
            }
            elseif($email != $confirmEmail){ //check for different emails
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Emails Don't Match, Try Again"; ?> <br> <!-- notifying the user if their emails do not match in the form -->
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
                        </div> <?php        
            }
            elseif($password != $confirmPassword){ //check for different passwords
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Passwords Don't Match, Try Again"; ?> <br> <!-- notifying the user that their passwords do not match in the form -->
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
                        </div> <?php
            }
            else{
                $rand = rand(1,3); //Random number between 1 and 3 to randomly assign profile pics to new users

                if ($rand == 1){ 
                    $profile_pic = "images/profile_pics/head_deep_blue.png";
                }
                else if ($rand == 2){ 
                    $profile_pic = "images/profile_pics/head_wet_asphalt.png";
                }
                else if ($rand == 3) {
                    $profile_pic = "images/profile_pics/head_red.png";
                }
                //Inserts user information into the database, hashes their password, sets their profile pic, and sets their first friend to be the default testuser 
                $query = "INSERT INTO users (first_name, last_name, email, username, password, profile_pic, num_posts, num_likes, friend_array) VALUES ('$firstName', '$lastName', '$email', '$username', '".md5($password)."', '$profile_pic', '0', '0', ',Test,')";
                $db->query($query);
                if($db){
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST"> <!-- notifying the user they have successfully registered an account -->
                                        <?php echo "You have successfully registered <br/>Click Here To <a href='login.php'>Login</a>"; ?> <br>
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
                        </div> <?php
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
                        <p>Sign up below!</p>
                    </div>
                    <div>
                        <form name="registration" action="" method="POST"> <!-- Register form -->
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