<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title> 
        <meta charset="utf-8"/>
        
        <link href="register.css" type="text/css" rel="stylesheet">
    </head>

    <body>       
        <?php
        session_start();
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }

        if (isset($_POST['email']) && isset($_POST['password'])){ 
            $db = new mysqli("localhost", "root", "", "social");
            $input = "SELECT * FROM users WHERE email='$email' and password='".md5($password)."'";
            $result= $db->query($input);
            $rows = mysqli_num_rows($result);
            

            if($rows==1){
                $row = mysqli_fetch_assoc($result);
                $user_name = $row['username'];
                $_SESSION['username']=$user_name; 

                header("Location: index.php");
            }else{
               ?> <div class="wrapper">
                <div class="login-box">
                    <div class="login-header">
                        <h1>OnlyFriends</h1>
                        <p>Login below!</p>
                    </div>
                    <div>
                        <form name="login" action="" method="POST">
                        <?php echo "Email/Password is incorrect"; ?> <!-- notifying the user that the username and/or password is incorrect -->
                            <input type="email" name="email" placeholder="Email Address" required />
                            <input type="password" name="password" placeholder="Password" required /> <br>
                            <input type="submit" name="submit" value="Login" />
                        </form>
                        <p>Need An Account? <a href='createuser.php'>Register Here!</a></p>
                    </div>
                </div>
            </div>
            <?php
            }
        }else{
            ?>
            <div class="wrapper">
                <div class="login-box">
                    <div class="login-header">
                        <h1>OnlyFriends</h1>
                        <p>Login below!</p>
                    </div>
                    <div>
                        <form name="login" action="" method="POST">
                            <input type="email" name="email" placeholder="Email Address" required />
                            <input type="password" name="password" placeholder="Password" required /> <br>
                            <input type="submit" name="submit" value="Login" />
                        </form>
                        <p>Need An Account? <a href='createuser.php'>Register Here!</a></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        
    </body>

</html>    