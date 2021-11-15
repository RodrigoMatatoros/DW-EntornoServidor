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
                <input type="text" id="user-recover" name="user-recover" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required autofocus/><br/>

                <label for="new-passwd">New Password*</label>
                <input type="password" id="new-passwd" name="new-passwd" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required /><br/>

                <label for="new-passwd-confirmation">Password Confirmation*</label>
                <input type="password" id="new-passwd-confirmation" name="new-passwd-confirmation" value="<?php if(isset($recovery_email))echo $recovery_email;?>" required /><br/>
                
                <button type="submit">Send</button>
                <button type="reset">Cancel</button>
            </fieldset>
        </form>

        <?php
            require "utilities.php";
            
            //if the email is correct, print: An email has been send for the recovery of your password.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $username = $_POST['user-recovery'];
                $newPassword = $_POST['new-passwd'];
                $newPasswordConfirmation = $_POST['new-passwd-confirmation'];

                if($newPassword === $newPasswordConfirmation){
                    //check smth with ids too
                    $encryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $query = "UPDATE chatapp.users SET users.passwd = '$encryptedPassword' WHERE users.username LIKE '$username'";
                    $result = $bd->query($query);
                    //update confirmation (?)
                    if($result->rowCount() === 1){		
                        echo '<p style="color:lightgreen">**SUCCESS: the password was updated correctly!</p>';
                        return $result->fetch();		
                    } else {
                        return FALSE;
                    }
                } else {
                    echo '<p style="color:red">**ERROR: the password and its confirmation do not match!</p>';
                }
            }
        ?>
    </body>
</html>