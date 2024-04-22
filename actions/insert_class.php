<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-class'])) {
  $level = $_POST['level'];
  $strand = $_POST['strand'];
  $section = $_POST['section'];
  $sy = $_POST['sy'];
  $adviser = $_POST['adviser'];

  $statusSy = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $statusSy);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $result = $stmtResultSy->fetch_assoc();
  $sy = $result['sy_id'];

  $stmtCheckDuplicate = $conn->prepare("SELECT * FROM class WHERE level = ? AND strand = ? AND section = ? AND sy = ?");
  $stmtCheckDuplicate->bind_param("ssss", $level, $strand, $section, $sy);
  $stmtCheckDuplicate->execute();
  $stmtResult = $stmtCheckDuplicate->get_result();

  if(mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-class'] = "Class Already Exists";
    header("Location: ../admin/admin_class.php");
    exit();
  }
  else {
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
}
?>