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

  // Retrieve the current school year data
  $stmtCurrentSy = $conn->prepare("SELECT * FROM school_year WHERE sy_id = ?");
  $stmtCurrentSy->bind_param("i", $id);
  $stmtCurrentSy->execute();
  $resultCurrentSy = $stmtCurrentSy->get_result();
  $row = $resultCurrentSy->fetch_assoc();

  // Check if there are changes in the school year data
  if ($startYear != $row['start_year'] || $endYear != $row['end_year'] || $semester != $row['semester']) {
    $stmtCheckDuplicate = $conn->prepare("SELECT * FROM school_year WHERE start_year = ? AND end_year = ? AND semester = ?");
    $stmtCheckDuplicate->bind_param("sss", $startYear, $endYear, $semester);
    $stmtCheckDuplicate->execute();
    $resultDuplicate = $stmtCheckDuplicate->get_result();

    if (mysqli_num_rows($resultDuplicate) > 0) {
      $_SESSION['duplicate-sy'] = "School Year Already Exists";
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    }
  }

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
?>
