<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-teacher'])) {
  $fname = mysqli_escape_string($conn, $_POST['fname']);
  $lname = mysqli_escape_string($conn, $_POST['lname']);
  $gender = mysqli_escape_string($conn, $_POST['gender']);
  $contact = mysqli_escape_string($conn, $_POST['contact']);
  $email = mysqli_escape_string($conn, $_POST['email']);
  $birthday = mysqli_escape_string($conn, $_POST['birthday']);
  $age = mysqli_escape_string($conn, $_POST['age']);
  $address = mysqli_escape_string($conn, $_POST['address']);
  $password = $fname . $lname;
  $status = 0;

  $sqlDuplicateEmail = "SELECT * FROM teacher WHERE email = '$email'";
  $queryDuplicateEmail = mysqli_query($conn, $sqlDuplicateEmail);

  if(mysqli_num_rows($queryDuplicateEmail) > 0) {
    $_SESSION['duplicate'] = "This email is already registered";
    echo '<script>window.location.href="http://localhost/sjdc/admin/admin_teacher.php"</script>';
  }
  else {
    $sql = "INSERT INTO teacher VALUES('', '$fname', '$lname', '$gender', '$birthday', '$age', '$contact', '$email', '$address', '$password', '$status', now())";
    $query = mysqli_query($conn, $sql);
  
    if($query) {
      $_SESSION['add-teacher'] = "Successfully Added Teacher";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_teacher.php"</script>';
    }

  }
}
?>