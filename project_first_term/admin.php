<?php
    require_once 'utilities.php';

    session_start();
    if(!isset($_SESSION['codUser']) || $_SESSION['codUser'] != 1){
        header('Location: logout.php');
    }

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN ZONE</title>
    </head>

    <header>
        <h1>Admin Zone</h1>
    </header>

    <body>
        <div class="users">
            <div class="user"></div>
            <button name="del-user"></button>
        </div>
        <div class="messages">
            <div class="messaage"></div>
            <button name="del-msg"></button>
        </div>
        <div class="chats">
            <div class="chat"></div>
            <button name="del-chat"></button>
        </div>

        <?php include 'register.php' ?>

        <button type="submit"></button>
    </body>
</html>