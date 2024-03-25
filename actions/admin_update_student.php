<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-student'])) {
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

    if (mysqli_num_rows($stmtResultDuplicateEmail) > 0) {
      $_SESSION['duplicate-email'] = "This Email Is Already Registered";
      header("Location: ../admin/admin_student.php");
      exit();
    } 
    else {
      $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, gender = ?, age = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
      $stmtUpdateStudent->bind_param("ssssissssi", $lrn, $fname, $lname, $gender, $age, $birthday, $contact, $email, $address, $id);

      if (mysqli_stmt_execute($stmtUpdateStudent)) {
        $_SESSION['update-student'] = "Successfully Updated Student";
        header("Location: ../admin/admin_student.php");
        exit();
      }
    }
  } 
  else {
    $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, gender = ?, age = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
    $stmtUpdateStudent->bind_param("ssssissssi", $lrn, $fname, $lname, $gender, $age, $birthday, $contact, $email, $address, $id);

    if (mysqli_stmt_execute($stmtUpdateStudent)) {
      $_SESSION['update-student'] = "Successfully Updated Student";
      header("Location: ../admin/admin_student.php");
      exit();
    }
  }
}
?>
