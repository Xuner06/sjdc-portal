<?php
include("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $subject = $_POST['subject'];
  $class = $_POST['class'];
  $sy = $_POST['sy'];

  foreach ($_POST['grade'] as $studentId => $grade) {
    //Check if the grade is not "N/A"
    if ($grade != "N/A") {
      // Check if a record already exists for the student and subject combination
      $stmtCheckRecord = $conn->prepare("SELECT * FROM grade WHERE student = ? AND subject = ?");
      $stmtCheckRecord->bind_param("ii", $studentId, $subject);
      $stmtCheckRecord->execute();
      $stmtResult = $stmtCheckRecord->get_result();

      if(mysqli_num_rows($stmtResult) > 0) {
        // If a record exists, update the grade
        $stmtUpdateGrade = $conn->prepare("UPDATE grade SET grade = ? WHERE student = ? AND subject = ?");
        $stmtUpdateGrade->bind_param("iii", $grade, $studentId, $subject);
        $stmtUpdateGrade->execute();
      }
      else {
        // If no record exists, insert a new grade
        $stmtInsertGrade = $conn->prepare("INSERT INTO grade (student, subject, grade, sy, class) VALUES (?, ?, ?, ?, ?)");
        $stmtInsertGrade->bind_param("iiiii", $studentId, $subject, $grade, $sy, $class);
        $stmtInsertGrade->execute();
      }
    }
  }
  $_SESSION['success-upload'] = "Successfully Uploaded Grade";
  header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
  exit();
}
else {
  header("Location: ../teacher/teacher_grade.php");
  exit();
}
