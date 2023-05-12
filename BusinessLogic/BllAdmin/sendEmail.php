<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Web/Library/PHPMailer-Master/src/Exception.php';
require '../../Web/Library/PHPMailer-Master/src/PHPMailer.php';
require '../../Web/Library/PHPMailer-Master/src/SMTP.php';   

class sendEmail
{
        public static function sendEmail($recipientEmail, $name){

        // Create a new PHPMailer instance
        $mail = new PHPMailer;

        // Enable SMTP debugging (optional)
        //$mail->SMTPDebug = 2;

        // Set the SMTP server and port number
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tarumteventticketing@gmail.com';
        $mail->Password = 'cvkqkzrmwhrtwgpm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set the sender and recipient email addresses
        $mail->setFrom('tarumteventticketing@gmail.com', 'TARUMT_Event_Ticketing');
        $mail->addAddress($recipientEmail, $name);

        // Set the email subject and message body
        $mail->Subject = 'Your Account Has Been Created';
        //$mail->Body = 'This is a test email message.';

        $mail->msgHTML('
            <p>Hi '.$name.'!</p>
            <p>Your account <b>'.$recipientEmail.'</b> has been created.</p>
            <p>To set password and log in, please click the button below : </p>
            <a href="http://localhost/TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminSetPassword.php" style="background-color: #4CAF50; color: white; padding: 12px 24px; text-align: center; text-decoration: none; display: block; margin: 0 auto; border-radius: 4px;">Set Password</a>
        ');

        // Send the email
        if (!$mail->send()) {
            return false;
        } else {
            return true;

        }
    }
}



?>

