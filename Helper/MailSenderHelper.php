<?php

/**
 * Description of MailSenderHelper
 *
 * @author vinnie
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/TARUMT_Event_Ticketing/vendor/autoload.php';

class MailSenderHelper {

    public static function sendMail($userEmail, $title, $content, $action) {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('adoptme.ewyv.noreply@gmail.com')
                ->setPassword('czzlcsrigfwyieug');

        $mailer = new Swift_Mailer($transport);

        $randomOTP = '';
        if($action == "resetPwd")
            $randomOTP = 'Your OTP is: '.self::getRandomOTP();

        $body = '<!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>'.$title.'</title>
            </head>
            <body>
                <h3>'.$content.'</h3>
                <p>'. $randomOTP . '</p>
            </body>
        </html>';

        $message = (new Swift_Message($title))
                ->setFrom(['adoptme.ewyv.noreply@gmail.com' => 'TARUMT Event Ticketing'])
                ->setTo($userEmail)
                ->setBody($body, 'text/html');

        $result = $mailer->send($message);
        
        return $randomOTP;
    }

    public static function getRandomOTP() {
        // Generate random number
        $number = rand(100000, 999999);

        // Convert any number sequence into 6 digits as OTP
        return strval($number);
    }

}
