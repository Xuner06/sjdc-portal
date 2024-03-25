<?php
include("../database/database.php");
session_start();

if (isset($_POST['upload-grade'])) {
  $student = $_POST['student-id'];
  $enroll = $_POST['enroll-id'];
  $class = $_POST['class'];
  $sy = $_POST['sy'];
  foreach ($_POST['grade'] as $subjectId => $grade) {
    // Check if the grade is not "N/A"
    if ($grade != "N/A") {
      // Check if a record already exists for the student and subject combination
      $stmtCheckRecord = $conn->prepare("SELECT * FROM grade WHERE student = ? AND subject = ?");
      $stmtCheckRecord->bind_param("ii", $student, $subjectId);
      $stmtCheckRecord->execute();
      $stmtResult = $stmtCheckRecord->get_result();

      if(mysqli_num_rows($stmtResult) > 0) {
        // If a record exists, update the grade
        $stmtUpdateGrade = $conn->prepare("UPDATE grade SET grade = ? WHERE student = ? AND subject = ?");
        $stmtUpdateGrade->bind_param("iii", $grade, $student, $subjectId);
        $stmtUpdateGrade->execute();
      }
      else {
        // If no record exists, insert a new grade
        $stmtInsertGrade = $conn->prepare("INSERT INTO grade (student, subject, grade, sy, class) VALUES (?, ?, ?, ?, ?)");
        $stmtInsertGrade->bind_param("iiiii", $student, $subjectId, $grade, $sy, $class);
        $stmtInsertGrade->execute();
      }
    }
  }
  $_SESSION['success-upload'] = "Successfully Uploaded Grade";
  header("Location: ../admin/admin_encode_grade.php?grade=$enroll");
  exit();
}
