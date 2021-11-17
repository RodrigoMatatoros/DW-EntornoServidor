<?php
    require_once 'utilities.php';

    session_start();
    // var_dump($_SESSION['user-id']);
    if(!isset($_SESSION['user-id']) || $_SESSION['user-id'] != 1){
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
        <a href="logout.php">Logout</a>
        <div class="users">
            <div class="user"></div>
            <button name="del-user">Delete user</button>
        </div>
        <div class="messages">
            <div class="messaage"></div>
            <button name="del-msg">Delete message</button>
        </div>
        <div class="chats">
            <div class="chat"></div>
            <button name="del-chat">Delete chat</button>
        </div>

        <br/>
        <button type="submit">Add user</button>
    </body>
</html>