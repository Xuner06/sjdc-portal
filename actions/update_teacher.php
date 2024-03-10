<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-teacher'])) {
  $id = $_POST['edit-id'];
  $fname = $_POST['edit-fname'];
  $lname = $_POST['edit-lname'];
  $gender = $_POST['edit-gender'];
  $contact = $_POST['edit-contact'];
  $email = $_POST['edit-email'];
  $birthday = $_POST['edit-birthday'];
  $age = $_POST['edit-age'];
  $address = $_POST['edit-address'];

  $stmtOriginalEmail = $conn->prepare("SELECT email FROM teacher WHERE teacher_id = ?");
  $stmtOriginalEmail->bind_param("i", $id);
  $stmtOriginalEmail->execute();
  $stmtResult = $stmtOriginalEmail->get_result();
  $result = $stmtResult->fetch_assoc();
  $originalEmail = $result['email'];

  if($email != $originalEmail) {
    $stmtDuplicateEmail = $conn->prepare("SELECT * FROM teacher WHERE email = ?");
    $stmtDuplicateEmail->bind_param("s", $email);

    if(mysqli_stmt_execute($stmtDuplicateEmail) > 0) {
      $_SESSION['duplicate'] = "This email is already registered";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
    else{
      $stmtUpdateTeacher = $conn->prepare("UPDATE teacher SET fname = ?, lname = ?, gender = ?, birthday = ?, age = ?, contact = ?, email = ?,  address = ? WHERE teacher_id = ?");
      $stmtUpdateTeacher->bind_param("ssssisssi", $fname, $lname, $gender, $birthday, $age, $contact, $email, $address, $id);

      if(mysqli_stmt_execute($stmtUpdateTeacher)) {
        $_SESSION['update-teacher'] = "Successfully Updated Teacher";
        header("Location: ../admin/admin_teacher.php");
        exit();
      }
    }
  }
  else {
    $stmtUpdateTeacher = $conn->prepare("UPDATE teacher SET fname = ?, lname = ?, gender = ?, birthday = ?, age = ?, contact = ?, email = ?,  address = ? WHERE teacher_id = ?");
    $stmtUpdateTeacher->bind_param("ssssisssi", $fname, $lname, $gender, $birthday, $age, $contact, $email, $address, $id);

    if(mysqli_stmt_execute($stmtUpdateTeacher)) {
      $_SESSION['update-teacher'] = "Successfully Updated Teacher";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
  }
}
