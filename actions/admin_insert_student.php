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

if (isset($_POST['add-student'])) {
  $lrn_number = $_POST['lrnNumber'];
  $fname = ucfirst($_POST['fname']);
  $mname = ucfirst($_POST['mname']);
  $lname = ucfirst($_POST['lname']);
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $birthday = $_POST['birthday'];
  $address = $_POST['address'];
  $password = $fname . $lname;
  $status = 0;
  $role = "student";

  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  $stmtCheckEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmtCheckEmail->bind_param("s", $email);
  $stmtCheckEmail->execute();
  $stmtResult = $stmtCheckEmail->get_result();

  $stmtCheckLrn = $conn->prepare("SELECT * FROM users WHERE lrn_number = ?");
  $stmtCheckLrn->bind_param("s", $lrn_number);
  $stmtCheckLrn->execute();
  $stmtResultLrn = $stmtCheckLrn->get_result();

  if (mysqli_num_rows($stmtResultLrn) > 0) {
    $_SESSION['duplicate-lrn'] = "This LRN Number Is Already Registered";
    header("Location: ../admin/admin_student.php");
    exit();
  } elseif (mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-email'] = "This Email Is Already Registered";
    header("Location: ../admin/admin_student.php");
    exit();
  } else {
    $stmtInsertStudent = $conn->prepare("INSERT INTO users (role, lrn_number, fname, lname, mname, gender, birthday, contact, email, address, password, status, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmtInsertStudent->bind_param("sssssssssssi", $role, $lrn_number, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $password_hashed, $status);

    if (mysqli_stmt_execute($stmtInsertStudent)) {

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
        $mail->setFrom('sanjivinsmoke0000@gmail.com', 'SJDC');
        $mail->addAddress($email);               //Name is optional

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Portal Account';
        $mail->Body    = 'Your account' . ' ' . $email . ' ' . 'has been created and password is ' . $fname.$lname . '. ' . 'Please change your password after you received this message.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION['add-student'] = "Successfully Added Student";
        header("Location: ../admin/admin_student.php");
        exit();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    } else {
      header("Location: ../admin/admin_student.php");
      exit();
    }
  }
}
