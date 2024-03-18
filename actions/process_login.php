<?php
include("../database/database.php");
session_start();

if(isset($_POST['login'])) {
  $user = $_POST['user'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $status = 0;

  if($user=="student") {
    $stmtStudent = $conn->prepare("SELECT * FROM student WHERE email = ? AND password = ?");
    $stmtStudent->bind_param("ss", $email, $password);
    $stmtStudent->execute();
    $stmtResult = $stmtStudent->get_result();
  
    if(mysqli_num_rows($stmtResult) == 1) {
      $result = $stmtResult->fetch_assoc();
      $_SESSION['student'] = $result['student_id'];
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
    $stmtTeacher = $conn->prepare("SELECT * FROM teacher WHERE email = ? AND password = ? AND status = ?");
    $stmtTeacher->bind_param("ssi", $email, $password, $status);
    $stmtTeacher->execute();
    $stmtResult = $stmtTeacher->get_result();

    if(mysqli_num_rows($stmtResult) == 1) {
      $result = $stmtResult->fetch_assoc();
      $_SESSION['teacher'] = $result['teacher_id'];
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
    $stmtAdmin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmtAdmin->bind_param("ss", $email, $password);
    $stmtAdmin->execute();
    $stmtResult = $stmtAdmin->get_result();

    if(mysqli_num_rows($stmtResult) == 1) {
      $result = $stmtResult->fetch_assoc();
      $_SESSION['admin'] = $result['admin_id'];
      $_SESSION['login-admin'] = "Signed in successfully";
      header("Location: ../admin/admin_dashboard.php");
      exit();
    }
    else {
      $_SESSION['login-failed'] = "Incorrect Email or Password";
      header("Location: ../login.php");
      exit();
    }
  }
}
