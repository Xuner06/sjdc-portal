<?php
include("../database/database.php");
session_start();

if(isset($_POST['login'])) {
  $user = mysqli_escape_string($conn, $_POST['user']);
  $email = mysqli_escape_string($conn, $_POST['email']);
  $password = mysqli_escape_string($conn, $_POST['password']);

  if($user=="student") {
    $sql = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
  
    if(mysqli_num_rows($query) == 1) {
      $_SESSION['student'] = $row['student_id'];
      $_SESSION['login-student'] = "Signed in successfully";
      echo '<script>window.location.href="http://localhost/sjdc-portal/student/student_account.php"</script>';
    }
    else {
      $_SESSION['login-failed'] = "Incorrect Email or Password";
      echo '<script>window.location.href="http://localhost/sjdc-portal/login.php"</script>';
    }

  }
  else if($user=="teacher") {
    $sql = "SELECT * FROM teacher WHERE email = '$email' AND password = '$password' AND status = 0";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
  
    if(mysqli_num_rows($query) == 1) {
      $_SESSION['teacher'] = $row['teacher_id'];
      $_SESSION['login-teacher'] = "Signed in successfully";
      header("Location: ../teacher/teacher_dashboard.php");
      exit();
    }
    else {
      $_SESSION['login-failed'] = "Incorrect Email or Password";
      echo '<script>window.location.href="http://localhost/sjdc-portal/login.php"</script>';
    }
  }
  else if($user=="admin") {
    echo "Admin";
  }

  // $sql = "SELECT * FROM teacher WHERE email = '$email' AND password = '$password'";
  // $query = mysqli_query($conn, $sql);
  // $row = mysqli_fetch_assoc($query);

  // if(mysqli_num_rows($query) == 1) {
  //   $_SESSION['status'] = "Valid";
  //   $_SESSION['id'] = $row['teacher_id'];
  //   // echo '<script>window.location.href="http://localhost/thesis/teacher_dashboard.php"</script>';
  //   echo '<script>window.location.href="http://localhost/thesis/login.php"</script>';
  // }
  // else {
  //   $_SESSION['status'] = "Invalid";
  //   echo '<script>window.location.href="http://localhost/thesis/login.php"</script>';
  // }
}
