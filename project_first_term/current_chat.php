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
        <link rel="stylesheet" type="text/css" href="assets/css/current_chat_style.css">
        <title>ChatApp</title>
        <!-- DOESN'T WORK -->
        <!-- <script>
            var chatBox = document.getElementById('chat');
            function start(){
                chatBox.addEventListener('mouseenter', function(){
                    this.classList.add("active");
                });

                chatBox.addEventListener('mouseenter', function(){
                    this.classList.remove("active");
                });

                if(!chatBox.classList.contains('active')){   
                    scrollToBottom();
                }
            }

            function scrollToBottom(){
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            window.onload = start;
        </script> -->
    </head>
    <body>
        <div class="nav-container">
            <nav>
                <a href="logout.php">Logout</a>
                <a href="chats.php">Home</a>
            </nav>
        </div>
        <div class="main-container">
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
                        #get current chat messages
                        $query = "SELECT * FROM chatapp.messages WHERE messages.chatID LIKE '$chatID'";
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
                                    <p class="message-content">' . $msg['content'] . '</p>
                                    <div ' . $timestampClass . '>' . $msg['msgTime'] . '</div>
                                </div>
                            ';
                        }

                        ###send messages and get them
                        // var_dump($userID);
                           if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])){
                            $date = date('Y-m-d H:i:s');
                            $newMessage = $_POST['message'];
                            $message = send_message($newMessage, $userID, $chatID, $date, $bd);
                            // $_POST['message'] = NULL;
                            // $newMessage = NULL;
                            // unset($_POST['message']);
                            // var_dump($newMessage);
                            if(!$message){
                                echo '<p style=color:red>**ERROR: Something went wrong and the message could not be sent.</p>';
                            } else {
                                // $messages = get_messages(/*intval($userID),*/ $chatID, $bd);
                                // var_dump($messages);
                                // foreach($messages as $msg){
                                //     if($msg['senderID'] == intval($userID)){
                                //         $containerClass = 'class="message-sent"';
                                //         $timestampClass = 'class="message-timestamp-right"';
                                //     } else{
                                //         $containerClass = 'class="message-received"';
                                //         $timestampClass = 'class="message-timestamp-left"';
                                //     }
                                    
                                //         echo '
                                //             <div ' . $containerClass .'>
                                //                 <p class="message-content">' . $msg['content'] . '</p>
                                //                 <div ' . $timestampClass . '>' . $msg['msgTime'] . '</div>
                                //             </div>
                                //         ';
                                //     }
                                // }
                                header('Location: index.php?page=current_chat&chat-id='. $chatID .'');
                            }
                        }
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