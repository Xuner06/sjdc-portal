<?php
include("../database/database.php");
session_start();

if(isset($_POST['upload-grade'])) {
  $student = mysqli_escape_string($conn,$_POST['student-id']);
  $sy = mysqli_escape_string($conn, $_POST['sy']);
  foreach ($_POST['grade'] as $subjectId => $grade) {
    // Check if a record already exists for the student and subject combination
    $check_query = "SELECT * FROM grade WHERE student = '$student' AND subject = '$subjectId'";
    $result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($result) > 0) {
      // If a record exists, update the grade
      $update_query = "UPDATE grade SET grade = '$grade' WHERE student = '$student' AND subject = '$subjectId'";
      mysqli_query($conn, $update_query);
      $_SESSION['success-upload'] = "Successfully Uploaded Grade";
      echo '<script>window.location.href="http://localhost/sjdc-portal/teacher/teacher_grade.php"</script>';
    } else {
      // If no record exists, insert a new grade
      $insert_query = "INSERT INTO grade (student, subject, grade, sy) VALUES ('$student', '$subjectId', '$grade', '$sy')";
      mysqli_query($conn, $insert_query);
      $_SESSION['success-upload'] = "Successfully Uploaded Grade";
      echo '<script>window.location.href="http://localhost/sjdc-portal/teacher/teacher_grade.php"</script>';
    }
  }  
}
?>