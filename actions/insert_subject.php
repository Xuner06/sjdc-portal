<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-subject'])) {
  $name = $_POST['name'];
  $level = $_POST['level'];
  $strand = $_POST['strand'];
  $semester = $_POST['semester'];

  $stmtInsertSubject = $conn->prepare("INSERT INTO subject (name, level, strand, semester) VALUES (?, ?, ?, ?)");
  $stmtInsertSubject->bind_param("ssss", $name, $level, $strand, $semester);

  if(mysqli_stmt_execute($stmtInsertSubject)) {
    $_SESSION['add-subject'] = "Successfully Added Subject";
    header("Location: ../admin/admin_subject.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_subject.php");
    exit();
  }
}
?>
