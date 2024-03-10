<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-student'])) {
  $id = $_POST['edit-id'];
  $lrn = $_POST['edit-lrn'];
  $fname = $_POST['edit-fname'];
  $lname = $_POST['edit-lname'];
  $gender = $_POST['edit-gender'];
  $contact = $_POST['edit-contact'];
  $email = $_POST['edit-email'];
  $age = $_POST['edit-age'];
  $birthday = $_POST['edit-birthday'];
  $address = $_POST['edit-address'];

  $stmtUpdateStudent = $conn->prepare("UPDATE student SET lrn_number = ?, fname = ?, lname = ?, gender = ?, age = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE student_id = ?");
  $stmtUpdateStudent->bind_param("ssssissssi", $lrn, $fname, $lname, $gender, $age, $birthday, $contact, $email, $address, $id);

  if(mysqli_stmt_execute($stmtUpdateStudent)) {
    $_SESSION['update-student'] = "Successfully Updated Student";
    header("Location: ../admin/admin_student.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_student.php");
    exit();
  }
}  
?>