<?php
include("../database/database.php");
session_start();

if (isset($_POST['student-change-password']) || isset($_POST['teacher-change-password']) || isset($_POST['admin-change-password'])) {
  $id = $_POST['id'];
  $current_password = $_POST['current-pass'];
  $new_password = $_POST['new-pass'];
  $confirm_password = $_POST['confirm_pass'];

  // Retrieve the original hashed password from the database
  $stmtCheckPassword = $conn->prepare("SELECT password FROM users WHERE id = ?");
  $stmtCheckPassword->bind_param("i", $id);
  $stmtCheckPassword->execute();
  $stmtResultPassword = $stmtCheckPassword->get_result();
  
  // Fetch the result
  if ($stmtResultPassword->num_rows === 1) {
    $stmtResult = $stmtResultPassword->fetch_assoc();
    $originalPassword = $stmtResult['password'];

    // Verify the current password
    if (!password_verify($current_password, $originalPassword)) {
      $_SESSION['wrong-pass'] = "Incorrect Password";
      // Redirect based on user role
      if (isset($_POST['student-change-password'])) {
        header("Location: ../student/student_account.php");
      } elseif (isset($_POST['teacher-change-password'])) {
        header("Location: ../teacher/teacher_account.php");
      } elseif (isset($_POST['admin-change-password'])) {
        header("Location: ../admin/admin_account.php");
      }
      exit();
    }

    // Check if new password matches the confirmation
    if ($new_password !== $confirm_password) {
      $_SESSION['wrong-pass'] = "Passwords do not match";
      // Redirect based on user role
      if (isset($_POST['student-change-password'])) {
        header("Location: ../student/student_account.php");
      } elseif (isset($_POST['teacher-change-password'])) {
        header("Location: ../teacher/teacher_account.php");
      } elseif (isset($_POST['admin-change-password'])) {
        header("Location: ../admin/admin_account.php");
      }
      exit();
    }

    // Update the password if everything is fine
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $stmtUpdatePassword = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmtUpdatePassword->bind_param("si", $new_password_hashed, $id);

    if (mysqli_stmt_execute($stmtUpdatePassword)) {
      $_SESSION['success-changePass'] = "Successfully Changed Password";
    } else {
      $_SESSION['wrong-pass'] = "Failed to update password";
    }
  } else {
    $_SESSION['wrong-pass'] = "User not found";
  }

  // Redirect based on user role
  if (isset($_POST['student-change-password'])) {
    header("Location: ../student/student_account.php");
  } elseif (isset($_POST['teacher-change-password'])) {
    header("Location: ../teacher/teacher_account.php");
  } elseif (isset($_POST['admin-change-password'])) {
    header("Location: ../admin/admin_account.php");
  }
  exit();
}
?>
