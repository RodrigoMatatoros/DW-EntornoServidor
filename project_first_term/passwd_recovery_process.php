<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Recovery</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <fieldset>
                <legend>Password Recovery</legend>
                <label for="user-recover">User*</label>
                <input type="text" id="user-recover" name="user-recover" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required /><br/>

                <label for="new-password">New Password*</label>
                <input type="password" id="new-password" name="new-password" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required /><br/>

                <label for="new-password-confirmation">Password Confirmation*</label>
                <input type="password" id="new-passwod-confirmation" name="new-password-confirmation" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required /><br/>
                
                <button type="submit">Send</button>
                <button type="reset">Cancel</button>
            </fieldset>
        </form>

        <?php
            require "utilities.php";
            
            //if the email is correct, print: An email has been send for the recovery of your password.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $recovery_email = $_POST['email-passwd-recovery'];
                $url = 'passwd_recovery_process.php';
                send_passwd_recovery_email($recovery_email, $url);
            }
        ?>
    </body>
</html>