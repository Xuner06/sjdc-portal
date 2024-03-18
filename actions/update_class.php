<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-class'])) {
  $id = $_POST['edit-id'];
  $level = $_POST['edit-level'];
  $strand = $_POST['edit-strand'];
  $section = $_POST['edit-section'];
  $adviser = $_POST['edit-adviser'];
  $sy = $_POST['edit-sy'];

  $stmtUpdateClass = $conn->prepare("UPDATE class SET level = ?, strand = ?, section = ?, adviser = ?, sy = ? WHERE class_id = ?");
  $stmtUpdateClass->bind_param("sisiii", $level, $strand, $section, $adviser, $sy, $id);
  $stmtUpdateClass->execute();

  if (mysqli_stmt_execute($stmtUpdateClass)) {
    $_SESSION['update-class'] = "Successfully Updated Class";
    header("Location: ../admin/admin_class.php");
    exit();
  } 
  else {
    header("Location: ../admin/admin_class.php");
    exit();
  }
}

?>
