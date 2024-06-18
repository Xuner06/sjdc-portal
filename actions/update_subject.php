<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-subject'])) {
  $id = $_POST['edit-id'];
  $name = $_POST['edit-name'];
  $level = $_POST['edit-level'];
  $strand = implode(',', $_POST['edit-strand']);
  $semester = $_POST['edit-semester'];

  $stmtUpdateSubject = $conn->prepare("UPDATE subject SET name = ?, level = ?, strand = ?, semester = ? WHERE subject_id = ?");
  $stmtUpdateSubject->bind_param("ssssi", $name, $level, $strand, $semester, $id);

  if(mysqli_stmt_execute($stmtUpdateSubject)) {
    $_SESSION['update-subject'] = "Successfully Updated Subject";
    header("Location: ../admin/admin_subject.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_subject.php");
    exit();
  }
}  
?>