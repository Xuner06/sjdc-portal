<?php
include("../database/database.php");
session_start();

require '../plugins/phpmailer/src/Exception.php';
require '../plugins/phpmailer/src/PHPMailer.php';
require '../plugins/phpmailer/src/SMTP.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_POST['send'])) {
  $email = $_POST['email'];
  $token = bin2hex(random_bytes(16));
  $token_hash = hash("sha256", $token);
  $expiry = date("Y-m-d H:i:s", strtotime('+30 minutes'));

  $stmtCheck = $conn->prepare("SELECT * FROM users u WHERE u.email = ?");
  $stmtCheck->bind_param("s", $email);
  $stmtCheck->execute();
  $stmtResult = $stmtCheck->get_result();

  if (mysqli_num_rows($stmtResult) > 0) {
    $updateToken = $conn->prepare("UPDATE users SET token = ?, token_expiration = ? WHERE email = ?");
    $updateToken->bind_param("sss", $token_hash, $expiry, $email);
    $updateToken->execute();

    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'sanjivinsmoke0000@gmail.com';                     //SMTP username
      $mail->Password   = 'mynyslrvefibsujd';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('anjivinsmoke0000@gmail.com', 'SJDC');
      $mail->addAddress($email);               //Name is optional
  
      //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Password Reset';
      $mail->Body    = 'Click <a href="http://localhost/sjdc-portal/password_reset.php?token=' . $token . '">here</a> to reset your password';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
      $mail->send();
      $_SESSION['email-send'] = "Kindly Check Your Email";
      header("Location: ../forgot_password.php");
      exit();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

  }
  else {
    $_SESSION['email-send'] = "Kindly Check Your Email";
    header("Location: ../forgot_password.php");
    exit();
  }
}
