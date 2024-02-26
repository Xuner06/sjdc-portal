<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-student'])) {
  $sqlCheckActiveSy = "SELECT sy_id FROM school_year WHERE status = 'Active'";
  $queryCheckActiveSy = mysqli_query($conn, $sqlCheckActiveSy);

  $lrn_number = mysqli_escape_string($conn, $_POST['lrn-number']);
  $fname = mysqli_escape_string($conn, $_POST['fname']);
  $lname = mysqli_escape_string($conn, $_POST['lname']);
  $gender = mysqli_escape_string($conn, $_POST['gender']);
  $contact = mysqli_escape_string($conn, $_POST['contact']);
  $email = mysqli_escape_string($conn, $_POST['email']);
  $age = mysqli_escape_string($conn, $_POST['age']);
  $birthday = mysqli_escape_string($conn, $_POST['birthday']);
  $address = mysqli_escape_string($conn, $_POST['address']);
  $password = $fname . $lname;
  $status = 0;


  $sql = "INSERT INTO student VALUES('', '$lrn_number', '$fname', '$lname', '$gender', '$birthday', '$age', '$contact', '$email', '$address', '$password', '$status', now())";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['add-student'] = "Successfully Added Student";
    header("Location: ../admin/admin_student.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_student.php");
    exit();
  }
}
