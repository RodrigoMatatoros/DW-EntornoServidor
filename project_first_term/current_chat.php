<?php
    require_once 'utilities.php';
    // include 'chatbox.php';
    session_start();
    // $username = $_SESSION['user-register'];
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="chat_style.css">
        <title>ChatApp</title>
    </head>
    <body>
        <a href="logout.php">Logout</a>
        <div class="main-container">
            <div class="sidebar">
                <div class="profile">Profile</div>
                <div class="chats">Chats</div>
            </div>
            <div class="current-chat">
                <div class="contact-info">Contact Info</div>
                <div class="chat"  id="chat">
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
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
                            $date = date('Y-m-d H:i:s');
                            $message = send_message($_POST['message'], intval($_SESSION['user-id']), /* chatID,*/ $date, $bd);
                            if(!$message){
                                echo '<p style=color:red>**ERROR: Something went wrong and the message could not be sent.</p>';
                            } else {
                                $messages = get_messages(intval($_SESSION['user-id']), $bd);
                                // var_dump($messages);
                                foreach($messages as $msg){
                                    if($msg['senderID'] == intval($_SESSION['user-id'])){
                                        $containerClass = 'class="message-sent"';
                                        $timestampClass = 'class="message-timestamp-right"';
                                    } else{
                                        $containerClass = 'class="message-received"';
                                        $timestampClass = 'class="message-timestamp-left"';
                                    }
                                    
                                    echo '
                                        <div ' . $containerClass .'>
                                            <p>' . $msg['content'] . '</p>
                                            <div ' . $timestampClass . '>' . $msg['msgTime'] . '</div>
                                        </div>
                                    ';
                                }
                            }
                        }
                    ?>
                </div>
                <div class="send-message">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                        <div class="message-box">
                            <!-- <input type="text" id="message-box" name="message" placeholder="Escribe un mensaje..." autofocus> -->
                            <textarea rows="10" cols="50" name="message" placeholder="Escribe un mensaje..." autofocus></textarea>
                        </div>
                        <div class="send-message-button">
                            <button type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>