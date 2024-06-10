<?php
include("../database/database.php");
session_start();

if(isset($_POST['upload-picture'])) {
  $id = $_POST['id'];

  $stmtSelect = $conn->prepare("SELECT u.role FROM users u WHERE id = ?");
  $stmtSelect->bind_param("i", $id);
  $stmtSelect->execute();
  $stmtSelectResult = $stmtSelect->get_result();
  $stmtResult = $stmtSelectResult->fetch_assoc();
  $role = $stmtResult['role'];

  $profile_pic = $_FILES['profile_pic'];
  $target_dir = "../image/";
 

  // Generate unique name
  $unique_name = uniqid() . "_" . basename($profile_pic["name"]);
  // File path
  $target_file = $target_dir . $unique_name;
  // File type
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
    if(move_uploaded_file($profile_pic['tmp_name'], $target_file)) {
      $stmtUpdatePicture = $conn->prepare("UPDATE users u SET u.picture = ? WHERE u.id = ?");
      $stmtUpdatePicture->bind_param("si", $target_file, $id);
      $stmtUpdatePicture->execute();

      if($role == "admin") {
        $_SESSION['upload-picture-success'] = "Successfully Changed Picture";
        header("Location: ../admin/admin_account.php");
        exit();
      }
      elseif($role == "teacher") {
        $_SESSION['upload-picture-success'] = "Successfully Changed Picture";
        header("Location: ../teacher/teacher_account.php");
        exit();
      }
      elseif($role == "student") {
        $_SESSION['upload-picture-success'] = "Successfully Changed Picture";
        header("Location: ../student/student_account.php");
        exit();
      }
    }
    else {
      echo "may error";
    }

  }
  else {
    if($role == "admin") {
      $_SESSION['invalid-file-type'] = "Invalid File Type";
      header("Location: ../admin/admin_account.php");
      exit();
    }
    elseif($role == "teacher") {
      $_SESSION['invalid-file-type'] = "Invalid File Type";
      header("Location: ../teacher/teacher_account.php");
      exit();
    }
    elseif($role == "student") {
      $_SESSION['invalid-file-type'] = "Invalid File Type";
      header("Location: ../student/student_account.php");
      exit();
    }
  }
}
?>
