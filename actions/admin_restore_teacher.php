<?php
include("../database/database.php");
session_start();

if(isset($_POST['restore-teacher'])) {
  $id = $_POST['restore-id'];
  $status = 0;

  $stmtRestoreTeacher = $conn->prepare("UPDATE teacher set status = ? WHERE teacher_id = ?");
  $stmtRestoreTeacher->bind_param("ii", $status, $id);

  if(mysqli_stmt_execute($stmtRestoreTeacher)) {
    $_SESSION['restore-teacher'] = "Successfully Restored Teacher";
    header("Location: ../admin/admin_archive_teacher.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_archive_teacher.php");
    exit();
  }
}
?>