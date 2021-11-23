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
        if(empty($pfp)){
            $query = "INSERT INTO chatapp.users (usName, usSurname, username, email, passwd, age, telephone) VALUES ('$name', '$surname', '$username', '$email', '$passwd', '$age', '$tel');";
            $result = $bd->query($query);
            //insert confirmation
            if($result->rowCount() > 0){
                echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';		
                // return $result->fetch();
            } else {
                echo '<p style="color:red">**ERROR: Check user or password!</p>';
            }
        } else {
            $query = "INSERT INTO chatapp.users (usName, usSurname, username, email, passwd, age, telephone, pfp) VALUES ('$name', '$surname', '$username', '$email', '$passwd', '$age', '$tel', '$pfp');";
            $result = $bd->query($query);
            //insert confirmation
            if($result->rowCount() > 0){
                echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';		
                // return $result->fetch();
            } else {
                echo '<p style="color:red">**ERROR: Check user or password!</p>';
            }
        }
    }

    function check_user_login($user, $passwd, $bd){
        $userExists = $bd->query("SELECT users.id FROM chatapp.users WHERE users.username LIKE '$user'");
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

        /*
        $query = "SELECT users.passwd FROM chatapp.users WHERE users.username LIKE '$user'";
        $result = $bd->query($query);
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
        } else {
            echo '<p style="color:red">**ERROR: No passwords received from the database!</p>';
        }
        */
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

    function send_message($message, $senderID, $chatID, $timestamp, $bd){
        if($message == ''){return TRUE;} //in this way, blank messages won't be sent 
        // $query = "INSERT INTO chatapp.messages (id, senderID, receiverID, content, msgTime, isRead) VALUES (NULL, '', '', '$message', '', '');";
        $query = "INSERT INTO chatapp.messages (senderID, chatID, content, msgTime) VALUES ('$senderID', '$chatID', '$message', '$timestamp');";
        $result = $bd->query($query);
        
        return $result;
    }

    function get_messages($chatID, $bd){
        // $query = "SELECT * FROM chatapp.messages WHERE messages.chatID LIKE '$chatID'";
        $query = "SELECT * FROM chatapp.messages WHERE messages.chatID LIKE $chatID";
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

    function create_chat_get_id($alias, $bd){
        $query = "INSERT INTO `chats`(`alias`) VALUES ('$alias')";
        $result = $bd->query($query);

        $query2 = "SELECT chats.id FROM chatapp.chats WHERE chats.alias LIKE '$alias' ORDER BY chats.id DESC LIMIT 1";
        $result2 = $bd->query($query2);
        $id = $result2->fetch();
        return $id[0];
    }

    function add_participants_chat($participant, $chatID, $bd){
        $query = "INSERT INTO `participate_users_chats`(`userID`, `chatID`) VALUES ('$participant','$chatID')";
        $result = $bd->query($query);

        $count = $result->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function leave_group($userID, $chatID, $bd){
        $query = "DELETE FROM chatapp.participate_users_chats WHERE participate_users_chats.userID LIKE $userID AND participate_users_chats.chatID LIKE $chatID";
        // $result = $bd->query($query);
        $statement = $bd->query($query);
        // var_dump($statement);
        $result = $statement->fetch();
        // var_dump($result);
        
        return $result;
    }

    function upload_file(){
        if (empty($_FILES["pfp-register"]["name"])) {
            return "";
        }
        
        $target_dir = "assets/files/uploads/";
        $target_file = $target_dir . basename($_FILES["pfp-register"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["pfp-register"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["pfp-register"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["pfp-register"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["pfp-register"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
        }

        return $target_file;
    }

    function upload_file_edit_profile(){
        if (empty($_FILES["pfp-edit"]["name"])) {
            return "";
        }
        
        $target_dir = "assets/files/uploads/";
        $target_file = $target_dir . basename($_FILES["pfp-edit"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["pfp-edit"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($_FILES["pfp-edit"]["size"] > 5000000) {
            echo '<p style="color:red">ERROR: Sorry, your file is too large.</p>';
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo '<p style="color:red">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<p style="color:red">ERROR: Sorry, your file was not uploaded.</p>';
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["pfp-edit"]["tmp_name"], $target_file)) {
                    // echo "The file ". htmlspecialchars( basename( $_FILES["pfp-edit"]["name"])). " has been uploaded.";
                } else {
                    echo '<p style="color:red">ERROR: Sorry, there was an error uploading your file.</p>';
                }
        }

        return $target_file;
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
