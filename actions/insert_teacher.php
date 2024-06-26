<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-teacher'])) {
  $lrn_number = "N/A";
  $fname = ucfirst($_POST['fname']);
  $mname = ucfirst($_POST['mname']);
  $lname = ucfirst($_POST['lname']);
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $birthday = $_POST['birthday'];
  $address = $_POST['address'];
  $password = $fname . $lname;
  $status = 0;
  $role = "teacher";

  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  $stmtCheckEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmtCheckEmail->bind_param("s", $email);
  $stmtCheckEmail->execute();
  $stmtResult = $stmtCheckEmail->get_result();

  if(mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-email'] = "This Email Is Already Registered";
    header("Location: ../admin/admin_teacher.php");
    exit();
  }
  else {
    $stmtInsertTeacher = $conn->prepare("INSERT INTO users (lrn_number, role, fname, lname, mname, gender, birthday, contact, email, address, password, status, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmtInsertTeacher->bind_param("sssssssssssi", $lrn_number, $role, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $password_hashed, $status);
  
    if(mysqli_stmt_execute($stmtInsertTeacher)) {
      $_SESSION['add-teacher'] = "Successfully Added Teacher";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
    else {
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
  }
}
?>