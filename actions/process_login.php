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
      header("Location: ../student/student_account.php");
      exit();
    }
    else {
      $_SESSION['login-failed'] = "Incorrect Email or Password";
      header("Location: ../login.php");
      exit();
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
      header("Location: ../login.php");
      exit();
    }
  }
  else if($user=="admin") {
    echo "Admin";
  }
}
