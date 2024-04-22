<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-class'])) {
  $id = $_POST['edit-id'];
  $level = $_POST['edit-level'];
  $strand = $_POST['edit-strand'];
  $section = $_POST['edit-section'];
  $adviser = $_POST['edit-adviser'];

  $statusSy = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $statusSy);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $result = $stmtResultSy->fetch_assoc();
  $sy = $result['sy_id'];

  $stmtGetClass = $conn->prepare("SELECT * FROM class WHERE class_id = ?");
  $stmtGetClass->bind_param("i", $id);
  $stmtGetClass->execute();
  $resultGetClass = $stmtGetClass->get_result();
  $class = $resultGetClass->fetch_assoc();
  
  $originalLevel = $class['level'];
  $originalStrand = $class['strand'];
  $originalSection = $class['section'];

  if($originalLevel != $level || $originalStrand != $strand || $originalSection != $section) {
    $stmtCheckDuplicate = $conn->prepare("SELECT * FROM class WHERE level = ? AND strand = ? AND section = ? AND sy = ?");
    $stmtCheckDuplicate->bind_param("ssss", $level, $strand, $section, $sy);
    $stmtCheckDuplicate->execute();
    $stmtResult = $stmtCheckDuplicate->get_result();

    if(mysqli_num_rows($stmtResult) > 0 ) {
      $_SESSION['duplicate-class'] = "Class Already Exists";
      header("Location: ../admin/admin_class.php");
      exit();
    }
    else {
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
  }
  else {
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
}

?>
