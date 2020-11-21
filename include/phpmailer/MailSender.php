<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('include/phpmailer/Exception.php');
require('include/phpmailer/PHPMailer.php');
require('include/phpmailer/SMTP.php');

class MailSender
{
   public static function send($arrayData, $to, $object, $body) {
        if(isset($arrayData['SMTP']))
        {
			try {
				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->Host = htmlspecialchars($arrayData['SMTP']['Host']);
				$mail->SMTPAuth = true;
				$mail->Username = htmlspecialchars($arrayData['SMTP']['Username']);
				$mail->Password = htmlspecialchars($arrayData['SMTP']['Password']);
				$mail->SMTPSecure = $arrayData['SMTP']['Protocol'];
				$mail->Port = $arrayData['SMTP']['Port'];
				$mail->Timeout = 5;
				$mail->From = $arrayData['SMTP']['From'];
				$mail->FromName = $arrayData['General']['name'];
				$mail->addAddress($to);   
				$mail->addReplyTo($arrayData['SMTP']['Reply'], $arrayData['General']['name']);
				$mail->isHTML(true);                               
				$mail->Subject = htmlspecialchars($object);
				$mail->Body    = $body.'<br></br>'.$arrayData['SMTP']['Footer'];
				$mail->AltBody = strip_tags($body);
				return $mail->send();
			} catch(Exception $e) {
				return false;
			}
        }else{
           return mail($to, $object, $body);
        }
    }
}