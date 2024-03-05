<?php
include("../database/database.php");
session_start();

if(isset($_POST['upload-grade'])) {
  $student = mysqli_escape_string($conn,$_POST['student-id']);
  $enroll = mysqli_escape_string($conn,$_POST['enroll-id']);
  $sy = mysqli_escape_string($conn, $_POST['sy']);
  foreach ($_POST['grade'] as $subjectId => $grade) {
     // Check if the grade is not "N/A"
     if ($grade != "N/A") {
      // Check if a record already exists for the student and subject combination
      $check_query = "SELECT * FROM grade WHERE student = '$student' AND subject = '$subjectId'";
      $result = mysqli_query($conn, $check_query);
      if(mysqli_num_rows($result) > 0) {
        // If a record exists, update the grade
        $update_query = "UPDATE grade SET grade = '$grade' WHERE student = '$student' AND subject = '$subjectId'";
        mysqli_query($conn, $update_query);
      } else {
        // If no record exists, insert a new grade
        $insert_query = "INSERT INTO grade (student, subject, grade, sy) VALUES ('$student', '$subjectId', '$grade', '$sy')";
        mysqli_query($conn, $insert_query);
      }
    }
  }  
  $_SESSION['success-upload'] = "Successfully Uploaded Grade";
  header("Location: ../teacher/teacher_encode_grade.php?grade=$enroll");
  exit();
}
