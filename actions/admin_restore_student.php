<?php
include("../database/database.php");
session_start();

if(isset($_POST['restore-student'])) {
  $id = mysqli_escape_string($conn, $_POST['restore-id']);
  $sql = "UPDATE student SET status = 0 WHERE student_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['restore-student'] = "Successfully Restored Student";
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_archive_student.php"</script>';
  }
}
else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_archive_student.php"</script>';
}


?>