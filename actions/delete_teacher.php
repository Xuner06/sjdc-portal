<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id'])) {
  $id = $_POST['delete-id'];
  $status = 1;

  $stmtDeleteTeacher = $conn->prepare("UPDATE users set status = ? WHERE id = ?");
  $stmtDeleteTeacher->bind_param("ii", $status, $id);
  
  if(mysqli_stmt_execute($stmtDeleteTeacher)) {
    $_SESSION['delete-teacher'] = "Successfully Deleted Teacher";
    header("Location: ../admin/admin_teacher.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_teacher.php");
    exit();
  }
}
?>