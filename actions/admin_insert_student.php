<?php
include("../database/database.php");
session_start();

if (isset($_POST['add-student'])) {
  $lrn_number = $_POST['lrn-number'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $birthday = $_POST['birthday'];
  $address = $_POST['address'];
  $password = $fname . $lname;
  $status = 0;

  $stmtCheckLrn = $conn->prepare("SELECT * FROM student WHERE lrn_number = ?");
  $stmtCheckLrn->bind_param("s", $lrn_number);
  $stmtCheckLrn->execute();
  $stmtResult = $stmtCheckLrn->get_result();

  if (mysqli_num_rows($stmtResult) > 0) {
    $_SESSION['duplicate-lrn'] = "This LRN Number Is Already Registered";
    header("Location: ../admin/admin_student.php");
    exit();
  }
  else {
    $stmtInsertStudent = $conn->prepare("INSERT INTO student (lrn_number, fname, lname, gender, birthday, age, contact, email, address, password, status, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmtInsertStudent->bind_param("sssssissssi", $lrn_number, $fname, $lname, $gender, $birthday, $age, $contact, $email, $address, $password, $status);

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
