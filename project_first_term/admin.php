<?php
    require_once 'utilities.php';

    session_start();
    $userID = $_SESSION['user-id'];
    $user = $_SESSION['username'];
    $userName = $_SESSION['user-name'];
    $userSurname = $_SESSION['user-surname'];
    $email = $_SESSION['user-email'];
    $age = $_SESSION['user-age'];
    $telephone = $_SESSION['user-telephone'];
    $pfp = $_SESSION['user-pfp'];
    $userActive = $_SESSION['user-active'];
    $role = $_SESSION['user-role'];

    // var_dump($_SESSION['user-id']);
    if(!isset($userID) || $role != 'admin'){
        header('Location: logout.php');
    }

    $queryUsers = "SELECT * FROM users";
    $result = $bd->query($queryUsers);
    $resultUsers = $result->fetchAll();

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/admin_style.css">
        <title>ADMIN ZONE</title>
    </head>

    <body>
        <style>
            nav{background-color: white;}
            .nav-container{margin: 10px;background-color: white;position: sticky;
                top: 0px;display: flex;justify-content: space-between;
                align-items: center;z-index: 1;padding: 0 3em;border: 1px solid black;}
            nav{padding: 5px;width: 100%;height: 100%;}
            .nav-container a{margin: 1.5em;display: inline;
                text-decoration: none;line-height: 0.2em;width: 5em;}
            .nav-container a{color: black;}
            .nav-container a:hover{text-decoration: underline;}
        </style>
        <div class="nav-container">
            <nav>
                <a href="logout.php">Logout</a>
                <a href="chats.php">Home</a>
            </nav>
        </div>

        <header>
            <h1>Admin Zone</h1>
        </header>

        <div class="users">
                <?php foreach($resultUsers as $user) : ?>
                    <div class="user-admin">
                        <p class="item"><?= " -id:[" . $user['id'] . "]" ?></p>
                        <p class="item"><?= " -name:[" . $user['usName'] . "]" ?></p>
                        <p class="item"><?= " -surname:[" . $user['usSurname'] . "]" ?></p>
                        <p class="item"><?= " -username:[" . $user['username'] . "]" ?></p>
                        <p class="item"><?= " -email:[" . $user['email'] . "]" ?></p>
                        <p class="item"><?= " -age:[" . $user['age'] . "]" ?></p>
                        <p class="item"><?= " -tel:[ " . $user['telephone'] . "]" ?></p>
                        <p class="item"><?= " -pfp:[" . $user['pfp'] . "]" ?></p>
                        <p class="item"><?= " -active:[" . $user['isActive'] . "]" ?></p>
                        <p class="item"><?= " -role:[" . $user['usRole'] . "]" ?></p>
                    </div>
                <?php endforeach;?>
            </div>
            <button name="del-user">Delete user</button>
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