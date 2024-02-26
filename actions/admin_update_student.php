<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-student'])) {
  $id = mysqli_escape_string($conn, $_POST['edit-id']);
  $lrn = mysqli_escape_string($conn, $_POST['edit-lrn']);
  $fname = mysqli_escape_string($conn, $_POST['edit-fname']);
  $lname = mysqli_escape_string($conn, $_POST['edit-lname']);
  $gender = mysqli_escape_string($conn, $_POST['edit-gender']);
  $contact = mysqli_escape_string($conn, $_POST['edit-contact']);
  $email = mysqli_escape_string($conn, $_POST['edit-email']);
  $age = mysqli_escape_string($conn, $_POST['edit-age']);
  $birthday = mysqli_escape_string($conn, $_POST['edit-birthday']);
  $address = mysqli_escape_string($conn, $_POST['edit-address']);

  $sql = "UPDATE student SET lrn_number = '$lrn', fname = '$fname', lname = '$lname', gender = '$gender', age = '$age', birthday = '$birthday', contact = '$contact', email = '$email', address = '$address' WHERE student_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
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