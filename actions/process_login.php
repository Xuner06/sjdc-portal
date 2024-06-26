<?php
include("../database/database.php");
session_start();

if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $status = 0;

  $stmtUser = $conn->prepare("SELECT * FROM users WHERE email = ? AND status = ?");
  $stmtUser->bind_param("si", $email, $status);
  $stmtUser->execute();
  $stmtResultUser = $stmtUser->get_result();

  if (mysqli_num_rows($stmtResultUser) == 1) {
    $user = $stmtResultUser->fetch_assoc();
     // Verify the password using password_verify
     if (password_verify($password, $user['password'])) {
      // Check user role and redirect accordingly
      if ($user['role'] == "admin") {
        $_SESSION['admin'] = $user['id'];
        $_SESSION['login-admin'] = "Signed in successfully";
        header("Location: ../admin/admin_dashboard.php");
        exit();
      } elseif ($user['role'] == "teacher") {
        $_SESSION['teacher'] = $user['id'];
        $_SESSION['login-teacher'] = "Signed in successfully";
        header("Location: ../teacher/teacher_dashboard.php");
        exit();
      } elseif ($user['role'] == "student") {
        $_SESSION['student'] = $user['id'];
        $_SESSION['login-student'] = "Signed in successfully";
        header("Location: ../student/student_home.php");
        exit();
      }
    } else {
      $_SESSION['login-failed'] = "Incorrect Email or Password";
      header("Location: ../login.php");
      exit();
    }
  } else {
    $_SESSION['login-failed'] = "Incorrect Email or Password";
    header("Location: ../login.php");
    exit();
  }
}
?>
