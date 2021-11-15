<?php
    require_once 'utilities.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $user = check_user_registration($_POST['user-register'], $_POST['email-register'], $bd);
        if($user === TRUE){
            // $err = TRUE;
            echo '<p style="color:red">**ERROR: the username or the email is already registered.</p>';
            $user = $_POST['user'];
        } else {
            $name = $_POST['name-register'];
            $surname = $_POST['surname-register'];
            $user = $_POST['user-register'];
            $email = $_POST['email-register'];
            $passwd = $_POST['passwd-register'];
            $passwdConf = $_POST['passwd-conf-register'];
            $age = intval($_POST['age-register']);
            $tel = $_POST['tel-register'];

            // var_dump($passwd);
            // var_dump($passwdConf);

            if($passwd == $passwdConf){
                $encryptedPasswd = password_hash($passwd, PASSWORD_DEFAULT);
                register_user($name, $surname, $user, $email, $encryptedPasswd, $age, $tel, $bd);
                
                session_start();
                $_SESSION['user-register'] = $user;
                // isActive($user, 1, $bd);
                header('Location: chat.php');
            } else {
                echo '<p style="color:red">**ERROR: passwords do not match!</p>';
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
        <title>Register</title>
    </head>
    <body>
        <header>
            <h1>SAMPLE TEXT</h1>
        </header>
        <!-- <?php
            // if(isset($_GET["redirected"])){echo "<p>Login to continue</p>";}
		    // if(isset($err) and $err == TRUE){echo "<p>Check user and password</p>";}
		?> -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='POST'>
            <fieldset>
                <legend>Registration</legend>
                <label for="name-register">Name*</label>
                <input type="text" id="name-register" value = "<?php if(isset($name))echo $name;?>" name="name-register" placeholder="Name" required autofocus/><br/>

                <label for="surname-register">Surname(s)*</label>
                <input type="text" id="surname-register" value = "<?php if(isset($surname))echo $surname;?>" name="surname-register" placeholder="Surname" required /><br/>
                
                <label for="user-register">Username*</label>
                <input type="text" id="user-register" value="<?php if(isset($user))echo $user;?>" name="user-register" placeholder="Username" required/><br/>
                
                <label for="email-register">Email*</label>
                <input type="email" id="email-register" value="<?php if(isset($email))echo $email;?>" name="email-register" placeholder="Email address" required/><br/>

                <label for="passwd-register">Password*</label>
                <input type="password" id="passwd-register" value = "<?php if(isset($passwd))echo $passwd;?>" name="passwd-register" placeholder="Password" required /><br/>

                <!--make a password confirmation here-->
                <label for="passwd-conf-register">Confirm Password*</label>
                <input type="password" id="passwd-conf-register" value = "<?php if(isset($passwdConf))echo $passwdConf;?>" name="passwd-conf-register" placeholder="Password Confirmation" required /><br/>

                <label for="age-register">Age*</label>
                <input type="number" min=16 max=99 id="age-register" value="<?php if(isset($age))echo $age;?>" name="age-register" /><br/>

                <label for="tel-register">Telephone number</label>
                <input type="tel" id="tel-register" value="<?php if(isset($phone_number))echo $phone_number;?>" name="tel-register" /><br/><br/>

                <button type="submit">Register</button>
                <button type="reset">Cancel</button><br/>

            </fieldset>
        </form>
    </body>
</html>