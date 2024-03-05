<?php
include("../database/database.php");
session_start();

if (isset($_POST['enroll-student'])) {
  $enroll_id = mysqli_escape_string($conn, $_POST['enroll-id']);
  $class = mysqli_escape_string($conn, $_POST['class']);
  $schoolyear = mysqli_escape_string($conn, $_POST['schoolyear']);

  $check_sql = "SELECT * FROM enroll_student WHERE student_id = '$enroll_id' AND sy = '$schoolyear'";
  $check_query = mysqli_query($conn, $check_sql);

  if (mysqli_num_rows($check_query) > 0) {
    $_SESSION['error-enroll'] = "Student Already Enrolled In This School Year";
    header("Location: ../admin/admin_student_enroll.php?id=$enroll_id");
    exit();
  } 
  else {
    $sql = "INSERT INTO enroll_student VALUES('', '$enroll_id', '$class', '$schoolyear', now())";
    $query = mysqli_query($conn, $sql);

    if ($query) {
      $_SESSION['success-enroll'] = "Successfully Enroll Student";
      header("Location: ../admin/admin_student_enroll.php?id=$enroll_id");
      exit();
    } 
    else {
      header("Location: ../admin/admin_student_enroll.php?id=$enroll_id");
      exit();
    }
  }
}
