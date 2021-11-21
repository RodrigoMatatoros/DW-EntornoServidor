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
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/chat_style.css">
        <title>ChatApp</title>
    </head>
    <body>
        <a href="logout.php">Logout</a>
        <div class="main-container">
            <div class="sidebar">
                <div class="profile">
                    <img src="<?php if($pfp != ''){echo 'assets/files/img/' . $pfp;}?>" onerror="this.src='assets/files/img/default/pfp_default.jpg'" alt="Profile Picture">
                    <div class="profile-data-box">
                        <p class="data-item"><?= $user ?></p>
                        <p class="data-item"><?= $userName . ' ' . $userSurname ?></p>
                        <p class="data-item">Status</p>
                    </div>
                    <a class="edit-link" href="#">Edit</a> <!-- href="profile.php" -->
                </div>
                <div class="search-contacts">SEARCH CONTACTS</div>
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
                                <div class="chat">' . $chat['alias'] . '</div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="current-chat">
                <div class="contact-info">Contact Info</div>
                <div class="chat-box"  id="chat">
                    <!--EXAMPLE MESSAGES-->
                    <!--
                    <div class="message-received">
                        <p class="message-content">This is an awesome message!</p>
                        <div class="message-timestamp-left">SMS 13:37</div>
                    </div>
        
                    <div class="message-sent">
                        <p class="message-content">I agree that your message is awesome!</p>
                        <div class="message-timestamp-right">SMS 13:37</div>
                    </div>

                    <div class="message-received">
                        <p class="message-content">Thanks!</p>
                        <div class="message-timestamp-left">SMS 13:37</div>
                    </div>
                    -->
                    <?php
                        // var_dump($userID);
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])){
                            $date = date('Y-m-d H:i:s');
                            $newMessage = $_POST['message'];
                            $message = send_message($newMessage, $userID, /*chatID,*/$date, $bd);
                            // $_POST['message'] = NULL;
                            // $newMessage = NULL;
                            unset($_POST['message']);
                            var_dump($newMessage);
                            if(!$message){
                                echo '<p style=color:red>**ERROR: Something went wrong and the message could not be sent.</p>';
                            } else {
                                $messages = get_messages(/*intval($userID),*/ /*chatID,*/$bd);
                                // var_dump($messages);
                                foreach($messages as $msg){
                                    if($msg['senderID'] == intval($userID)){
                                        $containerClass = 'class="message-sent"';
                                        $timestampClass = 'class="message-timestamp-right"';
                                    } else{
                                        $containerClass = 'class="message-received"';
                                        $timestampClass = 'class="message-timestamp-left"';
                                    }
                                    
                                    echo '
                                        <div ' . $containerClass .'>
                                            <p class="message-content">' . $msg['content'] . '</p>
                                            <div ' . $timestampClass . '>' . $msg['msgTime'] . '</div>
                                        </div>
                                    ';
                                }
                                // header('Location: current_chat.php');
                            }
                        }
                    ?>
                </div>
                <div class="send-message">
                    <form action="" method="POST">
                        <div class="message-box">
                            <!-- <input type="text" id="message-box" name="message" placeholder="Escribe un mensaje..." autofocus> -->
                            <textarea rows="10" cols="50" name="message" placeholder="Type your message here..." autofocus></textarea>
                        </div>
                        <div class="send-message-button" id="send-msg">
                            <button type="submit">Send</button>
                            <!-- look how to make the chat div scroll down automatically -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>