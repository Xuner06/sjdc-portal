<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-teacher'])) {
  $id = $_POST['edit-id'];
  $fname = ucfirst($_POST['edit-fname']);
  $mname = ucfirst($_POST['edit-mname']);
  $lname = ucfirst($_POST['edit-lname']);
  $gender = $_POST['edit-gender'];
  $contact = $_POST['edit_contact'];
  $email = $_POST['edit_email'];
  $birthday = $_POST['edit_birthday'];
  $address = $_POST['edit-address'];

  $stmtOriginalEmail = $conn->prepare("SELECT email FROM users WHERE id = ?");
  $stmtOriginalEmail->bind_param("i", $id);
  $stmtOriginalEmail->execute();
  $stmtResult = $stmtOriginalEmail->get_result();
  $result = $stmtResult->fetch_assoc();
  $originalEmail = $result['email'];

  if($email != $originalEmail) {
    $stmtDuplicateEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmtDuplicateEmail->bind_param("s", $email);
    $stmtDuplicateEmail->execute();
    $stmtResultDuplicateEmail = $stmtDuplicateEmail->get_result();

    if(mysqli_num_rows($stmtResultDuplicateEmail) > 0) {
      $_SESSION['duplicate-email'] = "This Email Is Already Registered";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
    else{
      $stmtUpdateTeacher = $conn->prepare("UPDATE users SET fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?,  address = ? WHERE id = ?");
      $stmtUpdateTeacher->bind_param("ssssssssi", $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

      if(mysqli_stmt_execute($stmtUpdateTeacher)) {
        $_SESSION['update-teacher'] = "Successfully Updated Teacher";
        header("Location: ../admin/admin_teacher.php");
        exit();
      }
    }
  }
  else {
    $stmtUpdateTeacher = $conn->prepare("UPDATE users SET fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?,  address = ? WHERE id = ?");
    $stmtUpdateTeacher->bind_param("ssssssssi", $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

    if(mysqli_stmt_execute($stmtUpdateTeacher)) {
      $_SESSION['update-teacher'] = "Successfully Updated Teacher";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
  }
}
