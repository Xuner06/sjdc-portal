<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-teacher'])) {
  $id = $_POST['edit-id'];
  $fname = mysqli_escape_string($conn, $_POST['edit-fname']);
  $lname = mysqli_escape_string($conn, $_POST['edit-lname']);
  $gender = mysqli_escape_string($conn, $_POST['edit-gender']);
  $contact = mysqli_escape_string($conn, $_POST['edit-contact']);
  $email = mysqli_escape_string($conn, $_POST['edit-email']);
  $birthday = mysqli_escape_string($conn, $_POST['edit-birthday']);
  $age = mysqli_escape_string($conn, $_POST['edit-age']);
  $address = mysqli_escape_string($conn, $_POST['edit-address']);

  $sqlOriginalEmail = "SELECT email FROM teacher WHERE teacher_id = '$id'";
  $queryOriginalEmail = mysqli_query($conn, $sqlOriginalEmail);
  $row = mysqli_fetch_assoc($queryOriginalEmail);
  $originalEmail = $row['email'];

  if($email != $originalEmail) {
    $sqlDuplicateEmail = "SELECT * FROM teacher WHERE email = '$email'";
    $queryDuplicateEmail = mysqli_query($conn, $sqlDuplicateEmail);
    if(mysqli_num_rows($queryDuplicateEmail) > 0) {
      $_SESSION['duplicate'] = "This email is already registered";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_teacher.php"</script>';
    }
    else {
      $sql = "UPDATE teacher SET fname = '$fname', lname = '$lname', gender = '$gender', birthday = '$birthday', age = '$age', contact = '$contact', email = '$email',  address = '$address' WHERE teacher_id = '$id'";
      $query = mysqli_query($conn, $sql);
  
      if($query) {
        $_SESSION['update-teacher'] = "Successfully Updated Teacher";
        echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_teacher.php"</script>';
  
      }
    }
  }
  else {
    $sql = "UPDATE teacher SET fname = '$fname', lname = '$lname', gender = '$gender', birthday = '$birthday', age = '$age', contact = '$contact', email = '$email',  address = '$address' WHERE teacher_id = '$id'";
    $query = mysqli_query($conn, $sql);

    if($query) {
      $_SESSION['update-teacher'] = "Successfully Updated Teacher";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_teacher.php"</script>';

    }
  }
}
