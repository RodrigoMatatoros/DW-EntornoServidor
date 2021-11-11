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
        $result = $bd->query($query);

        if($result->rowCount() === 1){		
            return $result->fetch();		
        } else {
            return FALSE;
        }
    }

    function register_user($name, $surname, $username, $email, $passwd, $age, $tel, $bd){
        $query = "INSERT INTO chatapp.users (id, usName, usSurname, username, email, passwd, age, isActive) VALUES (NULL, '$name', '$surname', '$username', '$email', '$passwd', '$age', '0');";
        $result = $bd->query($query);
        //insert confirmation
        if($result->rowCount() === 1){
            echo '<p style="color:lightgreen">**SUCCESS: Registration complete!</p>';		
            return $result->fetch();	
        } else {
            return FALSE;
        }
    }

    function check_user_login($user, $passwd, $bd){

        // $query = "SELECT * FROM chatapp.users WHERE users.username like '$user' and users.passwd like '$passwd'";
        $query = "SELECT users.passwd FROM chatapp.users WHERE users.username LIKE '$user'";
        $result = $bd->query($query);
        $result = $result->fetch();
        
        if($result->rowCount() > 0){
            if(password_verify($passwd, strval($result))){header('Location: index.html');}
        } else {
            return FALSE;
        }
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
                echo "Error" . $mail->ErrorInfo;
            } else {
                echo "An email with instructions has been sent to: <b>" . $recovery_email.'</b>';
                $recovery_email = null;
            }
        }
    }
