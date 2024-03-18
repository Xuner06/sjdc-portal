<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-teacher'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $birthday = $_POST['birthday'];
  $age = $_POST['age'];
  $address = $_POST['address'];
  $password = $fname . $lname;
  $status = 0;

  $stmtCheckEmail = $conn->prepare("SELECT * FROM teacher WHERE email = ?");
  $stmtCheckEmail->bind_param("s", $email);
  $stmtCheckEmail->execute();
  $stmtResult = $stmtCheckEmail->get_result();

  if(mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-email'] = "This Email Is Already Registered";
    header("Location: ../admin/admin_teacher.php");
    exit();
  }
  else {
    $stmtInsertTeacher = $conn->prepare("INSERT INTO teacher (fname, lname, gender, birthday, age, contact, email, address, password, status, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmtInsertTeacher->bind_param("ssssissssi", $fname, $lname, $gender, $birthday, $age, $contact, $email, $address, $password, $status);
  
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