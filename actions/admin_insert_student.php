<?php
include("../database/database.php");
session_start();

if (isset($_POST['add-student'])) {
  $lrn_number = $_POST['lrnNumber'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $birthday = $_POST['birthday'];
  $address = $_POST['address'];
  $password = $fname . $lname;
  $status = 0;
  $role = "student";

  $stmtCheckEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmtCheckEmail->bind_param("s", $email);
  $stmtCheckEmail->execute();
  $stmtResult = $stmtCheckEmail->get_result();

  $stmtCheckLrn = $conn->prepare("SELECT * FROM users WHERE lrn_number = ?");
  $stmtCheckLrn->bind_param("s", $lrn_number);
  $stmtCheckLrn->execute();
  $stmtResultLrn = $stmtCheckLrn->get_result();

  if (mysqli_num_rows($stmtResultLrn) > 0) {
    $_SESSION['duplicate-lrn'] = "This LRN Number Is Already Registered";
    header("Location: ../admin/admin_student.php");
    exit();
  } 
  elseif (mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-email'] = "This Email Is Already Registered";
    header("Location: ../admin/admin_student.php");
    exit();
  } 
  else {
    $stmtInsertStudent = $conn->prepare("INSERT INTO users (role, lrn_number, fname, lname, gender, birthday, contact, email, address, password, status, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmtInsertStudent->bind_param("ssssssssssi", $role, $lrn_number, $fname, $lname, $gender, $birthday, $contact, $email, $address, $password, $status);

    if (mysqli_stmt_execute($stmtInsertStudent)) {
      $_SESSION['add-student'] = "Successfully Added Student";
      header("Location: ../admin/admin_student.php");
      exit();
    } 
    else {
      header("Location: ../admin/admin_student.php");
      exit();
    }
  }
}
?>
