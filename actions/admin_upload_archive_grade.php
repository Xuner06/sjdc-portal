<?php
include("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $student = $_POST['student-id'];
  $enroll = $_POST['enroll-id'];
  $class = $_POST['class'];
  $sy = $_POST['sy'];
  foreach ($_POST['grade'] as $subjectId => $grade) {
    // Check if the grade is not "N/A"
    if ($grade != "N/A") {
      $stmtInsertGrade = $conn->prepare("INSERT INTO grade (student, subject, grade, sy, class) VALUES (?, ?, ?, ?, ?)");
      $stmtInsertGrade->bind_param("iiiii", $student, $subjectId, $grade, $sy, $class);
      $stmtInsertGrade->execute();
    }
  }
  $_SESSION['success-upload'] = "Successfully Uploaded Grade";
  header("Location: ../admin/admin_archive_upload_grade.php?grade=$enroll");
  exit();
}
?>
