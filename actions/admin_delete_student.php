<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id'])) {
  $id = $_POST['delete-id'];
  $status = 1;

  $stmtDeleteStudent = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
  $stmtDeleteStudent->bind_param("ii", $status, $id);

  if(mysqli_stmt_execute($stmtDeleteStudent)) {
    $_SESSION['delete-student'] = "Successfully Deleted Student";
    header("Location: ../admin/admin_student.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_student.php");
    exit();
  }
}
?>