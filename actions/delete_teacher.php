<?php
include("../database/database.php");
session_start();

  if(isset($_POST['delete-id'])) {
    $id = mysqli_escape_string($conn, $_POST['delete-id']);
    $sql = "UPDATE teacher set status = 1 WHERE teacher_id = '$id'";
    $query = mysqli_query($conn, $sql);

    if($query) {
      $_SESSION['delete-teacher'] = "Successfully Deleted Teacher";
      header("Location: ../admin/admin_teacher.php");
      exit();
    }
  }
  else {
    header("Location: ../admin/admin_teacher.php");
    exit();
  }


?>