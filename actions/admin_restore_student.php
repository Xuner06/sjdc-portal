<?php
include("../database/database.php");
session_start();

if(isset($_POST['restore-student'])) {
  $id = mysqli_escape_string($conn, $_POST['restore-id']);
  $sql = "UPDATE student SET status = 0 WHERE student_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['restore-student'] = "Successfully Restored Student";
    header("Location: ../admin/admin_archive_student.php");
    exit();
  }
}
else {
  header("Location: ../admin/admin_archive_student.php");
  exit();
}


?>