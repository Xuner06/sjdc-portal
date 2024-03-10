<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id'])) {
  $id = mysqli_escape_string($conn, $_POST['delete-id']);
  $status = 1;

  $stmtDeleteTeacher = $conn->prepare("UPDATE teacher set status = ? WHERE teacher_id = ?");
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