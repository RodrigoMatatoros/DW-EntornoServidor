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
    // var_dump($pfp);

    $query = "SELECT * FROM chatapp.users WHERE users.username NOT LIKE '$user'";
    $result = $bd->query($query);
    $users = $result->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/edit_profile_style.css">
        <title>Edit Profile</title>
    </head>
    <body>
        <div class="nav-container">
            <nav>
                <a href="logout.php">Logout</a>
                <a href="chats.php">Home</a>
                <!-- <a href="current_chat.php">Last Chat</a> -->
            </nav>
        </div>
        <div class="main-container">
            <img src="<?= $pfp ?>" alt="Profile picture">
            <div class="data-box">
                <div class="data-item"><?= $user ?></div>
                <div class="data-item"><?= $userName . ' ' . $userSurname ?></div>
                <div class="data-item"><?= 'Status' ?></div>
            </div>
        </div>
    </body>
</html>