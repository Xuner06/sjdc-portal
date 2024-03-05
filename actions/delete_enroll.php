<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id']) && isset($_POST['id'])) {
  $id = mysqli_escape_string($conn, $_POST['id']);
  $enrollId = mysqli_escape_string($conn, $_POST['delete-id']);
  $sql = "DELETE FROM enroll_student WHERE enroll_id = '$enrollId '";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['delete-enroll'] = "Successfully Deleted";
    header("Location: ../admin/admin_student_enroll.php?id=$id");
    exit();
  }
  else {
    header("Location: ../admin/admin_student_enroll.php?id=$id");
    exit();
  }
}

?>