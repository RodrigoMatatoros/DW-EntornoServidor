<?php
    require_once 'utilities.php';
    // include 'chatbox.php';
    // session_start();
    // $username = $_SESSION['user-register'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $query = $bd->query("SELECT users.id FROM chatapp.users WHERE users.username LIKE '$user'");
        $query = $bd->query("SELECT users.id FROM chatapp.users WHERE users.username LIKE 'alfreeznx'");
        echo '<br/>'; //don't really know why but without it the messages aren't printed
        $id = $query->fetch();
        // var_dump(intval($id[0]));

        $message = send_message($_POST['message'], intval($id[0]), $bd);
        if($message){
            $msgContent = $_POST['message'];

            # NONE OF THEM ACCUMULATES THE MESSAGES IN THE INTERFACE

            /* THIS WORKS:
            echo "
                <script>
                    var chatContainer = document.getElementById('chat');
                    console.log(chatContainer);
                    var newMessage = `
                        <div class='message-sent'>
                            <p>$msgContent</p>
                            <div class='message-timestamp-right'>SMS 15:07</div>
                        </div>
                    `;
                    // document.body.appendChild(newMessage);
                    document.body.innerHTML = newMessage;
                </script>
            ";
            */
            
            /*THIS ALSO WORKS
            echo "
                <script>
                    var chatContainer = document.getElementById('chat');
                    console.log(chatContainer);
                    var newMessage = document.createElement('div');
                    newMessage.setAttribute('class', 'message-sent');
                    newMessage.innerHTML = `
                        <p>$msgContent</p>
                        <div class='message-timestamp-right'>SMS 15:07</div>
                    `;
                    document.body.appendChild(newMessage);
                </script>
            ";
            */

            echo "
                <script>
                    var chatContainer = document.getElementById('chat');
                    console.log(chatContainer);
                    var newMessage = document.createElement('div');
                    newMessage.setAttribute('class', 'message-sent');
                    newMessage.innerHTML = `
                        <p>$msgContent</p>
                        <div class='message-timestamp-right'>SMS 15:07</div>
                    `;
                    document.body.appendChild(newMessage);
                </script>
            ";
        } else {
            echo '<p style=color:red>**ERROR: Something went wrong and the message could not be sent.</p>';
        }
    }
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
        <div class="main-container">
            <div class="sidebar">
                <div class="profile">Profile</div>
                <div class="chats">Chats</div>
            </div>
            <div class="current-chat">
                <div class="contact-info">Contact Info</div>
                <div class="chat"  id="chat">
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
                    </div>
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