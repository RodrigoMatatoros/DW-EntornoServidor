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

    if(isset($_GET['chat-id'])){
        $chatID = $_GET['chat-id'];
    } else {
        header('Location: chats.php');
    }

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/project_first_term/assets/css/current_chat_style.css">
        <title>ChatApp</title>
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
        <div class="main-container">
            <div class="current-chat">
                <div class="contact-info">
                    <?php
                        $query = "SELECT count(participate_users_chats.userID) FROM chatapp.participate_users_chats WHERE chatID LIKE $chatID";
                        $result = $bd->query($query);
                        $usersCount = $result->fetch();
                        // var_dump($usersCount);
                        if(intval($usersCount[0]) > 2){
                            echo '<a href="index.php?page=leave_groups&user-id=' . $userID . '&chat-id=' . $chatID . '">Leave</a>';
                            // echo '<a href="chats.php" onclick="' . leave_group($userID, $chatID, $bd) . '">Leave</a>';
                        }
                    ?>
                    
                </div>
                <div class="chat-box"  id="chat">
                    <?php
                        #get current chat messages
                        $query = "SELECT *, users.username FROM chatapp.messages
                                    INNER JOIN chatapp.users ON users.id = messages.senderID
                                    WHERE messages.chatID LIKE '$chatID'
                                    ORDER BY messages.msgTime";
                        $result = $bd->query($query);
                        $firstMessages = $result->fetchAll();

                        foreach($firstMessages as $msg){
                            if($msg['senderID'] == intval($userID)){
                                $containerClass = 'class="message-sent"';
                                $timestampClass = 'class="message-timestamp-right"';
                            } else{
                                $containerClass = 'class="message-received"';
                                $timestampClass = 'class="message-timestamp-left"';
                            }

                            echo '
                                    <div ' . $containerClass .'>
                                        <div class="message-sender" style="text-align:center; border: 0; border-radius:0; border-bottom:1px solid black; font-weight:bold; margin: 0;">' . $msg['username'] . '</div>
                                        <p class="message-content">' . $msg['content'] . '</p>
                                        <div ' . $timestampClass . '>' . $msg['msgTime'] . '</div>
                                    </div>
                                ';
                        }

                        ###send messages and get them
                        // var_dump($userID);
                        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])){
                            $date = date('Y-m-d H:i:s');
                            $newMessage = $_POST['message'];
                            $message = send_message($newMessage, $userID, $chatID, $date, $bd);

                            if(!$message){
                                // echo '<p style="color:red">**ERROR: Something went wrong and the message could not be sent.</p>';
                            } else {
                                header("Location: index.php?page=current_chat&chat-id=$chatID");
                                // header_remove("Location: index.php?page=current_chat&chat-id=$chatID");
                            }
                        }
                        // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])){
                        //     $date = date('Y-m-d H:i:s');
                        //     $newMessage = $_POST['message'];
                        //     $message = send_message($newMessage, $userID, $chatID, $date, $bd);

                        //     if(!$message){
                        //         echo '<p style=color:red>**ERROR: Something went wrong and the message could not be sent.</p>';
                        //     } else {
                        //     }
                        // }   
                    ?>
                </div>
                <div class="send-message">
                    <form action="" method="POST" autocomplete="off">
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