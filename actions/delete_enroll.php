<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id']) && isset($_POST['student-id'])) {
  $studentId = $_POST['student-id'];
  $enrollId = $_POST['delete-id'];

  $stmtSelectEnroll = $conn->prepare("SELECT * FROM enroll_student WHERE enroll_id = ?");
  $stmtSelectEnroll->bind_param("i", $enrollId);
  $stmtSelectEnroll->execute();
  $stmtResultSelectEnroll = $stmtSelectEnroll->get_result();
  $resultSelectEnroll = $stmtResultSelectEnroll->fetch_assoc();

  $id = $resultSelectEnroll['student_id'];
  $sy = $resultSelectEnroll['sy'];
  
  $stmtDeleteEnroll = $conn->prepare("DELETE FROM enroll_student WHERE enroll_id = ?");
  $stmtDeleteEnroll->bind_param("i", $enrollId);

  if(mysqli_stmt_execute($stmtDeleteEnroll)) {
    $stmtDeleteGrade = $conn->prepare("DELETE FROM grade WHERE student = ? AND sy = ?");
    $stmtDeleteGrade->bind_param("ii", $id, $sy);
    $stmtDeleteGrade->execute();

    $_SESSION['delete-enroll'] = "Successfully Deleted";
    header("Location: ../admin/admin_student_enroll.php?id=$studentId");
    exit();
  }
  else {
    header("Location: ../admin/admin_student_enroll.php?id=$studentId");
    exit();
  }
}

?>