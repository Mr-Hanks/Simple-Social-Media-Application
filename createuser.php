
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
                  ?>  <div class="wrapper">
                        <div class="login-box">
                            <div class="login-header">
                                <h1>Registration</h1>
                                <p>Sign up below!</p>
                            </div>
                            <div>
                                <form name="registration" action="" method="POST">
                                <?php echo "Email And Username Are Already In Use, Try Again"; ?>
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
                elseif($email==($row['email'])){
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Email Is Already In Use, Try Again"; ?> <br>
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
                elseif($username==($row['username'])){
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Username Is Already In Use, Try Again"; ?> <br>
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
            elseif($email != $confirmEmail && $password != $confirmPassword){
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Emails And Passwords Both Don't Match, Try Again"; ?> <br>
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
            elseif($email != $confirmEmail){
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Emails Don't Match, Try Again"; ?> <br>
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
            elseif($password != $confirmPassword){
                ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
                                        <?php echo "Passwords Don't Match, Try Again"; ?> <br>
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
                $rand = rand(1,3); //Random number between 1 and 3

                if ($rand == 1){ 
                    $profile_pic = "assets/images/profile_pics/head_deep_blue.png";
                }
                else if ($rand == 2){ 
                    $profile_pic = "assets/images/profile_pics/head_wet_asphalt.png";
                }
                else if ($rand == 3) {
                    $profile_pic = "assets/images/profile_pics/head_red.png";
                }
                $query = "INSERT INTO users (first_name, last_name, email, username, password, profile_pic, num_posts, num_likes, friend_array) VALUES ('$firstName', '$lastName', '$email', '$username', '".md5($password)."', '$profile_pic', '0', '0', ',test,')";
                $db->query($query);
                if($db){
                    ?>  <div class="wrapper">
                            <div class="login-box">
                                <div class="login-header">
                                    <h1>Registration</h1>
                                    <p>Sign up below!</p>
                                </div>
                                <div>
                                    <form name="registration" action="" method="POST">
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