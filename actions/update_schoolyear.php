<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-schoolyear'])) {
  $id = $_POST['edit-id'];
  $status = $_POST['edit-status'];
  $startYear = $_POST['edit-startYear'];
  $endYear = $_POST['edit-endYear'];
  $semester = $_POST['edit-semester'];
  $statusActive = "Active";

  if ($status == "Active") {
    $statusInactive = "Inactive";
    $stmtUpdateStatus = $conn->prepare("UPDATE school_year SET status = ? WHERE status = ?");
    $stmtUpdateStatus->bind_param("ss", $statusInactive, $statusActive);
    $stmtUpdateStatus->execute();

    $stmtUpdateSy = $conn->prepare("UPDATE school_year SET status = ?, start_year = ?, end_year = ?, semester = ? WHERE sy_id = ?");
    $stmtUpdateSy->bind_param("ssssi", $status, $startYear, $endYear, $semester, $id);

    if (mysqli_stmt_execute($stmtUpdateSy)) {
      $_SESSION['update-schoolyear'] = "Successfully Updated School Year";
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    } else {
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    }
  } else {
    $stmtUpdateSy = $conn->prepare("UPDATE school_year SET status = ?, start_year = ?, end_year = ?, semester = ? WHERE sy_id = ?");
    $stmtUpdateSy->bind_param("ssssi", $status, $startYear, $endYear, $semester, $id);

    if (mysqli_stmt_execute($stmtUpdateSy)) {
      $_SESSION['update-schoolyear'] = "Successfully Updated School Year";
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    } else {
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    }
  }
}
