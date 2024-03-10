<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-schoolyear'])) {
  $start_year = $_POST['start_year'];
  $end_year = $_POST['end_year'];
  $semester = $_POST['semester'];
  $date_created = date("Y-m-d");
  $statusActive = "Active";

  $stmtCheckActive = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtCheckActive->bind_param("s", $statusActive);
  $stmtCheckActive->execute();
  $stmtResult = $stmtCheckActive->get_result();

  if(mysqli_num_rows($stmtResult) >= 0) {
    $statusInactive = "Inactive";
    $stmtUpdateActive = $conn->prepare( "UPDATE school_year SET status = ?");
    $stmtUpdateActive->bind_param("s", $statusInactive);
    $stmtUpdateActive->execute();

    $stmtInsertSy = $conn->prepare("INSERT INTO school_year (start_year, end_year, semester, created_at) VALUES (?, ?, ?, ?)");
    $stmtInsertSy->bind_param("ssss", $start_year, $end_year, $semester, $date_created);

    if(mysqli_stmt_execute($stmtInsertSy)) {
      $_SESSION['add-schoolyear'] = "Successfully Added School Year";
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    }
    else {
      header("Location: ../admin/admin_schoolyear.php");
      exit();
    }
  }
}
?>
