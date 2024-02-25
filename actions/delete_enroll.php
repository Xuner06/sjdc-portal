<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-enroll'])) {
  $id = mysqli_escape_string($conn, $_POST['delete-id']);
  $sql = "DELETE FROM enroll_student WHERE enroll_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    // $_SESSION['delete-subject'] = "Successfully Deleted Subject";
    // echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_subject.php"</script>';
    echo "Succes";
  }
}
else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_subject.php"</script>';
}


?>