<?php
include("../database/database.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $subject = $_POST['subject'];

  foreach ($_POST['grade'] as $studentId => $grade) {
    $stmtUpdateGrade = $conn->prepare("UPDATE grade SET grade = ? WHERE student = ? AND subject = ?");
    $stmtUpdateGrade->bind_param("iii", $grade, $studentId, $subject);
    $stmtUpdateGrade->execute();
  }
  $_SESSION['success-update'] = "Successfully Updated Grade";
  header("Location: ../teacher/teacher_edit_grade.php?subject_edit=$subject");
  exit();
}
