<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require "../vendor/autoload.php";
        
    function check_user(){
        // - 
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
            $resul = $mail->Send();
        } catch (Exception $e){
            //nothing here
        }
        
        if($recovery_email){
            if(!$resul) {
                echo "Error" . $mail->ErrorInfo;
            } else {
                echo "An email with instructions has been sent to: " . $recovery_email;
                $recovery_email = null;
            }
        }
    }