<?php
    require_once 'utilities.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if(verification($_POST['verif-code'], $verifCode)){
            header('Location: chat.php');
        } else {
            echo '<p style=color:red>The code was incorrect.';
        }
    }

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verification</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <label for="verif-code">Enter your verification code:</label>
            <input type="text" id="verif-code" name="verif-code" pattern="[0-9]{6}"/>
            <button type="submit">Send</button>
        </form>
    </body>
</html>