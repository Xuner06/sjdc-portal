<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-grade'])) {
  $student = $_POST['student-id'];
  $enroll = $_POST['enroll-id'];
  $sy = $_POST['sy'];

  foreach ($_POST['grade'] as $subjectId => $grade) {

    $stmtUpdateGrade = $conn->prepare("UPDATE grade SET grade = ? WHERE student = ? AND subject = ?");
    $stmtUpdateGrade->bind_param("iii", $grade, $student, $subjectId);
    $stmtUpdateGrade->execute();
  }
  $_SESSION['success-update'] = "Successfully Updated Grade";
  header("Location: ../admin/admin_edit_grade.php?edit=$enroll");
  exit();
}
