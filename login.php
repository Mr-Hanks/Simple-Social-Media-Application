<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title> 
        <meta charset="utf-8"/>
        <link href="style.css" type="text/css" rel="stylesheet">
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
                $first_name = $row['first_name'];
                $_SESSION['first_name']=$first_name;

                header("Location: index.php");
            }else{
            echo "<div class= 'form'>
            <h3>Email/Password is incorrect</h3>
            <br/>Click Here To <a href='login.php'>Login</a>
            </div>";
            }
        }else{
            ?>
            <div class="form">
                <h1>Login</h1>
                <form name="login" action="" method="POST">
                    <input class="text" type="text" name="email" placeholder="Email Address" required />
                    <input class="text" type="password" name="password" placeholder="Password" required />
                    <input class="submitbttn" type="submit" name="submit" value="Login" />
                </form>
                <p>Need An Account? <a href='createuser.php'>Register Here!</a></p>
            </div>
            <?php } ?>
        
    </body>

</html>    