<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-class'])) {
  $level = $_POST['level'];
  $strand = $_POST['strand'];
  $section = $_POST['section'];
  $sy = $_POST['sy'];
  $adviser = $_POST['adviser'];

  $stmtInsertClass = $conn->prepare("INSERT INTO class (level, strand, section, sy, adviser, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
  $stmtInsertClass->bind_param("sssss", $level, $strand, $section, $sy, $adviser);

  if(mysqli_stmt_execute($stmtInsertClass)) {
    $_SESSION['add-class'] = "Successfully Added Class";
    header("Location: ../admin/admin_class.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_class.php");
    exit();
  }
}
?>