<?php
include("../database/database.php");
session_start();

if(isset($_POST['restore-student'])) {
  $id = $_POST['restore-id'];
  $status = 0;

  $stmtRestoreStudent = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
  $stmtRestoreStudent->bind_param("ii", $status, $id);

  if(mysqli_stmt_execute($stmtRestoreStudent)) {
    $_SESSION['restore-student'] = "Successfully Restored Student";
    header("Location: ../admin/admin_archive_student.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_archive_student.php");
    exit();
  }
}
?>