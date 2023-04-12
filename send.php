<?php
require  __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> load();

//Create an instance; passing `true` enables exceptions
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
if(isset($_POST["send"])){
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $_ENV["HOST"];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV["MAIL_USERNAME"];                     //SMTP username
    $mail->Password   = $_ENV["EMAIL_PASSWORD"];                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = $_ENV["EMAIL_PORT"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($_ENV["MAIL_USERNAME"], 'Always Healthy');
    $mail->addAddress($_POST["email"]);               //Name is optional
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Daily Diet';
    $mail->Body    = "Welcome to Always Healthy, here is the website's daily diet!<img src=''>";
    $mail->AltBody = "Welcome to Always Healthy, here is the website's daily diet!";
    $mail->AddAttachment('pdf_files/diet.pdf', 'diet.pdf');
    $mail->send();
    header("Location: index.php");
}
else{
    header("Location: index.php");
} 
?>