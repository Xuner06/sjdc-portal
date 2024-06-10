<?php
include("../database/database.php");
session_start();

if(isset($_POST['change-password'])) {
  $token = $_POST['token'];
  $hash_token = hash("sha256", $token);
  $new_pass = $_POST['new_password'];
  $confirm_pass = $_POST['confirm_password'];

  if($new_pass == $confirm_pass) {
    $stmtCheck = $conn->prepare("SELECT * FROM users u WHERE u.token = ?");
    $stmtCheck->bind_param("s", $hash_token);
    $stmtCheck->execute();
    $checkResult = $stmtCheck->get_result();
    if(mysqli_num_rows($checkResult) > 0) {
      $fetchResult = $checkResult->fetch_assoc();
      $userId = $fetchResult['id'];
      $newPass = $conn->prepare("UPDATE users u SET u.password = ?, u.token = NULL, u.token_expiration = NULL WHERE u.id = ?");
      $newPass->bind_param("si", $new_pass, $userId);
      $newPass->execute();

      $_SESSION['success-recover'] = "Successfully Changed Password";
      header("Location: ../login.php");
      exit();

    }
    else {
      header("Location: forgot_password.php");
      exit();
    }
  }
  else {
    $_SESSION['pass-not-match'] = "Passwords Does Not Match";
    header("Location: ../password_reset.php?token=$token");
    exit();
  }
}
?>