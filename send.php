<?php
require  __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
if(isset($_POST["send"])){
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $_ENV["HOST"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV["MAIL_USERNAME"];
    $mail->Password   = $_ENV["EMAIL_PASSWORD"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $_ENV["EMAIL_PORT"];
    $mail->setFrom($_ENV["MAIL_USERNAME"], 'Always Healthy');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = 'Daily Diet';
    $mail->Body    = "Welcome to Always Healthy, here is the website's daily diet!<img src=''>";
    $mail->AltBody = "Welcome to Always Healthy, here is the website's daily diet!";
    $mail->AddAttachment('pdf_files/diet.pdf', 'diet.pdf');
    $mail->send();
    header("Location: index.php");
    return;
} else {
    header("Location: index.php");
    return;
} 
?>