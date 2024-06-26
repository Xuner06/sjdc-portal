<?php
include("../database/database.php");
session_start();

if (isset($_POST['multiple-enroll-student'])) {
  $id = explode(', ', $_POST['id']);
  $class = $_POST['class'];

  $statusSy = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $statusSy);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $result = $stmtResultSy->fetch_assoc();
  $schoolyear = $result['sy_id'];

  foreach ($id as $studentId) {
    $stmtEnroll = $conn->prepare("SELECT * FROM enroll_student WHERE student_id = ? AND sy = ?");
    $stmtEnroll->bind_param("ii", $studentId, $schoolyear);
    $stmtEnroll->execute();
    $stmtResultEnroll = $stmtEnroll->get_result();

    if (mysqli_num_rows($stmtResultEnroll) == 0) {
      $stmtInsertEnroll = $conn->prepare("INSERT INTO enroll_student (student_id, class, sy, enroll_date) VALUES (?, ?, ?, now())");
      $stmtInsertEnroll->bind_param("iii", $studentId, $class, $schoolyear);
      $stmtInsertEnroll->execute();
    }
  }

  $_SESSION['multiple-enroll'] = "Successfully Enroll Students";
  header("Location: ../admin/admin_student_list.php");
  exit();
}
