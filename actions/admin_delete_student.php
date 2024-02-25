<?php
include("../database/database.php");
session_start();

  if(isset($_POST['delete-id'])) {
    $id = mysqli_escape_string($conn, $_POST['delete-id']);
    $sql = "UPDATE student SET status = 1 WHERE student_id = '$id'";
    $query = mysqli_query($conn, $sql);

    if($query) {
      $_SESSION['delete-student'] = "Successfully Deleted Student";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_student.php"</script>';
    }
  }
  else {
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_student.php"</script>';
  }


?>