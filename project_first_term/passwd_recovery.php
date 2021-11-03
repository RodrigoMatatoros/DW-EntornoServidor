<?php
    //if the email is correct, print: An email has been send for the recovery of your password.
?>

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
                <label for="email-passwd-recover">Email for the recovery*</label>
                <input type="email" id="email-passwd-recovery" value = "<?php if(isset($email_passwdRecovery))echo $email_passwdRecovery;?>" ><br/>

                <button type="submit">Send</button>
                <button type="reset">Cancel</button>
            </fieldset>
        </form>
    </body>
</html>