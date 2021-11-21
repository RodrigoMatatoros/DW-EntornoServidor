<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require "../vendor/autoload.php";

		try {
			$connection_data = configBD("conf.xml");
			$bd = new PDO($connection_data[0], $connection_data[1], $connection_data[2]);
			// echo "Connected";
		}catch (PDOException $e) {
			echo '**Database error: ' . $e->getMessage();
		} 
    
	function configBD($file){
		$data = simplexml_load_file($file);
		$dbname = $data->xpath('//dbname');
		$host = $data->xpath('//host');
		$port = $data->xpath('//port');
		$user = $data->xpath('//user');
		$password = $data->xpath('//password');
		return array('mysql:dbname=' . $dbname[0] . ';host=' . $host[0], $user[0], $password[0]);
	}
    
	function validateXML(){
		$dept = new DOMDocument();
		$dept->load('conf.xml');
		$res = $dept->schemaValidate('configuration_schema.xsd');
		if ($res){ 
			echo "<br/>The file is valid";
		} 
		else { 
			echo "<br/>The file is not valid"; 
		}
	}

    function check_user_registration($user, $email, $bd){
        $query = "SELECT * FROM chatapp.users WHERE users.username like '$user' or users.email like '$email'";
        $bd->query($query);
        $result = $bd->query($query);
        // var_dump($result);
        $result = $result->fetch();
        // $result->fetch();

        if($result['username'] == $user || $result['email'] == $email){
            return TRUE;
        } else {
            return FALSE;
        }

        // if($result->rowCount() === 1){
        //     echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';			
        //     // return $result->fetch();
        // } else {
        //     echo '<p style="color:red">**ERROR: Check user or password!</p>';
        // }
    }

    function register_user($name, $surname, $username, $email, $passwd, $age, $tel, $pfp, $bd){
        $query = "INSERT INTO chatapp.users (usName, usSurname, username, email, passwd, age, telephone, pfp, isActive) VALUES ('$name', '$surname', '$username', '$email', '$passwd', '$age', '$tel', '$pfp', '0');";
        $result = $bd->query($query);
        //insert confirmation
        if($result->rowCount() > 0){
            echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';		
            // return $result->fetch();
        } else {
            echo '<p style="color:red">**ERROR: Check user or password!</p>';
        }
    }

    function check_user_login($user, $passwd, $bd){
        $userExists = $bd->query("SELECT users.username, users.id FROM chatapp.users WHERE users.username LIKE '$user'");
        // $userExists = $query->fetch();
        // var_dump($userExists);
        
        if($userExists->rowCount() > 0){
            $query = "SELECT users.passwd FROM chatapp.users WHERE users.username LIKE '$user'";
            $result = $bd->query($query);
            // $result = $result->fetch(); 
            // var_dump($result);
            // echo '<br/>';
            // var_dump(strval($result[0]));
            
            if($result->rowCount() > 0){
                // if($result->rowCount() > 0 && password_verify($passwd, strval($result))){
                $result = $result->fetch();
                if($user === 'root'){
                    if($passwd == strval($result['passwd'])){return TRUE;}
                    else {return FALSE;}
                } else {
                    if(password_verify($passwd, strval($result['passwd']))){
                        return TRUE;
                    } else {
                        // echo '<p style="color:red">**ERROR: Check user or password!</p>';
                        return FALSE;
                    }
                }
            }
        } else {
            return FALSE;
        }

        // if($resul->rowCount() === 1){		
        //     return $resul->fetch();		
        // }else{
        //     return FALSE;
        // }
    }

    // function isActive($user, $bool ,$bd){
    //     $query = "UPDATE chatapp.users SET 'users.isActive' = '$bool' WHERE users.username LIKE '$user'";
    //     $bd->query($query);
    // }

    #to fix
    function verifCode(){
        $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return $code;
    }
    $auxCode = verifCode();
    $verifCode = $auxCode . "";
    
    #to fix
    function verification($code, $verifCode){
        if($code == $verifCode){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function send_message($message, $senderID, /*chatID,*/$timestamp, $bd){
        if($message == ''){return TRUE;} //in this way, blank messages won't be sent 
        // $query = "INSERT INTO chatapp.messages (id, senderID, receiverID, content, msgTime, isRead) VALUES (NULL, '', '', '$message', '', '');";
        $query = "INSERT INTO chatapp.messages (senderID, chatID, content, msgTime) VALUES ('$senderID', '1', '$message', '$timestamp');";
        $result = $bd->query($query);
        
        return $result;
    }

    function get_messages(/*$senderID,*/$bd){
        // $query = "SELECT * FROM chatapp.messages WHERE messages.chatID LIKE '$chatID'";
        $query = "SELECT * FROM chatapp.messages WHERE messages.chatID LIKE 1";
        $result = $bd->query($query);
        $result = $result->fetchAll();
        // var_dump($result);

        return $result;
    }

    function get_chats($userID, $bd){
        $query = "SELECT * FROM chatapp.chats
                INNER JOIN chatapp.participate_user_chats ON chats.id = participate_users_chats.chatID
                INNER JOIN chatapp.users ON users.id = participate_users_chats.userID
                WHERE users.id LIKE '$userID'";
        
        $result = $bd->query($query);
        $result = $result->fetchAll();

        return $result;
    }

    function send_passwd_recovery_email($recovery_email = null, $url){
        //remember to change the email of the app
        try{
            $mail = new PHPMailer();
            $mail->IsSMTP();
            // comment the line below to hide the server messages after sending an email.
            // $mail->SMTPDebug  = 2;				
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";                 
            $mail->Host       = "smtp.gmail.com";    
            $mail->Port       = 587;
            // --
            $mail->Username   = "talesdemiletoxd@gmail.com"; 
            $mail->Password   = "12345tales";   	
            // --
            $mail->SetFrom('talesdemiletoxd@gmail.com');
            $mail->Subject    = 'PASSWORD RECOVERY';
            $mail->MsgHTML(
                'Here you have a link to complete the password recovery process:<br/>'
                 . 'http://localhost/project_first_term/'.$url //check this
                 . '<br/><br/>Good luck!'
            );
            // $mail->addAttachment($_FILES['file-send']);
            $mail->AddAddress($recovery_email);
            $result = $mail->Send();
        } catch (Exception $e){
            //nothing here
        }
        
        if($recovery_email){
            if(!$result) {
                echo "<p style=color:red>Error" . $mail->ErrorInfo . '</p>';
            } else {
                echo "An email with instructions has been sent to: <b>" . $recovery_email.'</b>';
                $recovery_email = null;
            }
        }
    }

    #to fix
    function send_verification_email($verif_email = null, $verifCode/*, $url*/){
        //remember to change the email of the app
        try{
            $mail = new PHPMailer();
            $mail->IsSMTP();
            // comment the line below to hide the server messages after sending an email.
            // $mail->SMTPDebug  = 2;				
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";                 
            $mail->Host       = "smtp.gmail.com";    
            $mail->Port       = 587;
            // --
            $mail->Username   = "talesdemiletoxd@gmail.com"; 
            $mail->Password   = "12345tales";   	
            // --
            $mail->SetFrom('talesdemiletoxd@gmail.com');
            $mail->Subject    = 'VERIFICATION';
            $mail->MsgHTML(
                'Here is the last step to complete your registration.<br/>
                You must enter the following code in the verification form: '
                 . '<br/> - <b>' . $verifCode . '</b>'
                //check this
                //  . '<br/> - http://localhost/project_first_term/'.$url
                 . '<br/><br/>Thank you for joining our family!'
            );
            // $mail->addAttachment($_FILES['file-send']);
            $mail->AddAddress($verif_email);
            $result = $mail->Send();
            return $result;
        } catch (Exception $e){
            return FALSE;
        }
    }
