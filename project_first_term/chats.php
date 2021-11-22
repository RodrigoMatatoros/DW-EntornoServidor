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
        <link rel="stylesheet" href="assets/css/chats_style.css">
        <title>Chats</title>
    </head>
    
    <body>
        <div class="nav-container">
            <nav>
                <a href="logout.php">Logout</a>
                <a href="chats.php">Home</a>
                <!-- <a href="index.php?page=current_chat&chat-id=" . $chatID>Last Chat</a> -->
            </nav>
        </div>
        <div class="main-container">
            <div class="sidebar">
                <div class="profile">
                    <img src="<?= $pfp ?>" onerror="this.src='assets/files/img/default/pfp_default.jpg'" alt="Profile Picture">
                    <div class="profile-data-box">
                        <p class="data-item"><?= $user ?></p>
                        <p class="data-item"><?= $userName . ' ' . $userSurname ?></p>
                        <p class="data-item">Status</p>
                    </div>
                    <a class="edit-link" href="edit_profile.php">Edit</a>
                </div>
                <div class="search-contacts">
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contact-list'])){
                            $alias = $_POST['chat-alias'];
                            $chatID = create_chat_get_id($alias, $bd);
                            // var_dump($chatID);

                            $resultInsertParticipant = add_participants_chat($userID, $chatID, $bd);
                            // if (!$resultInsertParticipant) {
                            //     $messageError = "Please verify your information";
                            //     header('Location: login.php');
                            // }
                            // var_dump($_POST['contactlist']);
                            foreach($_POST['contact-list'] as $participant){
                                // var_dump($participant);
                                
                                $resultInsertParticipant = add_participants_chat($participant, $chatID, $bd);
                                // if (!$resultInsertParticipant) {
                                    //     $messageError = "Please verify your information";
                                    // }
                            }
                            header('Location: index.php?page=current_chat&chat-id='. $chatID .'');
                        }
                    ?>
                    <form action="" method="POST" autocomplete="off">
                        <!-- <input type="text" list="contacts" name="contact-list" multiple placeholder="Search..."/> -->
                        <input type="text" name="chat-alias" placeholder="Alias..."/>
                        <select name="contact-list[]" multiple placeholder="Search...">
                        <!-- <datalist id="contacts"> -->
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['id'] ?>"><?=$user['username']?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- </datalist> -->
                        <button type="submit">OK</button>
                        <button type="reset">Cancel</button>
                    </form>
                </div>
                <div class="chats">
                    <?php
                        $query = "SELECT * FROM chatapp.chats   
                                    INNER JOIN chatapp.participate_users_chats ON chats.id = participate_users_chats.chatID
                                    INNER JOIN chatapp.users ON users.id = participate_users_chats.userID
                                    WHERE users.id LIKE '$userID'";
                        $result = $bd->query($query);
                        $chats = $result->fetchAll();
                        foreach($chats as $chat){
                            echo '
                                <a href="index.php?page=current_chat&chat-id='. $chat['chatID'] .'">
                                    <div  class="chat">'
                                        . $chat['alias'] . 
                                    '</div>
                                </a>
                            ';  
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>