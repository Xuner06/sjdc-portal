<?php
include("../database/database.php");
session_start();

if(isset($_POST['restore-teacher'])) {
  $id = mysqli_escape_string($conn, $_POST['restore-id']);
  $sql = "UPDATE teacher SET status = 0 WHERE teacher_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['restore-teacher'] = "Successfully Restored Teacher";
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_archive_teacher.php"</script>';
  }
}
else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_archive_teacher.php"</script>';
}


?>