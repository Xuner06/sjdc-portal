<?php
include("../database/database.php");
if(isset($_POST['upload-grade'])) {
  $student = $_POST['student-id'];
  foreach ($_POST['grade'] as $subjectId => $grade) {
    // Insert the grade into your database table (replace 'grades' with your actual table name)
    $query = "INSERT INTO grade (student, subject, grade) VALUES ('$student', '$subjectId', '$grade')";
    mysqli_query($conn, $query);
  }  
}
?>