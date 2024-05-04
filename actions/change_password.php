<?php
include("../database/database.php");
session_start();

if (isset($_POST['student-change-password'])) {
  $id = $_POST['id'];
  $current_password = $_POST['current-pass'];
  $new_password = $_POST['new-pass'];
  $confirm_password = $_POST['confirm_pass'];

  $stmtCheckPassword = $conn->prepare("SELECT password FROM users WHERE id = ?");
  $stmtCheckPassword->bind_param("i", $id);
  $stmtCheckPassword->execute();
  $stmtResultPassword = $stmtCheckPassword->get_result();
  $stmtResult = $stmtResultPassword->fetch_assoc();
  $originalPassword = $stmtResult['password'];

  if ($originalPassword != $current_password) {
    $_SESSION['wrong-pass'] = "Incorrect Password";
    header("Location: ../student/student_account.php");
    exit();
  } else {
    $stmtUpdatePassword = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmtUpdatePassword->bind_param("si", $new_password, $id);

    if (mysqli_stmt_execute($stmtUpdatePassword)) {
      $_SESSION['success-changePass'] = "Successfully Changed Password";
      header("Location: ../student/student_account.php");
      exit();
    }
  }
} 
elseif (isset($_POST['teacher-change-password'])) {
  $id = $_POST['id'];
  $current_password = $_POST['current-pass'];
  $new_password = $_POST['new-pass'];
  $confirm_password = $_POST['confirm_pass'];

  $stmtCheckPassword = $conn->prepare("SELECT password FROM users WHERE id = ?");
  $stmtCheckPassword->bind_param("i", $id);
  $stmtCheckPassword->execute();
  $stmtResultPassword = $stmtCheckPassword->get_result();
  $stmtResult = $stmtResultPassword->fetch_assoc();
  $originalPassword = $stmtResult['password'];

  if ($originalPassword != $current_password) {
    $_SESSION['wrong-pass'] = "Incorrect Password";
    header("Location: ../teacher/teacher_account.php");
    exit();
  } else {
    $stmtUpdatePassword = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmtUpdatePassword->bind_param("si", $new_password, $id);

    if (mysqli_stmt_execute($stmtUpdatePassword)) {
      $_SESSION['success-changePass'] = "Successfully Changed Password";
      header("Location: ../teacher/teacher_account.php");
      exit();
    }
  }
} 
elseif (isset($_POST['admin-change-password'])) {
  $id = $_POST['id'];
  $current_password = $_POST['current-pass'];
  $new_password = $_POST['new-pass'];
  $confirm_password = $_POST['confirm_pass'];

  $stmtCheckPassword = $conn->prepare("SELECT password FROM users WHERE id = ?");
  $stmtCheckPassword->bind_param("i", $id);
  $stmtCheckPassword->execute();
  $stmtResultPassword = $stmtCheckPassword->get_result();
  $stmtResult = $stmtResultPassword->fetch_assoc();
  $originalPassword = $stmtResult['password'];

  if ($originalPassword != $current_password) {
    $_SESSION['wrong-pass'] = "Incorrect Password";
    header("Location: ../admin/admin_account.php");
    exit();
  } else {
    $stmtUpdatePassword = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmtUpdatePassword->bind_param("si", $new_password, $id);

    if (mysqli_stmt_execute($stmtUpdatePassword)) {
      $_SESSION['success-changePass'] = "Successfully Changed Password";
      header("Location: ../admin/admin_account.php");
      exit();
    }
  }
}
?>
