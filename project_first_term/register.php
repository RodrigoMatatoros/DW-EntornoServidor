<?php
    require_once 'utilities.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $user = check_user_registration($_POST['user-register']);
        if($user === TRUE){
            $err = TRUE;
            // $user = $_POST['user'];
            echo '<p style="color:red">**ERROR: the username or the email already exists.</p>';
        } else {
            $name = $_POST['name-register'];
            $surname = $_POST['surname-register'];
            $user = $_POST['user-register'];
            $email = $_POST['email-register'];
            $passwd = password_hash($_POST['passwd-register']);
            //make the password confirmation
            $age = $_POST['age-register'];
            $tel = $_POST['tel-register'];

            $query = "INSERT INTO chatapp.users (id, usName, usSurname, username, email, passwd, age, isActive) VALUES (NULL, '$name', '$surname', '$user', '$email', '$passwd', '$age', '0');";
            $result = $bd->query($query);
            //insert confirmation
            if($result->rowCount() === 1){
                echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';		
                return $result->fetch();	
            } else {
                return FALSE;
            }
            session_start();
            $_SESSION['user'] = $user;
            header('Location: index.html');
            return;
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
                <input type="text" id="name-register" value = "<?php if(isset($name))echo $name;?>" name="name-register" placeholder="Name" required /><br/>

                <label for="surname-register">Surname(s)*</label>
                <input type="text" id="surname-register" value = "<?php if(isset($surname))echo $surname;?>" name="surname-register" placeholder="surname-register" required /><br/>
                
                <label for="user-register">Username*</label>
                <input type="text" id="user-register" value="<?php if(isset($user))echo $user;?>" name="user-register" placeholder="Username" required/><br/>
                
                <label for="email-register">Email*</label>
                <input type="email" id="email-register" value="<?php if(isset($email))echo $email;?>" name="email-register" placeholder="Email address" required/><br/>

                <label for="passwd-register">Password*</label>
                <input type="password" id="passwd-register" value = "<?php if(isset($passwd))echo $passwd;?>" name="passwd-register" placeholder="Password" required /><br/>

                <!--make a password confirmation here-->

                <label for="age-register">Age*</label>
                <input type="number" min=16 max=99 id="age-register" value="<?php if(isset($age))echo $age;?>"/><br/>

                <label for="tel-register">Telephone number</label>
                <input type="tel" id="tel-register" value="<?php if(isset($phone_number))echo $phone_number;?>"/><br/><br/>

                <button type="submit">Login</button>
                <button type="reset">Cancel</button><br/>

            </fieldset>
        </form>
    </body>
</html>