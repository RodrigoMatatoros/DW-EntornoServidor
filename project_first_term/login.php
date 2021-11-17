<?php
    require_once 'utilities.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    
        $usu = check_user_login($_POST['user-login'], $_POST['passwd-login'], $bd);
        if($usu === FALSE){
            // $err = TRUE;
            echo '<p style="color:red">**ERROR: Check user or password!</p>';
            $user = $_POST['user-login'];
        }else{
            session_start();
            $_SESSION['user-login'] = $user;
            // isActive($user, 1, $bd);
            if($user == 'root'){
                header('Location: admin.php');
            } else {
                header("Location: chat.php");
            }
        }	
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <header>
            <h1>SAMPLE TEXT</h1>
        </header>
        <?php
            // if(isset($_GET["redirected"])){echo "<p>Login to continue</p>";}
		    if(isset($err) and $err == TRUE){echo '<p style="color:red">ERROR: Check user and password</p>';}
		?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='POST'>
            <fieldset>
                <legend>Login</legend>
                <label for="user-login">User</label>
                <input type="text" id="user-login" value="<?php if(isset($user))echo $user;?>" name="user-login" placeholder="Username" required autofocus/><br/>

                <label for="passwd-login">Password</label>
                <input type="password" id="passwd-login" value = "<?php if(isset($passwd))echo $passwd;?>" name="passwd-login" placeholder="Password" required><br/>
                <a href="passwd_recovery.php">Forgot your password?</a><br/><br/>
                <!-- <a href="passwd_recovery.php">Forgot your password?</a><br/><br/> -->

                <button type="submit">Login</button>
                <button type="reset">Cancel</button><br/><br/>

                <a href="register.php">Or register if you do not have a user</a>
            </fieldset>
        </form>
    </body>
</html>