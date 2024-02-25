<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id'])) {
  $id = mysqli_escape_string($conn, $_POST['delete-id']);
  $sql = "UPDATE subject SET status = 1 WHERE subject_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['delete-subject'] = "Successfully Deleted Subject";
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_subject.php"</script>';
  }
}
else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_subject.php"</script>';
}


?>